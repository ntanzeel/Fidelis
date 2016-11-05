<?php

namespace App\Http\Composers;

use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LayoutComposer {

    private $request;

    private $categories;

    /**
     * LayoutComposer constructor.
     * @param Request $request
     */
    public function __construct(Request $request) {
        $this->request = $request;
        $this->categories = Category::orderBy('name')->get();
    }

    /**
     * @param View $view
     */
    public function compose(View $view) {
        $view->with('navigation', $this->getNavigation());
    }

    /**
     * @return array
     */
    private function getNavigation() {
        return $this->setActive([
            'app'   => $this->appNavigation(),
            'user'  => $this->userNavigation()
        ]);
    }

    /**
     * @return object
     */
    public function appNavigation() {
        $navigation = (Object) [
            'type'  => 'left',
            'links' => []
        ];

        if (Auth::user()) {
            $navigation->links[] = (Object) [
                'title'     => 'Home',
                'route'     => (Object) [
                    'name'      => 'home.index',
                    'params'    => []
                ],
                'active'    => false,
                'dropdown'  => false
            ];
        }

        $navigation->links[] = (Object) [
            'title'     => 'Discover',
            'route'     => (Object) [
                'name'      => 'discover.index',
                'params'    => []
            ],
            'active'    => false,
            'dropdown'  => false
        ];

        return $navigation;
    }

    /**
     * @return object
     */
    public function userNavigation() {
        $navigation = (Object) [
            'type'  => 'right',
            'links' => []
        ];

        $navigation->links = Auth::guest() ? [
            (Object) [
                'title'     => 'Sign up',
                'route'     => (Object) [
                    'name'      => 'auth.register',
                    'params'    => []
                ],
                'active'    => false,
                'dropdown'  => false
            ], (Object) [
                'title'     => 'Log in',
                'route'     => (Object) [
                    'name'      => 'auth.login',
                    'params'    => []
                ],
                'active'    => false,
                'dropdown'  => false
            ]
        ] : [
            (Object) [
                'title'     => Auth::user()->name,
                'route'     => false,
                'active'    => false,
                'dropdown'  => [
                    (Object) [
                        'title'     => 'Log out',
                        'route'     => (Object) [
                            'name'      => 'auth.logout',
                            'params'    => []
                        ],
                        'active'    => false,
                        'dropdown'  => false,
                        'divider'   => false
                    ]
                ]
            ]
        ];

        return $navigation;
    }

    private function getCategories() {
        $categories = [];

        if (Auth::user()) {
            $categories[] = (Object) [
                'title'     => 'Subscribed',
                'route'     => (Object) [
                    'name'      => 'discover.index',
                    'params'    => []
                ],
                'active'    => false,
                'dropdown'  => false,
                'divider'   => true
            ];
        }

        foreach ($this->categories as $category) {
            $categories[] = (Object) [
                'title'     => $category->name,
                'route'     => (Object) [
                    'name'      => 'discover.category',
                    'params'    => [$category->name]
                ],
                'active'    => false,
                'dropdown'  => false,
                'divider'   => false
            ];
        }

        return $categories;
    }

    /**
     * @param array $navigation
     * @return array
     */
    private function setActive(array $navigation) {
        foreach ($navigation as $nav) {
            foreach ($nav->links as $link) {
                $link->active = $link->route &&
                    (
                        $this->request->is(substr(route($link->route->name, $link->route->params, false), 1)) ||
                        $this->request->is(substr(route($link->route->name, $link->route->params, false), 1) . '/*')
                    );

                if ($link->active) {
                    break; break;
                }
            }
        }

        return $navigation;
    }
}
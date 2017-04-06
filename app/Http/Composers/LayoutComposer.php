<?php

namespace App\Http\Composers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LayoutComposer {

    private $request;

    private $publicPath;

    private $layoutPath;

    /**
     * LayoutComposer constructor.
     * @param Request $request
     */
    public function __construct(Request $request) {
        $this->request = $request;
        $this->publicPath = public_path();
        $this->layoutPath = '/' . str_replace('.', '/', config('view.layout'));
    }

    /**
     * @param View $view
     */
    public function compose(View $view) {
        $view->with('navigation', $this->getNavigation());
        $view->with('stylesheets', $this->getStyles());
        $view->with('scripts', $this->getScripts());
    }

    public function getStyles() {
        list($controller, $action) = explode('@', $this->request->route()->getActionName());
        $controller = strtolower(substr(str_replace('\\', '/', $controller), 21, strlen($controller) - 31));
        $directories = explode('/', $controller);

        $stylesheets = [];

        for ($i = 0, $path = ''; $i < count($directories); $i++) {
            $path .= '/' . $directories[$i];
            $stylesheets[$directories[$i] . 'Controller'] = '/assets/css' . $this->layoutPath . $path . '/_shared.css';
        }

        $stylesheets['View'] = '/assets/css' . $this->layoutPath . '/' . $controller . '/' . $action . '.css';

        foreach ($stylesheets as $key => $stylesheet) {
            if (!file_exists($this->publicPath . $stylesheet)) {
                unset($stylesheets[$key]);
            }
        }

        return $stylesheets;
    }

    public function getScripts() {
        list($controller, $action) = explode('@', $this->request->route()->getActionName());
        $controller = strtolower(substr(str_replace('\\', '/', $controller), 21, strlen($controller) - 31));
        $directories = explode('/', $controller);

        $scripts = [];

        for ($i = 0, $path = ''; $i < count($directories); $i++) {
            $path .= '/' . $directories[$i];
            $scripts[$directories[$i] . 'Controller'] = '/assets/js' . $this->layoutPath . $path . '/_shared.js';
        }

        $scripts['View'] = '/assets/js' . $this->layoutPath . '/' . $controller . '/' . $action . '.js';

        foreach ($scripts as $key => $stylesheet) {
            if (!file_exists($this->publicPath . $stylesheet)) {
                unset($scripts[$key]);
            }
        }

        return $scripts;
    }

    /**
     * @return object
     */
    private function getNavigation() {
        return (Object) $this->setActive([
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

        $navigation->links = [
            (Object) [
            'title'     => 'Home',
            'icon'      => 'home',
            'route'     => (Object) [
                'name'      => Auth::user() ? 'home.index' : 'pages.index',
                'params'    => []
            ],
            'active'    => false,
            'dropdown'  => false
            ], (Object) [
                'title'     => 'Discover',
                'icon'      => 'fire',
                'route'     => (Object) [
                    'name'      => 'discover.index',
                    'params'    => []
                ],
                'active'    => false,
                'dropdown'  => false
            ]
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
                'icon'      => 'vcard-o',
                'route'     => (Object) [
                    'name'      => 'auth.register',
                    'params'    => []
                ],
                'active'    => false,
                'dropdown'  => false
            ], (Object) [
                'title'     => 'Log in',
                'icon'      => 'sign-in',
                'route'     => (Object) [
                    'name'      => 'auth.login',
                    'params'    => []
                ],
                'active'    => false,
                'dropdown'  => false
            ]
        ] : [
            (Object) [
                'title'     => 'Notifications',
                'icon'      => 'bell',
                'route'     => (Object) [
                    'name'      => 'notifications.index',
                    'params'    => []
                ],
                'active'    => false,
                'dropdown'  => false
            ]
        ];

        return $navigation;
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

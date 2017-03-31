<?php

    namespace App\Http\Controllers\Api;

    use App\Http\Controllers\Controller;
    use App\Models\Tag;
    use App\Models\User;

    class SearchController extends Controller {

        public function display($query) {
            if (strlen($query) == 0 || ((starts_with($query, '#') || starts_with($query, '#')) && strlen($query) < 2)) {
                return abort(400);
            }

            $results = [
                'users' => !starts_with($query, '#') ? $this->getUsers($query) : [],
                'tags'  => !starts_with($query, '@') ? $this->getTags($query) : [],
            ];

            return response()->json($results);
        }

        private function getUsers($query) {
            $query = starts_with($query, '@') ? substr($query, 1) : $query;

            $users = User::where('name', 'LIKE', '%' . $query . '%')
                ->orWhere('username', 'LIKE', '%' . $query . '%')
                ->select('name', 'username', 'photo')
                ->limit(5)
                ->get();

            return $users ? $users : [];
        }

        private function getTags($query) {
            $query = starts_with($query, '#') ? substr($query, 1) : $query;

            $tags = Tag::where('text', 'LIKE', '%' . $query . '%')
                ->select('text')
                ->limit(5)
                ->get();

            return $tags ? $tags : [];
        }
    }

<?php

    namespace App\Http\Controllers\Api;

    use App\Http\Controllers\Controller;
    use App\Models\Tag;
    use App\Models\User;
    use Illuminate\Database\Eloquent\Model;

    class SearchController extends Controller {

        public function display($query) {
            if (strlen($query) < 3) {
                return response(403);
            }

            $results = collect([]);
            if (!starts_with($query, '#')) {
                $results = $results->merge($this->getUsers($query));
            }
            if (!starts_with($query, '@')) {
                $results = $results->merge($this->getTags($query));
            }

            $results->map(function ($result) {
                /**
                 * @var $result Model
                 */
                $result->type = $result->getTable();
            });

            return response()->json($results);
        }

        private function getUsers($query) {
            $query = starts_with($query, '@') ? substr($query, 1) : $query;

            $users = User::where('name', 'LIKE', '%' . $query . '%')
                ->orWhere('username', 'LIKE', '%' . $query . '%')
                ->select('id AS identifier')
                ->limit(5)
                ->get();

            return $users ? $users : [];
        }

        private function getTags($query) {
            $query = starts_with($query, '#') ? substr($query, 1) : $query;

            $tags = Tag::where('text', 'LIKE', '%' . $query . '%')
                ->select('text AS identifier')
                ->limit(5)
                ->get();

            return $tags ? $tags : [];
        }
    }

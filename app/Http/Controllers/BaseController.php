<?php
    namespace App\Http\Controllers;
    use Illuminate\Support\Facades\Http;
    use App\Http\Controllers\Controller;

    class BaseController extends Controller {

        function expandThread($threads, &$thread) {
            $info = $thread['relationships']['firstPost']['data'];
            $included = $this->findInIncluded($threads, $info); 
            $thread['detail'] = $included; 

            if (!empty($thread['detail']['relationships']['images']['data'])) {
                $images = [];
                foreach ($thread['detail']['relationships']['images']['data'] as $imageInfo) {
                    $images[] = $this->findInIncluded($threads, $imageInfo);
                }
                $thread['detail']['images'] = $images;
            }

            if (!empty($thread['relationships']['threadVideo']['data'])) {
                $thread['detail']['video'] = $this->findInIncluded($threads, $thread['relationships']['threadVideo']['data']);
            }

            $info = $thread['relationships']['user']['data'];
            $thread['user'] = $this->findInIncluded($threads, $info);

            if (!empty($thread['relationships']['category'])) {
                $info = $thread['relationships']['category']['data'];
                $thread['category'] = $this->findInIncluded($threads, $info);
            }
        }

        function findInIncluded($threads, $info) {
            foreach ($threads['included'] as $data) {
                if ($data['type'] == $info['type'] &&
                    $data['id'] == $info['id']) {
                    return $data;
                }
            }
            return null;
        }

    }


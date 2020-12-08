<?php
    namespace App\Http\Controllers;
    use Illuminate\Support\Facades\Http;
    use App\Http\Controllers\BaseController;

    class IndexController extends BaseController {
        public function index($categoryId = "") {
            $discuzQURL = env("DISCUZQ_URL", "http://localhost");
            $threadsAPI = $discuzQURL . "/api/threads";

            $topThreads = $this->getThreads($threadsAPI, [
                    "include" => "firstPost", 
                    "page[number]" => "1",
                    "filter[isSticky]" => "yes",
                    "filter[isApproved]" => "1",
                    "filter[isDeleted]" => "no"
                ]
            );

            $threads = $this->getThreads($threadsAPI, [
                "page[number]" => "1",
                "page[limit]" => "50",
                "sort" => "",
                "filter[isSticky]" => "no",
                "filter[isApproved]" => "1",
                "filter[isDeleted]" => "no",
                "filter[isDisplay]" => "yes",
                "filter[type]" => "",
                "filter[categoryId]" => $categoryId,
                "include" => "user,user.groups,firstPost,firstPost.images,category,threadVideo,question,question.beUser,question.beUser.groups,firstPost.postGoods,threadAudio"
            ]);


            $categories = $this->getCategories($discuzQURL); 

            $data = [
                'topThreads' => $topThreads,
                'threads' => $threads,
                'categories' => $categories
            ];

            return view('index', [
                'title' => env("APP_NAME", "首页"),
                'metaDescription' => env("META_DESCRIPTION", ""),
                'metaKeywords' => env("META_KEYWORDS", ""), 
                'logo' => env("LOGO_URL", ""),
                'data' => $data
                ]
            );
        }

        function getCategories($discuzQURL) {
            $categoryAPI = $discuzQURL . "/api/categories";
            $response = Http::get($categoryAPI, []);
            return json_decode($response, true);
        }

        function getThreads($threadsAPI, $params) {
            $response = Http::get($threadsAPI, $params);

            $threads = json_decode($response, true);

            foreach($threads['data'] as &$thread) {
                $this->expandThread($threads, $thread);
            }

            return $threads;
        }
    }

<?php
    namespace App\Http\Controllers;
    use Illuminate\Support\Facades\Http;
    use App\Http\Controllers\BaseController;

    class ThreadController extends BaseController {
        public function thread($threadId) {
            $discuzQ = env("DISCUZQ_URL", "http://localhost");
            $threadsAPI = $discuzQ . "/api/threads/" . $threadId;

            $thread = $this->getThreads($threadsAPI, [
                    "include" => "posts.replyUser,threadAudio,user.groups,user,user.groups.permissionWithoutCategories,posts,posts.user,posts.likedUsers,posts.images,firstPost,firstPost.likedUsers,firstPost.images,firstPost.attachments,rewardedUsers,category,threadVideo,paidUsers,question,question.beUser,question.images,onlookers"
                ]
            );

            if (empty($thread['data']['attributes']['title'])) {
                $title = $thread['data']['detail']['attributes']['summaryText'];
            } else {
                $title = $thread['data']['attributes']['title'];
            }

            return view('thread', [
                'sitename' => env("APP_NAME", ""),
                'title' => $title,
                'metaDescription' => $thread['data']['detail']['attributes']['summaryText'],
                'metaKeywords' => env("META_KEYWORDS", ""), 
                'logo' => env("LOGO_URL", ""),
                'thread' => $thread['data']
                ]
            );
        }

        function getThreads($threadsAPI, $params) {
            $response = Http::get($threadsAPI, $params);
            $threads = json_decode($response, true);

            $thread = &$threads['data'];
            $this->expandThread($threads, $thread);
            
            return $threads;
        }
    }

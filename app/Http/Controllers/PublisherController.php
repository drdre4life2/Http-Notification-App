<?php

namespace App\Http\Controllers;

use App\Jobs\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class PublisherController extends Controller
{

    /**
     * Used for publishing to a topic
     *
     * @param Request $request
     * @param $topic
     * @return \Illuminate\Http\JsonResponse
     */
    public function publishToTopic(Request $request, $topic)
    {
        try {
            $redis = Redis::connection();

            $url = $redis->lrange($topic, 0, -1);

            $url_count = count($url);
            $data = $request->all();

            //Publish topic to subscribers
            Publisher::dispatch($topic, $data, $url);

            return response()
                ->json([
                    'status' => true,
                    'msg' => "Topic published to $url_count url(s)"
                ], 200);

        } catch (\Exception $e) {
            return response()
                ->json([
                    'status' => false,
                    'msg' => $e->getMessage(),
                    'trace' => $e->getTrace()
                ], 500);
        }
    }

}

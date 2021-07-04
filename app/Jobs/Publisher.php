<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class Publisher implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $urls;
    private $topic;
    private $data;

    /**
     * Create a new job instance.
     *
     * @param $topic
     * @param $data
     * @param $urls
     */
    public function __construct($topic, $data, $urls)
    {
        $this->urls = $urls;
        $this->topic = $topic;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->urls as $url) {
            Http::post($url, [
                "topic" => $this->topic,
                "data" => $this->data
            ]);
        }
    }
}

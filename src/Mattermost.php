<?php

namespace ThibaudDauce\Mattermost;

use GuzzleHttp\Client;

class Mattermost
{

    /**
     * Guzzle HTTP Client
     *
     * @var Client
     */
    public $mattermost;

    /**
     * Default webhook URL
     *
     * @var string
     */
    public $webhook;

    public function __construct(Client $mattermost, $webhook = null)
    {
        $this->mattermost = $mattermost;
        $this->webhook = $webhook;
    }

    public function send(Message $message, $webhook = null)
    {
        if (is_null($webhook)) {
            $webhook = $this->webhook;
        }

        $this->mattermost->post($webhook, [
            'json' => $message->toArray(),
        ], [
            'Content-Type' => 'application/json',
        ]);
    }
}

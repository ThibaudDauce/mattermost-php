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

        $this->mattermost->post($webhook, ['json' => array_filter([
            'text' => $message->text,
            'channel' => $message->channel,
            'username' => $message->username,
            'icon_url' => $message->iconUrl,
            'attachments' => $this->attachments($message),
        ])], [
            'Content-Type' => 'application/json',
        ]);
    }

    /**
     * Format the message's attachments.
     *
     * @param  \ThibaudDauce\Mattermost\Message  $message
     * @return array
     */
    protected function attachments(Message $message)
    {
        return array_map(function (Attachment $attachment) {
            return array_filter([
                'fallback' => $attachment->fallback,
                'color' => $attachment->color,
                'pretext' => $attachment->pretext,
                'text' => $attachment->text,
                'author_name' => $attachment->authorName,
                'author_link' => $attachment->authorLink,
                'author_icon' => $attachment->authorIcon,
                'title' => $attachment->title,
                'title_link' => $attachment->titleLink,
                'fields' => $attachment->fields,
                'image_url' => $attachment->imageUrl,
                'thumb_url' => $attachment->thumbUrl,
                'actions' => $attachment->actions,
            ]);
        }, $message->attachments);
    }
}

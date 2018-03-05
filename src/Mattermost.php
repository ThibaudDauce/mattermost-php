<?php

namespace ThibaudDauce\Mattermost;

use GuzzleHttp\Client;

class Mattermost {

    /**
     * @var Client
     */
    public $mattermost;

    public function __construct(Client $mattermost)
    {
        $this->mattermost = $mattermost;
    }

    public function send(Message $message, $url)
    {
        $this->mattermost->post($url, ['json' => array_filter([
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
        return array_map(function(Attachment $attachment) {
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

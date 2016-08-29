<?php

namespace ThibaudDauce\Mattermost;

use Closure;

class Message {

    /**
     * The text of the message.
     *
     * @var string
     */
    public $text;

    /**
     * The printed username of the message.
     *
     * @var string
     */
    public $username;

    /**
     * The channel of the message.
     *
     * @var string
     */
    public $channel;

    /**
     * The icon of the message.
     *
     * @var string
     */
    public $iconUrl;

    /**
     * The attachments of the message.
     *
     * @var Attachment[]
     */
    public $attachments = [];

    /**
     * @param  string  $text
     * @return $this
     */
    public function text($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @param  string  $username
     * @return $this
     */
    public function username($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @param  string  $channel
     * @return $this
     */
    public function channel($channel)
    {
        $this->channel = $channel;

        return $this;
    }

    /**
     * @param  string  $iconUrl
     * @return $this
     */
    public function iconUrl($iconUrl)
    {
        $this->iconUrl = $iconUrl;

        return $this;
    }

    /**
     * Override all attachments for the message.
     *
     * @param  Attachment[]  $attachments
     * @return $this
     */
    public function attachments($attachments = [])
    {
        $this->attachments = $attachments;

        return $this;
    }

    /**
     * Add an attachment for the message.
     *
     * @param  \Closure  $callback
     * @return $this
     */
    public function attachment(Closure $callback)
    {
        $this->attachments[] = $attachment = new Attachment;

        $callback($attachment);

        return $this;
    }
}

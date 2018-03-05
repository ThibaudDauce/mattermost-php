<?php

namespace ThibaudDauce\Mattermost;

class Attachment {

    /**
     * A required plain-text summary of the post. This is used in notifications, and in clients that don’t support formatted text (eg IRC).
     *
     * @var string
     */
    public $fallback;

    /**
     * A hex color code that will be used as the left border color for the attachment. If not specified, it will default to match the left hand sidebar header background color.
     *
     * @var string
     */
    public $color;

    /**
     * An optional line of text that will be shown above the attachment.
     *
     * @var string
     */
    public $pretext;

    /**
     * The text to be included in the attachment. It can be formatted using markdown.
     * If it includes more than 700 characters or more than 5 line breaks, the message will be collapsed and a “Show More” link will be added to expand the message.
     *
     * @var string
     */
    public $text;

    /**
     * An optional name used to identify the author. It will be included in a small section at the top of the attachment.
     *
     * @var string
     */
    public $authorName;

    /**
     * An optional URL used to hyperlink the author_name. If no author_name is specified, this field does nothing.
     *
     * @var string
     */
    public $authorLink;

    /**
     * An optional URL used to display a 16x16 pixel icon beside the author_name.
     *
     * @var string
     */
    public $authorIcon;

    /**
     * An optional title displayed below the author information in the attachment.
     *
     * @var string
     */
    public $title;

    /**
     * An optional URL used to hyperlink the title. If no title is specified, this field does nothing.
     *
     * @var string
     */
    public $titleLink;

    /**
     * Fields can be included as an optional array within attachments, and are used to display information in a table format inside the attachment.
     *
     * @var array
     */
    public $fields = [];

    /**
     * An optional URL to an image file (GIF, JPEG, PNG, or BMP) that will be displayed inside a message attachment.
     * Large images will be resized to a maximum width of 400px or a maximum height of 300px, while still maintaining the original aspect ratio.
     *
     * @var string
     */
    public $imageUrl;

    /**
     * An optional URL to an image file (GIF, JPEG, PNG, or BMP) that will be displayed as a 75x75 pixel thumbnail on the right side of an attachment.
     * We recommend using an image that is already 75x75 pixels, but larger images will be scaled down with the aspect ratio maintained.
     *
     * @var string
     */
    public $thumbUrl;

    /**
     * Optional actions that can be made when responding to an incoming attachment. Should be an array that includes:
     * 'name' string Title of an action button (ex. Verify)
     * 'integration' array:
     *      'url' string URL where the action will be sent (ex. https://opt.netis.pl/mattermost/verify-request)
     *      'context' array: include any parameters that will be sent to the URL (ex. ['text' => 123456]
     *
     * @var array
     */
    public $actions = [];

    /**
     * @param  string  $fallback
     * @return $this
     */
    public function fallback($fallback)
    {
        $this->fallback = $fallback;

        return $this;
    }

    /**
     * @param  string  $color
     * @return $this
     */
    public function color($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Set a green color for the attachment.
     *
     * @return $this
     */
    public function success()
    {
        $this->color = '#22BC66';

        return $this;
    }

    /**
     * Set a red color for the attachment.
     *
     * @return $this
     */
    public function error()
    {
        $this->color = '#DC4D2F';

        return $this;
    }

    /**
     * Set a blue color for the attachment.
     *
     * @return $this
     */
    public function info()
    {
        $this->color = '#3869D4';

        return $this;
    }

    /**
     * @param  string  $pretext
     * @return $this
     */
    public function pretext($pretext)
    {
        $this->pretext = $pretext;

        return $this;
    }

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
     * @param  string  $authorName
     * @return $this
     */
    public function authorName($authorName)
    {
        $this->authorName = $authorName;

        return $this;
    }

    /**
     * @param  string  $authorLink
     * @return $this
     */
    public function authorLink($authorLink)
    {
        $this->authorLink = $authorLink;

        return $this;
    }

    /**
     * @param  string  $authorIcon
     * @return $this
     */
    public function authorIcon($authorIcon)
    {
        $this->authorIcon = $authorIcon;

        return $this;
    }

    /**
     * @param  string  $title
     * @param  string  $titleLink
     * @return $this
     */
    public function title($title, $titleLink = null)
    {
        $this->title = $title;
        $this->titleLink = $titleLink;

        return $this;
    }

    /**
     * Override all fields with an array
     *
     * @param  array  $fields
     * @return $this
     */
    public function fields($fields = [])
    {
        $this->fields = $fields;

        return $this;
    }

    /**
     * Add a field to the attachment
     *
     * @param  string  $title  A title shown in the table above the value.
     * @param  string  $value  The text value of the field. It can be formatted using markdown.
     * @param  bool    $short  Optionally set to “True” or “False” to indicate whether the value is short enough to be displayed beside other values.
     * @return $this
     */
    public function field($title, $value, $short = true)
    {
        $this->fields[] = compact('title', 'value', 'short');

        return $this;
    }

    /**
     * @param  string  $imageUrl
     * @return $this
     */
    public function imageUrl($imageUrl)
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    /**
     * @param  string  $thumbUrl
     * @return $this
     */
    public function thumbUrl($thumbUrl)
    {
        $this->thumbUrl = $thumbUrl;

        return $this;
    }

    public function action($action)
    {
        $this->actions[] = $action;

        return $this;
    }

    public function actions($actions)
    {
        $this->actions = $actions;

        return $this;
    }
}

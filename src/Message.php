<?php

namespace OneThirtyOne\Mime;

use Illuminate\Support\Facades\Storage;
use OneThirtyOne\Mime\Exception\InvalidMimeProperty;
use ZBateson\MailMimeParser\MailMimeParser;

/**
 * Class Message.
 */
class Message
{
    /**
     * @var null
     */
    private $attachments;

    /**
     * @var null
     */
    private $id;

    /**
     * @var
     */
    private $from;

    /**
     * @var
     */
    private $to;

    /**
     * @var
     */
    private $subject;

    /**
     * @var
     */
    private $body;

    /**
     * Message constructor.
     *
     * @param      $from
     * @param      $to
     * @param      $subject
     * @param      $body
     * @param null $attachments
     * @param null $id
     */
    public function __construct($from, $to, $subject, $body, $attachments, $id = null)
    {
        $this->from = $from;
        $this->to = $to;
        $this->subject = $subject;
        $this->body = $body;
        $this->attachments = $attachments;
        $this->id = $id;
    }

    /**
     * @param      $raw
     *
     * @param null $id
     *
     * @return \OneThirtyOne\Mime\Message
     */
    public static function fromRaw($raw, $id = null)
    {
        $message = (new MailMimeParser)->parse($raw);

        return new self(
            $message->getHeader('From')->getEmail(),
            $message->getHeader('To')->getValue(),
            $message->getHeaderValue('Subject'),
            $message->getTextContent(),
            $message->getAllAttachmentParts(),
            $id
        );
    }

    /**
     * @param $property
     *
     * @return mixed
     * @throws \OneThirtyOne\Mime\Exception\InvalidMimeProperty
     */
    public function __get($property)
    {
        if (! property_exists($this, $property)) {
            throw  new InvalidMimeProperty();
        }

        return $this->get($property);
    }

    /**
     * @param $property
     *
     * @return mixed
     * @throws \OneThirtyOne\Mime\Exception\InvalidMimeProperty
     */
    public function get($property)
    {
        if (! property_exists($this, $property)) {
            throw  new InvalidMimeProperty();
        }

        return $this->{$property};
    }

    /**
     * Deletes a message from the s3 bucket.
     */
    public function delete()
    {
        Storage::disk('s3')->delete($this->id);
    }
}

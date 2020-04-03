<?php


namespace OneThirtyOne\Mime;


use ZBateson\MailMimeParser\MailMimeParser;

class Message
{
    /**
     * @var null
     */
    protected $attachments;
    private $from;
    private $to;
    private $subject;
    private $message;

    /**
     * Message constructor.
     *
     * @param      $from
     * @param      $to
     * @param      $subject
     * @param      $message
     * @param null $attachments
     */
    public function __construct($from, $to, $subject, $message, $attachments = null)
    {
        $this->from = $from;
        $this->to = $to;
        $this->subject = $subject;
        $this->message = $message;
        $this->attachments = $attachments;
    }

    public static function fromRaw($raw)
    {
        $message = (new MailMimeParser)->parse($raw);

        return new self(
            $message->getHeader('From')->getEmail(),
            $message->getHeader('To')->getValue(),
            $message->getHeaderValue('Subject'),
            $message->getTextContent(),
            $message->getAllAttachmentParts()
        );
    }

    public function subject()
    {
    }

    public function message()
    {
    }
}

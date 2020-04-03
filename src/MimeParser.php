<?php


namespace OneThirtyOne\Mime;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use ZBateson\MailMimeParser\MailMimeParser as ZBMimeParser;


class MimeParser
{
    protected $zbMimeParser;

    protected $message;

    protected $messages;

    public function __construct()
    {
        $this->zbMimeParser = new ZBMimeParser();
    }

    public function fromBucket()
    {
        $this->messages = Collection::make(Storage::disk('s3')->files())->map(function ($item) {
            $file = Storage::disk('s3')->get($item);

            return Message::fromRaw($file);
        });

        return $this->messages;
    }


}

<?php


namespace OneThirtyOne\Mime;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;


/**
 * Class MimeParser
 * @package OneThirtyOne\Mime
 */
class MessageCollector
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function fromBucket()
    {
        return Collection::make(Storage::disk('s3')->files())->map(function ($message) {

            return Message::fromRaw(Storage::disk('s3')->get($message), $message);
        });

    }


}

<?php

namespace OneThirtyOne\Mime\Tests;

use Illuminate\Support\Facades\Storage;
use OneThirtyOne\Mime\Exception\InvalidMimeProperty;
use OneThirtyOne\Mime\Message;

class MessageTest extends TestCase
{
    public $raw;

    public function setUp(): void
    {
        parent::setUp();

        Storage::fake();

        $this->raw = file_get_contents(__DIR__.'/stubs/dummyEmail');
    }

    /** @test */
    public function it_parses_a_raw_message()
    {
        $id = 'dummy-id';
        $message = Message::fromRaw($this->raw, $id);

        $this->assertInstanceOf(Message::class, $message);
        $this->assertEquals($id, $message->id);
    }

    /** @test */
    public function it_deletes_a_message()
    {
        Storage::shouldReceive('disk->delete');

        $message = Message::fromRaw($this->raw);
        $message->delete();
    }

    /** @test */
    public function it_throws_an_exception_if_a_property_does_not_exists()
    {
        $this->expectException(InvalidMimeProperty::class);

        $message = new Message('from@example.com', 'to@example.com', 'Test Subject', 'Test Body', []);

        $message->foo;
    }
}

<?php

namespace OneThirtyOne\Mime\Tests;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use OneThirtyOne\Mime\Facades\MessageCollector;

class MessageCollectorTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        Storage::fake();
    }

    /** @test */
    public function it_retrieves_all_message_from_storage()
    {
        Storage::shouldReceive('disk->files')->once()->andReturn('dummyEmail');
        Storage::shouldReceive('disk->get')->once()->andReturn(
            file_get_contents(__DIR__.'/stubs/dummyEmail')
        );

        $messages = MessageCollector::fromBucket();

        $this->assertInstanceOf(Collection::class, $messages);
        $this->assertEquals(1, $messages->count());
    }
}

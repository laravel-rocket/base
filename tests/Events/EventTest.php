<?php
namespace Tests\Events;

use App\Events\Event;
use Tests\TestCase;

class EventTest extends TestCase
{
    protected $useDatabase = false;

    public function testGetInstance()
    {
        /** @var \App\Events\Event $action */
        $event = new Event();
        $this->assertNotNull($event);
    }
}

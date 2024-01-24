<?php

namespace App\Listeners;

use App\Events\TaskCreated;
use Illuminate\Support\Facades\Log;

class LogTaskCreated
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */

    public function handle(TaskCreated $event): void
    {
        Log::info(sprintf("Task created successfully: %s", json_encode($event->task->toArray(), true)));
    }
}

<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Log;

class LogTaskDeleted
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
    public function handle(object $event): void
    {
        Log::info(sprintf("Task with ID %d deleted successfully", $event->taskId));
    }
}

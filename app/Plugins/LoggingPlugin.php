<?php

namespace App\Plugins;

use Illuminate\Support\Facades\Log;

class LoggingPlugin implements PluginInterface
{
    public function process(): void
    {
        Log::info(sprintf("Plugin: Request logged:  %s", json_encode(request()->all(), true)));
    }
}

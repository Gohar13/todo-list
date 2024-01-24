<?php

namespace App\Plugins;

class PluginManager
{
    protected array $plugins = [];

    public function registerPlugin(PluginInterface $plugin): static
    {
        $this->plugins[] = $plugin;

        return $this;
    }

    public function process(): void
    {
        foreach ($this->plugins as $plugin) {
            $plugin->process();
        }
    }
}

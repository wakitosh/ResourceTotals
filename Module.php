<?php

declare(strict_types=1);

namespace ResourceTotals;

use Omeka\Module\AbstractModule;

class Module extends AbstractModule
{
    public function getConfig(): array
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig(): array
    {
        return [
            'Laminas\\Loader\\StandardAutoloader' => [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__ . '/src',
                ],
            ],
        ];
    }
}

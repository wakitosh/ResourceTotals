<?php

declare(strict_types=1);

namespace ResourceTotals\Service\BlockLayout;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use ResourceTotals\Site\BlockLayout\ResourceTotals;

class ResourceTotalsFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $serviceLocator, $requestedName, ?array $options = null): ResourceTotals
    {
        return new ResourceTotals($serviceLocator->get('Omeka\HtmlPurifier'));
    }
}

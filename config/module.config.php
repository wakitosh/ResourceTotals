<?php

declare(strict_types=1);

namespace ResourceTotals;

return [
    'block_layouts' => [
        'factories' => [
            'resourceTotals' => Service\BlockLayout\ResourceTotalsFactory::class,
        ],
    ],
];

<?php

namespace OpsWay\ZohoBooks;

return [
    'service_manager' => [
        'factories' => [
            Api::class => Factory\ApiServiceFactory::class,
        ],
        'aliases' => [
            'zohobooks' => Api::class,
        ],
    ],
];

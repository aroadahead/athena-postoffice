<?php
declare(strict_types=1);

use AthenaBridge\Laminas\Router\Http\Literal;
use AthenaPostoffice\Controller\Factory\IndexControllerFactory;
use AthenaPostoffice\Controller\IndexController;
use AthenaPostoffice\Service\Factory\PostofficeServiceFactory;
use Poseidon\Poseidon;

$laminas = Poseidon ::getCore() -> getLaminasManager();
return [
    'view_manager' => [
        'template_map' => [
            'email/test' => $laminas -> getApplicationCore()
                -> getFilesystemManager() -> getDirectoryPaths() -> facade() -> templates('email/test.phtml')
        ],
        'template_path_stack' => [
            __DIR__ . '/../view'
        ]
    ],
    'controllers' => [
        'factories' => [
            IndexController::class => IndexControllerFactory::class
        ]
    ],
    'service_manager' => [
        'factories' => [
            'module.service.athena-postoffice' => PostofficeServiceFactory::class,
        ]
    ],
    'translator' => [],
    'view_helpers' => [],
    'router' => [
        'routes' => [
            'postoffice.alive' => [
                'type' => Literal::class,
                'options' => [
                    'route' => $laminas -> route('alive', 'postoffice'),
                    'defaults' => [
                        'controller' => IndexController::class,
                        'action' => 'alive',
                    ],
                ],
            ],
        ]
    ]
];
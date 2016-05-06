<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

return array(
   'router' => ['routes' => ['home-sec' => ['type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => ['route' => '/',
                    'defaults' => ['controller' => 'Application\Controller\Index',
                        'action' => 'index',
                    ],
                ],
            ],
       'paginator' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '[/page/:page]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'page' => '\d+'
                    ),
                    'defaults' => array(
                        'action' => 'index',
                        'page' => 1
                    ),
                ),
            ),
            'full-app' => ['type' => 'Segment',
                'options' => ['route' => '/application[/:controller]/:action[[/id]/:id]'
                    . '[/turma/:turma][/curso/:curso][/page/:page]',
                    'constraints' => ['controller' => '[a-zA-Z_-]*',
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                        'turma' => '[0-9]+',
                        'page' => '[0-9]+',
                    ],
                    'defaults' => ['__NAMESPACE__' => 'Application\Controller',
                        'controller' => 'index',
                        'action' => 'index',
                    ],
                ],
            ],
            'full-app2' => ['type' => 'Segment',
                'options' => ['route' => '/application[/:controller][/:action][[/id]/:id][/page/:page]',
                    'constraints' => ['controller' => '[a-zA-Z_-]*',
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                        'page' => '[0-9]+',
                    ],
                    'defaults' => ['__NAMESPACE__' => 'Application\Controller',
                        'controller' => 'index',
                        'action' => 'index',
                    ],
                ],
            ],
        ],
    ],
'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                )
            )
        )
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'factories' => array(
            'translator' => 'Zend\Mvc\Service\TranslatorServiceFactory',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    
    
    'login' => array(
        'type' => 'Zend\Mvc\Router\Http\Literal',
        'options' => array(
            'route' => '/login',
            'defaults' => array(
                'controller' => 'Application\Controller\Login',
                'action' => 'index',
            ),
        ),
        'may_terminate' => true,
        'child_routes' => array(
            'default' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '[/:action]',
                    'constraints' => array(
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(),
                ),
            ),
        ),
    ),
    
    
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Index' => Controller\IndexController::class,
            'Application\Controller\Artista' => Controller\ArtistaController::class,
            'Application\Controller\Album' => Controller\AlbumController::class,
            'Application\Controller\Genero' => Controller\GeneroController::class,
            'Application\Controller\Musica' => Controller\MusicaController::class,
            'Application\Controller\Produtora' => Controller\ProdutoraController::class,
            'Application\Controller\Fatorial' => Controller\FatorialController::class,
            'Application\Controller\Login' => Controller\LoginController::class,
            
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
);

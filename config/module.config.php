<?php
return array(
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view'
        )
    ),
    'service_manager' => array(
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
    ),
    'translator' => array(
        'locale' => 'es_ES',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo'
            ),
        ),
    ),
    'router' => array(
        'routes' => array(
            'home' => array('type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'=> '/home',
                    'defaults' => array(
                        'controller' => 'Website\Controller\Website',
                        'action'=> 'index',
                    )
                )
            ),
            'authoring' => array('type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'=> 'authoring',
                    'defaults' => array(
                        'controller' => 'Website\Controller\Website',
                        'action'=> 'authoring',
                    )
                )
            ),
            'hosting' => array('type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'=> '/hosting',
                    'defaults' => array(
                        'controller' => 'Website\Controller\Website',
                        'action'=> 'hosting',
                    )
                )
            ),
            'courses' => array('type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'=> 'courses',
                    'defaults' => array(
                        'controller' => 'Website\Controller\Website',
                        'action'=> 'courses',
                    )
                )
            ),
            'pricing' => array('type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'=> '/pricing',
                    'defaults' => array(
                        'controller' => 'Website\Controller\Website',
                        'action'=> 'pricing',
                    )
                )
            ),
            'about' => array('type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'=> '/about',
                    'defaults' => array(
                        'controller' => 'Website\Controller\Website',
                        'action'=> 'aboutUs',
                    )
                )
            ),
            'contact' => array('type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'=> '/contact',
                    'defaults' => array(
                        'controller' => 'Website\Controller\Website',
                        'action'=> 'contactUs',
                    )
                )
            ),
            'termsOfService' => array('type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'=> '/website/termsOfService',
                    'defaults' => array(
                        'controller' => 'Website\Controller\Website',
                        'action'=> 'termsOfService',
                    )
                )
            ),
            'privacyPolicy' => array('type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'=> '/website/privacyPolicy',
                    'defaults' => array(
                        'controller' => 'Website\Controller\Website',
                        'action'=> 'privacyPolicy',
                    )
                )
            ),

            'createContact' => array('type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'=> '/createContact',
                    'defaults' => array(
                        'controller' => 'Website\Controller\Website',
                        'action'=> 'createContact',
                    )
                )
            ),

        )
    ),
    'controllers' => array(
        'invokables' => array(
            'Website\Controller\Website'=> 'Website\Controller\WebsiteController'
        )
    ),
    'doctrine' => array(
        'driver' => array(
            'website_entities' => array(
                'class' =>'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/Website/Entity')
            ),

            'orm_default' => array(
                'drivers' => array(
                    'Website\Entity' => 'website_entities'
                )
            )
        )
    ),

);

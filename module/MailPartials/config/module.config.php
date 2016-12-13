<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'MailPartials\Controller\MailPartials' => 'MailPartials\Controller\MailPartialsController',
        ),
    ),
    'view_helpers' => array(
        'invokables' => array(
            'showMessages' => 'MailPartials\View\Helper\ShowMessages',
        ),
    ),
    'router' => array(
        'routes' => array(
            'partials' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/admin/mail/partials',
                    'defaults' => array(
                        'controller' => 'MailPartials\Controller\MailPartials',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'add' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/add',
                            'defaults' => array(
                                'controller' => 'MailPartials\Controller\MailPartials',
                                'action' => 'add',
                            ),
                        ),
                    ),
                    'edit' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/edit/:id',
                            'defaults' => array(
                                'controller' => 'MailPartials\Controller\MailPartials',
                                'action' => 'edit',
                            ),
                            'constraints' => array(
                                'id' => '[1-9]\d*',
                            ),
                        ),
                    ),
                    'delete' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/delete/:id',
                            'defaults' => array(
                                'controller' => 'MailPartials\Controller\MailPartials',
                                'action' => 'delete',
                            ),
                            'constraints' => array(
                                'id' => '[1-9]\d*',
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'module_layouts' => array(
        'MailPartials' => array(
            'default' => 'layout/admin',
        )
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'MailPartials' => __DIR__ . '/../view',
        )
    ),
    'doctrine' => array(
        'driver' => array(
            'partials_entity' => array(
                'class' =>'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'paths' => array(__DIR__ . '/../src/MailPartials/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    'MailPartials\Entity' => 'partials_entity',
                )
            )
        )
    ),
);
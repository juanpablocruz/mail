<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Administration\Controller\Admin' => 'Administration\Controller\AdminController',
        ),
    ),
    'navigation' => array(
        'default' => array(
            array(
                'label' => 'Dashboard',
                'route' => 'admin',
                'action' => 'index',
                'controllers' => [
                    'Administration\Controller\Admin'
                ]
            ),
            array(
                'label' => 'Mail system',
                'uri' => '/admin/mail',
                'controllers' => [
                    'MailPartials\Controller\MailPartials',
                    'MailTemplates\Controller\MailTemplates'
                ],
                'pages' => array(
                    array(
                        'label' => 'Mails',
                        'uri' => '/admin/mail',
                        'controllers' => [
                            'MailTemplates\Controller\MailTemplates'
                        ],
                    ),
                    array(
                        'label' => 'Templates',
                        'uri' => '/admin/mail/templates',
                        'controllers' => [
                            'MailTemplates\Controller\MailTemplates'
                        ],
                    ),
                    array(
                        'label' => 'Partial Templates',
                        'uri' => '/admin/mail/partials',
                        'controllers' => [
                            'MailPartials\Controller\MailPartials',
                        ],
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
        ),
    ),
    'router' => array(
        'routes' => array(
            'admin' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/admin',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Administration\Controller',
                        'controller' => 'Admin',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Administration' => __DIR__ . '/../view',
        ),
    ),
    'module_layouts' => array(
        'Administration' => array(
            'default' => 'layout/admin',
        )
    )
);

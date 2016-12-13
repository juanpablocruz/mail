<?php
return array(

    'controllers' => array(
        'factories' => [
          'MailTemplates\Controller\WriteTemplate' =>
                        'MailTemplates\Factory\WriteControllerFactory',
          'MailTemplates\Controller\MailTemplates' =>
                        'MailTemplates\Factory\TemplatesControllerFactory',
          ],
    ),
    'form_elements' => [
      'factories' => [
          'MailTemplates\Form\TemplateForm' => "MailTemplates\Factory\TemplatesFormFactory"
        ]
    ],
    'router' => array(
        'routes' => array(
            'mail' => array(
                'type'    => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route'    => '/admin/mail',
                    'defaults' => [
                      'controller' => 'MailTemplates\Controller\MailTemplates',
                      'action' => 'index',
                      ],
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'templates' => [
                      'type'    => 'Literal',
                      'options' => array(
                          'route'    => '/templates',
                          'defaults' => [
                            'controller' => 'MailTemplates\Controller\MailTemplates',
                            'action' => 'index',
                          ],
                      ),
                      'may_terminate' => true,
                      'child_routes' => [
                          'add' => [
                            'type' => 'Literal',
                            'options' => [
                              'route' => '/add',
                              'defaults' => [
                                'controller' => 'MailTemplates\Controller\WriteTemplate',
                                'action' => 'add',
                                ],
                              ],
                          ],
                          'edit' => [
                            'type' => 'Segment',
                            'options' => [
                              'route' => '/edit/:id',
                              'defaults' => [
                                'controller' => 'MailTemplates\Controller\WriteTemplate',
                                'action' => 'edit',
                                ],
                                'constraints' => [
                                    'id' => '[1-9]\d*',
                                ],
                              ],
                          ],
                          'delete' => [
                            'type' => 'Segment',
                            'options' => [
                              'route' => '/delete/:id',
                              'defaults' => [
                                'controller' => 'MailTemplates\Controller\MailTemplates',
                                'action' => 'delete',
                                ],
                                'constraints' => [
                                    'id' => '[1-9]\d*',
                                ],
                              ],
                            ],
                        ],
                    ],
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'MailTemplates' => __DIR__ . '/../view',
        ),
    ),
    'module_layouts' => array(
        'MailTemplates' => array(
            'default' => 'layout/admin',
        )
    ),
    'doctrine' => array(
            'driver' => array(
                'templates_entities' => array(
                    'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                    'cache' => 'array',
                    'paths' => (__DIR__ . '/../src/MailTemplates/Model')
                ),
                'orm_default' => array(
                    'drivers' => array(
                        'MailTemplates\Model' => 'templates_entities'
                    ),
                ),
            ),
        ),
);

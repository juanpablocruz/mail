<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonUsuarios for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Usuarios;

return array(
    'router' => array(
        'routes' => array(

        ),
    ),

    'doctrine' => array(
          'driver' => array(
              'users_entities' => array(
                  'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                  'cache' => 'array',
                  'paths' => (__DIR__ . '/../src/Usuarios/Entity')
              ),
              'orm_default' => array(
                  'drivers' => array(
                      'Usuarios\Entity' => 'users_entities'
                  ),
              ),
          ),
      ),
);

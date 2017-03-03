<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
/**
 * List of enabled modules for this application.
 *
 * This should be an array of module namespaces used in the application.
 */

// var_dump(__DIR__);
//      /home/vagrant/Code/pokedex/config
// var_dump(is_dir(__DIR__ . '/../module'));
// var_dump(is_dir(__DIR__ . '/../vendor'));
return [
    'Zend\I18n',
    'Zend\Router',
    'Zend\Validator',
    'Application',
    'Zend\Form',
    'Blog'
];
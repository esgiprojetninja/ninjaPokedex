<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;
use Zend\Db\Adapter;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module
{
    const VERSION = '3.0.2dev';

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getServiceConfig()
    {
        return [
            Adaper\Adapter::class => function($container) {
                $config = $container->get('config');
                return new Adapter\Adapter($config['db']);
            }
        ];
    }

}

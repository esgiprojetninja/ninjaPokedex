<?php
namespace Pokemon;

use Zend\ModuleManager\ModuleManager;

class Module {
    const VERSION = '1.0.0';
    function getAutoloaderConfig() {
        return [
            'Zend\Loader\ClassMapAutoloader' => [
                __DIR__ . '/autoload_classmap.php',
            ],
            'Zend\Loader\StandardAutoloader' => [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__ . '/src',
                ],
            ],
        ];
    }

    function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

    function getServiceConfig() {
        return include __DIR__ . '/config/service.config.php';
    }

    public function init(ModuleManager $moduleManager)
    {
        $sharedEvents = $moduleManager->getEventManager()->getSharedManager();
        $sharedEvents->attach(__NAMESPACE__, 'dispatch', function($e) {
            // This event will only be fired when an ActionController under the MyModule namespace is dispatched.
            $controller = $e->getTarget();
            $controller->layout('pokedex/layout/layout.phtml');
        }, 100);
    }
}

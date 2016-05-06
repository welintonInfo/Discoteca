<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\ModuleManager\ModuleManager;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Session\Container;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
              
    }
    
   /* public function init(ModuleManager $moduleManager)
    {
        $sharedEvents = $moduleManager->getEventManager()->getSharedManager();
         
        $sharedEvents->attach('Zend\Mvc\Controller\AbstractActionController', 
                                MvcEvent::EVENT_DISPATCH, array($this, 'verificaAutenticacao'), 100);
    }
    * 
    */
   
 
    public function verificaAutenticacao($e)
    {   
        // vamos descobrir onde estamos?
        $controller = $e->getTarget();
        $rota = $controller->getEvent()->getRouteMatch()->getMatchedRouteName();
         
        if ($rota != 'login' && $rota != 'login/default') {
             
            $sessao = new Container('Auth');
            if (!$sessao->admin) {
                return $controller->redirect()->toRoute('login');
            }
             
        }
    }
    

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
}

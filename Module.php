<?php

namespace Website;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

/**
 * Clase para inicializar el modulo de Website.
 * @author Lizzette Cienfuegos
 * @version 1.0
 * @since 1.0
 */
class Module
{
    /**
     * Inicializacion de el modulo de Website.
     * @param MvcEvent $e
     */
    public function onBootstrap(MvcEvent $e)
    {
    }
    /**
     * Regresa la configuracion en un array.
     * @return array
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
    /**
     * Regresa la configuracion del autoloader.
     * @return array
     */
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__
                )
            )
        );
    }
    /**
     * Regresa un arreglo con los servicios que se registraron usando el
     * Service Manager de Zend.
     * @return array
     */
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Website\Form\Contact' => function($sm) {
                    $translator = $sm->get('translator');
                    $contact = new \Website\Form\Contact($translator, $sm);
                    return $contact;
                },

                'Website\Dao\ContactDao' => function($sm) {
                    $dao = new \Website\Dao\ContactDao();
                    $entityManager = $sm->get('Doctrine\ORM\EntityManager');
                    $dao->setEntityManager($entityManager);
                    return $dao;
                },

            ),
        );
    }
}

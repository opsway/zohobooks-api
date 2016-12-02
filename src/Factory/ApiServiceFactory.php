<?php

namespace OpsWay\ZohoBooks\Factory;

use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use OpsWay\ZohoBooks\Api;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

class ApiServiceFactory implements FactoryInterface
{

    /**
     * Create an object
     *
     * @param  ContainerInterface $container
     * @param  string             $requestedName
     * @param  null|array         $options
     *
     * @return object
     * @throws ServiceNotFoundException if unable to resolve the service.
     * @throws ServiceNotCreatedException if an exception is raised when
     *     creating a service.
     * @throws ContainerException if any other error occurs
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $authToken = (isset($options['auth_token'])) ? $options['auth_token'] : null;
        $emailId = (isset($options['email'])) ? $options['email'] : null;
        $password = (isset($options['password'])) ? $options['password'] : null;
        if (!empty($password) && !empty($emailId)) {
            $authToken = $emailId;
        }
        return new Api($authToken, $password);
    }
}

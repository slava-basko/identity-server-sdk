<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 */

namespace Is\Sdk;

use Is\Sdk\Service\AuthService;
use Is\Sdk\Service\Interfaces\AuthService as JsonRpcAuthService;
use Is\Sdk\Service\Interfaces\DomainEntityService;
use Is\Sdk\Service\Interfaces\PermissionService;
use Is\Sdk\Service\Interfaces\PingService;
use Is\Sdk\Service\Interfaces\RoleService;
use Is\Sdk\Service\Interfaces\UserService;
use ProxyManager\Factory\RemoteObject\Adapter\JsonRpc;
use ProxyManager\Factory\RemoteObjectFactory;
use Zend\Json\Server\Client;
use Is\Sdk\Service\Interfaces\EntityEntryService;

class ServiceFactory
{
    /**
     * @param string $jsonRpcUrl
     * @return RemoteObjectFactory
     */
    private static function createRemoteObjectFactory($jsonRpcUrl)
    {
        return new RemoteObjectFactory(
            new JsonRpc(
                new Client($jsonRpcUrl)
            )
        );
    }

    /**
     * @param string $jsonRpcUrl
     * @return PingService
     */
    public static function createPingService($jsonRpcUrl)
    {
        return self::createRemoteObjectFactory($jsonRpcUrl)->createProxy(PingService::class);
    }

    /**
     * @param $jsonRpcUrl
     * @return DomainEntityService
     */
    public static function createDomainEntityService($jsonRpcUrl)
    {
        return self::createRemoteObjectFactory($jsonRpcUrl)->createProxy(DomainEntityService::class);
    }

    /**
     * @param $jsonRpcUrl
     * @return PermissionService
     */
    public static function createPermissionService($jsonRpcUrl)
    {
        return self::createRemoteObjectFactory($jsonRpcUrl)->createProxy(PermissionService::class);
    }

    /**
     * @param $jsonRpcUrl
     * @return RoleService
     */
    public static function createRoleService($jsonRpcUrl)
    {
        return self::createRemoteObjectFactory($jsonRpcUrl)->createProxy(RoleService::class);
    }

    /**
     * @param $jsonRpcUrl
     * @return UserService
     */
    public static function createUserService($jsonRpcUrl)
    {
        return self::createRemoteObjectFactory($jsonRpcUrl)->createProxy(UserService::class);
    }

    /**
     * @param $jsonRpcUrl
     * @return AuthService
     */
    public static function createAuthService($jsonRpcUrl)
    {
        return new AuthService(self::createRemoteObjectFactory($jsonRpcUrl)->createProxy(JsonRpcAuthService::class));
    }

    /**
     * @param $jsonRpcUrl
     * @return EntityEntryService
     */
    public static function createEntityEntryService($jsonRpcUrl)
    {
        return self::createRemoteObjectFactory($jsonRpcUrl)->createProxy(EntityEntryService::class);
    }

}
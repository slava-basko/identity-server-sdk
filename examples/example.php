<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 */
require dirname(__FILE__) . '/../vendor/autoload.php';

use Is\Sdk\ServiceFactory;

$service = ServiceFactory::createPingService('http://localhost:8087');
var_dump($service->ping());

$domainEntityService = ServiceFactory::createDomainEntityService('http://localhost:8087');
$permissionService = ServiceFactory::createPermissionService('http://localhost:8087');
$roleService = ServiceFactory::createRoleService('http://localhost:8087');
$userService = ServiceFactory::createUserService('http://localhost:8087');
$authService = ServiceFactory::createAuthService('http://localhost:8087');


var_dump($domainEntityService->create('satellite'));
var_dump($domainEntityService->getList());

var_dump($permissionService->create('create', 'satellite', ['date.format("d") > 15']));
var_dump($permissionService->create('update', 'satellite'));
var_dump($permissionService->getList());

var_dump($roleService->save('operator', ['create.satellite']));
var_dump($roleService->save('operator', ['create.satellite', 'update.satellite']));
var_dump($roleService->save('operator', ['update.satellite']));
var_dump($roleService->save('operator', ['create.satellite', 'update.satellite']));
var_dump($roleService->save('junior_operator', ['update.satellite']));
var_dump($roleService->getList());
var_dump($roleService->delete('junior_operator'));
var_dump($roleService->getList());
var_dump($roleService->save('junior_operator', ['update.satellite']));

var_dump($userService->register('john.doe@gmail.com', 'super_pass'));
var_dump($userService->resetPassword('john.doe@gmail.com', 'qwe123'));
var_dump($userService->delete('john.doe@gmail.com'));
var_dump($userService->register('john.doe@gmail.com', 'super_pass'));
var_dump($userService->assignRoles('john.doe@gmail.com', ['junior_operator']));
var_dump($userService->assignRoles('john.doe@gmail.com', ['junior_operator', 'operator']));

$token = $authService->login('john.doe@gmail.com', 'super_pass');
var_dump($token);
$answer = $authService->checkPermission('create.satellite', $token->getToken());
var_dump($answer);
<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 */

namespace Is\Sdk\Service\Interfaces;

use Is\Sdk\Auth\Token;
use Is\Sdk\Value\Answer;

interface AuthService
{
    /**
     * @param string $email
     * @param string $password
     * @param string|bool $ip
     * @param string|bool $userAgent
     * @return mixed
     */
    public function login($email, $password, $ip = false, $userAgent = false);

    /**
     * @param string $permissionAlias
     * @param string $token
     * @return Answer
     */
    public function checkPermission($permissionAlias, $token);
}
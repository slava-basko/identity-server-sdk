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
     * @return Token
     */
    public function login($email, $password);

    /**
     * @param string $permissionAlias
     * @param string $token
     * @return Answer
     */
    public function checkPermission($permissionAlias, $token);
}
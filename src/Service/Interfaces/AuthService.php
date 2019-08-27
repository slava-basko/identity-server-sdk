<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 */

namespace Is\Sdk\Service\Interfaces;

use Is\Sdk\Auth\Token;
use Is\Sdk\Value\Answer;

interface AuthService
{
    /**\
     * @param $email
     * @param $password
     * @param array|null $additionalData
     * @return mixed
     */
    public function login($email, $password, $additionalData = null);

    /**
     * @param string $permissionAlias
     * @param string $token
     * @return Answer
     */
    public function checkPermission($permissionAlias, $token);
}
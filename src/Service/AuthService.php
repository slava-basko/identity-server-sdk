<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 */

namespace Is\Sdk\Service;

use Is\Sdk\Auth\Token;
use Is\Sdk\Auth\User;
use Is\Sdk\Value\Answer;
use Is\Sdk\Service\Interfaces\AuthService as JsonRpdAuthService;

class AuthService
{
    /**
     * @var JsonRpdAuthService
     */
    private $authService;

    /**
     * AuthService constructor.
     * @param JsonRpdAuthService $authService
     */
    public function __construct(JsonRpdAuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * @param $email
     * @param $password
     * @param array|null $additionalData
     * @return Token
     */
    public function login($email, $password, $additionalData = null)
    {
        $data = $this->authService->login($email, $password, $additionalData);
        return Token::fromArray($data);
    }

    /**
     * @param string $permissionAlias
     * @param Token|string $token
     * @return Answer
     */
    public function checkPermission($permissionAlias, $token)
    {
        if ($token instanceof Token) {
            $token = $token->getToken();
        }
        $data = $this->authService->checkPermission($permissionAlias, $token);
        return new Answer($data['answer'], $data['rules'], User::fromArray($data['user']), $data['aces']);
    }
}
<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 */

namespace Is\Sdk\Auth;

class Token implements \JsonSerializable
{
    /**
     * @var User
     */
    private $user;

    /**
     * @var
     */
    private $token;

    /**
     * @var int
     */
    private $expired;

    /**
     * Token constructor.
     * @param User $user
     * @param $token
     * @param $expired
     */
    public function __construct(User $user, $token, $expired)
    {
        $this->user = $user;
        $this->token = $token;
        $this->expired = $expired;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @return int
     */
    public function getExpired()
    {
        return $this->expired;
    }

    /**
     * @return array
     */
    function jsonSerialize()
    {
        return [
            'user' => $this->user,
            'token' => $this->token,
            'expired' => $this->expired
        ];
    }

    /**
     * @param $data
     * @return Token
     */
    public static function fromArray($data)
    {
        return new static(User::fromArray($data['user']), $data['token'], $data['expired']);
    }
}
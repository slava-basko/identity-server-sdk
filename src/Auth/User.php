<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 */

namespace Is\Sdk\Auth;

class User implements \JsonSerializable
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $email;

    /**
     * @var array
     */
    private $roles;

    /**
     * User constructor.
     * @param string $id
     * @param string $email
     * @param array $roles
     */
    public function __construct($id, $email, array $roles = [])
    {
        $this->id = $id;
        $this->email = $email;
        $this->roles = $roles;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'roles' => $this->roles
        ];
    }

    /**
     * @param $data
     * @return User
     */
    public static function fromArray($data)
    {
        return new static($data['id'], $data['email'], $data['roles']);
    }

    /**
     * @return array
     */
    public function getRoles()
    {
        return $this->roles;
    }
}
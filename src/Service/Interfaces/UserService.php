<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 */

namespace Is\Sdk\Service\Interfaces;

/**
 * Interface UserService
 * @package Is\Sdk\Service
 */
interface UserService
{
    /**
     * @param string $email
     * @param string $password
     * @return bool
     */
    public function register($email, $password);

    /**
     * @param string $email
     * @param string[] $roles
     * @return bool
     */
    public function assignRoles($email, array $roles);

    /**
     * @param string $email
     * @param string $newPassword
     * @return bool
     */
    public function resetPassword($email, $newPassword);

    /**
     * @param string $email
     * @return bool
     */
    public function delete($email);
}
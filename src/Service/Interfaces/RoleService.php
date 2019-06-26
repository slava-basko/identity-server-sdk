<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 */

namespace Is\Sdk\Service\Interfaces;

/**
 * Interface RoleService
 * @package Is\Sdk\Service
 */
interface RoleService
{
    /**
     * @param string $name
     * @param string[] $permissions Aliases of permissions
     * @return bool
     */
    public function save($name, array $permissions);

    /**
     * @return array
     */
    public function getList();

    /**
     * @param string $name
     * @return bool
     */
    public function delete($name);
}
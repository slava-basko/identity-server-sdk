<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 */

namespace Is\Sdk\Service\Interfaces;

/**
 * Interface PermissionService
 * @package Is\Sdk\Service
 */
interface PermissionService
{
    /**
     * @param string $operation
     * @param string $domainEntity
     * @param array $bizRules
     * @return bool
     */
    public function create($operation, $domainEntity, array $bizRules = []);

    /**
     * @return array
     */
    public function getList();

    /**
     * @param string $alias
     * @return bool
     */
    public function delete($alias);
}
<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 */

namespace Is\Sdk\Service\Interfaces;

/**
 * Interface DomainEntityService
 * @package Is\Sdk\Service
 */
interface DomainEntityService
{
    /**
     * @param string $name
     * @return bool
     */
    public function create($name);

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
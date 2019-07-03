<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 */

namespace Is\Sdk\Service\Interfaces;


/**
 * Interface EntityEntryService
 * @package Is\Sdk\Service
 */
interface EntityEntryService
{
    /**
     * @param $domainEntity
     * @param $entityExternalId
     * @param $userEmail
     * @return bool
     */
    public function create($domainEntity, $entityExternalId, $userEmail);

    /**
     * @param string $name
     * @return bool
     */
    public function delete($name);
}
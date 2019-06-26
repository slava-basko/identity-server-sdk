<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 */

namespace Is\Sdk\Service\Interfaces;

/**
 * Interface PingService
 * @package Is\Sdk\Service
 */
interface PingService
{
    /**
     * @return string
     */
    public function ping();
}
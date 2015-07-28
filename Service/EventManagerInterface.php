<?php
/**
 * Created by PhpStorm.
 * User: meven.cadare
 * Date: 28/07/2015
 * Time: 09:53
 */

namespace MCadare\EventHub\Service;

/**
 * Interface EventManagerInterface
 *
 * Interface which should be implemented by the downstream event manager
 *
 * @package MCadare\EventHub\Service
 */
interface EventManagerInterface
{
    /**
     * trigger an event hub downstream event
     *
     * @param $eventName
     * @param $event
     * @param array $params
     */
    public function trigger($eventName, $event = null, $params = []);
}

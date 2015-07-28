<?php
/**
 * Created by PhpStorm.
 * User: meven.cadare
 * Date: 27/07/2015
 * Time: 15:54
 */

namespace MCadare\EventHub\Event;

/**
 * Interface EventHubAwareInterface
 *
 * this interface must be implemented by any event object using this bundle
 *
 * @package MCadare\EventHub\Event
 */
interface EventHubAwareInterface
{
    /**
     * return event status
     *
     * @return string
     */
    public function getStatus();

    /**
     * return event name
     *
     * @return string
     */
    public function getName();
}

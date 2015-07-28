<?php
/**
 * Created by PhpStorm.
 * User: meven.cadare
 * Date: 27/07/2015
 * Time: 15:34
 */

namespace MCadare\EventHub\Listener;

use MCadare\EventHub\Event\EventHubAwareInterface;

/**
 * Interface EventHubListenerInterface
 *
 * Interface which must be implement for any event_hub listener service
 *
 * @package MCadare\EventHub\Listener
 */
interface EventHubListenerInterface
{
    /**
     * handle incoming business event
     *
     * @param EventHubAwareInterface $event
     * @return void
     */
    public function handleHubEvent(EventHubAwareInterface $event);
}

<?php

namespace MCadare\EventHub\Listener;

use MCadare\EventHub\Constant\Configs;
use MCadare\EventHub\Event\EventHubAwareInterface;
use MCadare\EventHub\Event\FlashMessageParametersInterface;
use MCadare\EventHub\Service\EventManagerInterface;
use MCadare\FlashMessageHandler\Factory\FlashMessageEventFactory;
use MCadare\FlashMessageHandler\Factory\FlashMessageEventFactoryInterface;
use MCadare\FlashMessageHandler\Constant\Events;

/**
 * Classe EventHubListener
 *
 * service listening to configured custom events and firing downstreams events depending
 * on the configuration and interfaces implemented by the event object
 *
 * Projet : mcadare_bundles
 * Fichier créé par meven.cadare le 27/07/2015 à 15:33
 *
 * @copyright Copyright mcadare_bundles © 2015, All Rights Reserved
 * @author    MCADARE
 */
class EventHubListener implements EventHubListenerInterface
{
    /**
     * event_hub configuration
     *
     * @var array
     */
    protected $config;

    /**
     * Event manager used to fire downstream events
     *
     * @var EventManagerInterface
     */
    protected $eventManager;

    /**
     * Factory in charge of building FlashMessageAwareInterface compliant event objects
     *
     * @var FlashMessageEventFactoryInterface
     */
    protected $flashMessageEventFactory;

    /**
     * initialize conguration (mandatory) and set the default Factory
     * @param $config
     */
    public function __construct($config)
    {
        $this->config                   = $config;
        $this->flashMessageEventFactory = new FlashMessageEventFactory();
    }

    /**
     * handle incoming business event
     *
     * @param EventHubAwareInterface $event
     * @return void
     */
    public function handleHubEvent(EventHubAwareInterface $event)
    {
        if (!isset($this->config[$event->getName()])) {
            return;
        }

        $eventConfig = $this->config[$event->getName()];

        if (isset($eventConfig[Configs::FLASH_KEY])) {
            $this->dispatchFlashMessageEvent($event, $eventConfig[Configs::FLASH_KEY]);
        }
    }

    /**
     * Dispatches a downstream event to display a flash message to the user
     *
     * @param EventHubAwareInterface $event
     * @param $config
     */
    private function dispatchFlashMessageEvent(EventHubAwareInterface $event, $config)
    {

        $status = $event->getStatus();
        if (!$event instanceof FlashMessageParametersInterface && !isset($config[$event->getStatus()])) {
            return;
        }

        $flashMessageEvent = $this->flashMessageEventFactory->build(
            $config[$status][Configs::FLASH_MESSAGE_CODE_KEY],
            $config[$status][Configs::FLASH_MESSAGE_LEVEL_KEY],
            $event->getFlashMessageParameters()
        );

        $this->getEventManager()->trigger(Events::FLASH_MESSAGE, $flashMessageEvent);
    }

    /**
     * @return EventManagerInterface
     */
    public function getEventManager()
    {
        return $this->eventManager;
    }

    /**
     * @param EventManagerInterface $eventManager
     */
    public function setEventManager($eventManager)
    {
        $this->eventManager = $eventManager;
    }

    /**
     * @return FlashMessageEventFactoryInterface
     */
    public function getFlashMessageEventFactory()
    {
        return $this->flashMessageEventFactory;
    }

    /**
     * @param FlashMessageEventFactoryInterface $flashMessageEventFactory
     */
    public function setFlashMessageEventFactory(FlashMessageEventFactoryInterface $flashMessageEventFactory)
    {
        $this->flashMessageEventFactory = $flashMessageEventFactory;
    }
}

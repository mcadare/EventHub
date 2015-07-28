<?php
/**
 * Created by PhpStorm.
 * User: meven.cadare
 * Date: 27/07/2015
 * Time: 16:44
 */

namespace MCadare\EventHub\Event;

/**
 * Interface FlashMessageParametersInterface
 *
 * this interface must be implemented by custom events handling flash messages
 *
 * @package MCadare\EventHub\Event
 */
interface FlashMessageParametersInterface
{
    /**
     * return an associative array of pattern and values to replace in the flash message content
     *
     * @return array
     */
    public function getFlashMessageParameters();
}

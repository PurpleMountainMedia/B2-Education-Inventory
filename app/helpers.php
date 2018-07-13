<?php

/**
 * Get the name in the system for a specific type of item.
 *
 * @param string $type
 * @param boolean $plural
 * @param boolean $caps
 * @param string $lang
 * @return string
 */
function getTypeName($type, $plural = false, $caps = false, $lang = 'en')
{
    switch ($type) {
      case 'item':
        $name = 'item';
        break;
      case 'room':
        $name = 'room';
        break;
      case 'building':
        $name = 'building';
        break;
      case 'item-type':
        $name = 'Itemtype';
        break;
      default:
        $name = null;
        break;
    }

    if ($name) {
        $name = $caps ? ucfirst($name) : $name;
        return $plural ? str_plural($name) : $name;
    }
}

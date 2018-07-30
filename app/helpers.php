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
        $name = 'itemtype';
        break;
      case 'report':
        $name = 'report';
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

/**
 * Determine what is in the include section of the request.
 *
 * @param string $key
 * @return bool
 */
function requestIncludes($key)
{
    $include = request()->include;
    if (!is_array($include)) {
        $include = explode(',', str_replace(' ', '', $include));
    }
    return in_array($key, $include);
}

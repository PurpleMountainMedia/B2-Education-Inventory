<?php

use Carbon\Carbon;

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
      case 'item-category':
        $name = 'item category';
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

/**
 * Return the human name for each method
 *
 * @param string $method The name of the method
 * @return string
 */
function getMethodName($method)
{
    switch ($method) {
        case 'POST':
            return 'create';
            break;

        case 'GET':
            return 'read';
            break;

        case 'PUT':
            return 'update';
            break;

        case 'DELETE':
            return 'delete';
            break;

        default:
            return 'update';
            break;
    }
}

/**
 * Return the name for each type of parent property.
 *
 * @param string $request The request
 * @return string
 */
function getRequestParentProperty($request)
{
    $user = $request->user();
    if ($request->building) {
        return $user->hasAccessTo($request->building) ? $request->building->name : 'this building';
    }
    if ($request->room) {
        return $user->hasAccessTo($request->room) ? $request->room->name : 'this room';
    }
    return 'this property';
}

function dtFromInput($input = null, $format = 'd/m/Y')
{
    return $input ? Carbon::createFromFormat($format, $input)->toDateTimeString() : null;
}

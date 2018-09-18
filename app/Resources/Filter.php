<?php

namespace App\Resources;

class Filter
{
    use Fillable;

    /**
     * The attribute of the filter.
     *
     * @var string
     */
    public $attribute;

    /**
     * The operator of the filter.
     *
     * @var string
     */
    public $operator;

    /**
     * The value of the filter.
     *
     * @var string
     */
    public $value;

    /**
     * The type of the filter.
     *
     * @var string
     */
    public $type;

    /**
     * The server format of the filter.
     *
     * @var string
     */
    public $serverFormat;

    /**
     * The client format of the filter.
     *
     * @var string
     */
    public $clientFormat;

    public function __construct(array $filter)
    {
        $this->fill($filter);
    }
}

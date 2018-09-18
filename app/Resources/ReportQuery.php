<?php

namespace App\Resources;

class ReportQuery
{
    use Fillable;

    public $schoolId;

    public $roomId;

    public $withCount;

    public $filters;

    public $include;

    public $with;

    public $search;

    public function __construct($reportQuery)
    {
        $this->fill($reportQuery);
    }
}

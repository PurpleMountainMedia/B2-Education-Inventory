<?php

namespace App\Traits;
use Carbon\Carbon;

trait ResponsableTrait
{

    protected $self = '';

    /**
     * Format the query and return a standardised basic response.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeBasicResponse($query, $orderBy = null)
    {
        $request = request();

        if ($request->filled('search') && !empty($this->responsableSearch())) {
            $query->where(function ($query) use ($request) {
                foreach ($this->responsableSearch() as $key => $search) {
                    $query->orWhere("{$this->getTable()}.{$search}", 'like', '%' . $request->search . '%');
                }
            });
        }

        $query = $query->responseAdapter($orderBy);

        return $query;
    }

    /**
     * Add the response adapter scope to the query
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeResponseAdapter($query, $orderBy = null)
    {
        $request = request();

        if (!$orderBy) {
            if ($request->filled('orderBy') && array_key_exists($request->orderBy, $this->responsableOrderByAlias())) {
                $orderBy = $this->responsableOrderByAlias()[$request->orderBy];
            } else {
                $orderBy = $this->responsableOrderBy();
            }
        }

        $direction = $request->filled('ascending') ?
            ($request->ascending == 1 ? "ASC" : "DESC") :
            $this->responsableDirection();
        $limit = $request->filled('limit') ? $request->limit : $this->responsableLimit();

        $query = $this->responsableExtendQuery($query, $request);

        return $query->orderBy($orderBy, $direction)
                     ->paginate($limit);
    }

    public function scopeFilterable($query)
    {
        $this->self = str_plural(strtolower(str_replace("App\\", "", static::class))) ?? '';
        $request = request();
        $filters = ($request->filters && is_array($request->filters)) ? $request->filters : [];

        foreach ($filters ?? [] as $key => $filter) {
            $filter = json_decode($filter);
            $operator = camel_case($filter->operator);
            $capsOperator = ucFirst($operator);
            $methodName = "filter{$capsOperator}";
            $scopeMethodName = "scopeFilter{$capsOperator}";
            $isDate = $filter->type === 'date';

            if ($isDate && $filter->serverFormat) {
                $filter->value = Carbon::createFromFormat($filter->serverFormat, $filter->value)->toDateString();
            }

            if (array_key_exists($filter->attribute, $this->responsableFilterNameAlias())) {
                $filter->attribute = $this->responsableFilterNameAlias()[$filter->attribute];
            }

            if (array_key_exists("{$filter->attribute}.{$filter->operator}", $this->responsableFilterScopeAlias())) {
                $methodName = $this->responsableFilterScopeAlias()["{$filter->attribute}.{$filter->operator}"];
                $capsMethodName = ucFirst($methodName);
                $scopeMethodName = "scope{$capsMethodName}";
            }

            if (method_exists($this, $scopeMethodName)) {
                $query->$methodName($filter, $isDate);
            }
        }
        return $query;
    }

    public function scopeFilterEquals($query, $filter, $isDate)
    {
        $method = $isDate ? 'whereDate' : 'where';
        return $filter->value ? $query->$method("{$this->self}.{$filter->attribute}", '=', $filter->value) : $query;
    }

    public function scopeFilterNotEquals($query, $filter, $isDate)
    {
        $method = $isDate ? 'whereDate' : 'where';
        return $filter->value ? $query->$method("{$this->self}.{$filter->attribute}", '!=', $filter->value) : $query;
    }

    public function scopeFilterStartsWith($query, $filter)
    {
        return $filter->value ? $query->where("{$this->self}.{$filter->attribute}", 'LIKE', $filter->value . '%') : $query;
    }

    public function scopeFilterEndsWith($query, $filter)
    {
        return $filter->value ? $query->where("{$this->self}.{$filter->attribute}", 'LIKE', '%' . $filter->value) : $query;
    }

    public function scopeFilterIncludes($query, $filter)
    {
        return $filter->value ? $query->where("{$this->self}.{$filter->attribute}", 'LIKE', '%' . $filter->value . '%') : $query;
    }

    public function scopeFilterNotIncludes($query, $filter)
    {
        return $filter->value ? $query->where("{$this->self}.{$filter->attribute}", 'NOT LIKE', '%' . $filter->value . '%') : $query;
    }

    public function scopeFilterLessThan($query, $filter, $isDate)
    {
        $method = $isDate ? 'whereDate' : 'where';
        return $filter->value ? $query->$method("{$this->self}.{$filter->attribute}", '<', $filter->value) : $query;
    }

    public function scopeFilterGreaterThan($query, $filter, $isDate)
    {
        $method = $isDate ? 'whereDate' : 'where';
        return $filter->value ? $query->$method("{$this->self}.{$filter->attribute}", '>', $filter->value) : $query;
    }

    /**
     * Format the query and return a standardised basic response.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    private function searchIsString()
    {
        $request = request();

        if ($request->filled('search') && is_object(json_decode($request->search))) {
            return false;
        }

        return is_string($request->search);
    }

    /**
     * The default direction of models.
     *
     * @return string
     */
    private function responsableDirection()
    {
        return "DESC";
    }

    /**
     * The default collumn to order results by.
     *
     * @return string
     */
    private function responsableOrderBy()
    {
        return "id";
    }

    /**
     * The default amount of results to return.
     *
     * @return int
     */
    private function responsableLimit()
    {
        return 15;
    }

    /**
     * Which collumns to use for search.
     *
     * @return array
     */
    private function responsableSearch()
    {
        return [
          'id',
          'name'
        ];
    }

    /**
     * Which collumns to use for search.
     *
     * @return array
     */
    private function responsableOrderByAlias()
    {
        return [];
    }

    /**
     * Which collumns to use for filter.
     *
     * @return array
     */
    private function responsableFilterNameAlias()
    {
        return [];
    }

    /**
     * Which scopes to use for filter.
     *
     * @return array
     */
    private function responsableFilterScopeAlias()
    {
        return [];
    }

    /**
     * Extend the query used.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Database\Eloquent\Builder
     */
    private function responsableExtendQuery($query, $request)
    {
        return $query;
    }
}

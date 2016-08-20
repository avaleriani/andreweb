<?php

namespace App\Traits;


use Illuminate\Database\Eloquent\Builder;

trait SearchTrait
{

    public function scopeSearch(Builder $q, $search)
    {
        $prefix = $this->table;
        if ($this->searchable) {
            $columns = [];
            foreach ($this->searchable as $column) {
                $columns[] = $prefix . '.' . $column;
            }
            $match = implode(',', $columns);
            $q->whereRaw("MATCH ($match) AGAINST (?)" , array($search));
        }
        return $q;
    }

}
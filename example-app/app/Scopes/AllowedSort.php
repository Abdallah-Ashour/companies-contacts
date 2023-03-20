<?php
namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;

trait AllowedSort{
    public function parseSortDirection($column = null){
        return strpos($column ?? request()->query("sort_by"), "-") === 0 ? "desc" : "asc";
    }
    public function parseSortColumn($column = null){
        return ltrim($column ?? request()->query("sort_by"), "-");
    }

    public function scopeAllowedSorts(Builder $query, array $columns, $defaultColum = null){
        $column = $this->parseSortColumn();
        if(in_array($column, $columns)){

            return $query->orderBy($column, $this->parseSortDirection());
        }
        if(!$column && $defaultColum){
            return $query->orderBy($this->parseSortColumn($defaultColum), $this->parseSortDirection($defaultColum));

        }
        return $query;
   }
}
?>

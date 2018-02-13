<?php

namespace App\Traits\Eloquent;

trait SearchLikeTrait
{
    /**
     * @param $query
     * @param $field
     * @param $value
     * @param bool $isOr
     * @return mixed
     */
    public function scopeLike($query, $field, $value, $isOr = false)
    {
        if ($isOr) {
            return $query->orWhere($field, 'LIKE', "%$value%");
        }

        return $query->where($field, 'LIKE', "%$value%");
    }
}

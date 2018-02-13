<?php

namespace App\Traits\Models;

trait FillableFields
{
    /**
     * @return array
     */
    public static function getFillableFields()
    {
        return (new static())->getFillable();
    }

    /**
     * @return mixed
     */
    public function getRecordTitle()
    {
        return $this->id;
    }
}

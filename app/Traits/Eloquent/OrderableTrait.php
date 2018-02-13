<?php

namespace App\Traits\Eloquent;

use App\Utils;
use Carbon\Carbon;

trait OrderableTrait
{
    public function scopeLatestFirst($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeCreatedToday($query)
    {
        $today = Carbon::now(Utils::getTz())->startOfDay()->timezone('UTC');
        return $query->where('created_at', '>=', $today->format('Y-m-d H:i:s'));
    }

    /**
     * @param $query
     * @param $from
     * @param $to
     * @param string $format
     * @return mixed
     */
    public function scopeCreatedRange($query, $from, $to, $format = null)
    {
        $format = $format ? $format : 'Y-m-d';

        if (! empty($from)) {
            $from = Carbon::createFromFormat($format, $from, Utils::getTz())->startOfDay()->timezone('UTC');
        }

        if (! empty($to)) {
            $to = Carbon::createFromFormat($format, $to, Utils::getTz())->endOfDay()->timezone('UTC');
        }

        if (! empty($from) && ! empty($to)) {
            return $query->whereBetween('created_at', [
                $from->format('Y-m-d H:i:s'),
                $to->format('Y-m-d H:i:s')
            ]);
        } else {
            if (! empty($from)) {
                $query = $query->where('created_at', '>=', $from->format('Y-m-d H:i:s'));
            }

            if (! empty($to)) {
                $query = $query->where('created_at', '<=', $to->format('Y-m-d H:i:s'));
            }
        }

        return $query;
    }
}

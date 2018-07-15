<?php

namespace App\Traits\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

trait BulkDelete
{
    public function bulkDelete(array $ids)
    {
        return DB::transaction(function () use ($ids) {
            try {
                self::query()->whereIn('id', $ids)->delete();
            } catch (\Exception $e) {
                Log::error($e);

                return false;
            }

            return true;
        }, 3);
    }
}

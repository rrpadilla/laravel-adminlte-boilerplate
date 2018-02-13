<?php

namespace App;

use App\User;
use Illuminate\Support\Facades\Auth;

class Reports
{
    private $totalUsers;

    /**
     * @return integer
     */
    public function getTotalUsers()
    {
        if (is_null($this->totalUsers)) {
            $this->totalUsers = User::count();
        }

        return $this->totalUsers;
    }
}

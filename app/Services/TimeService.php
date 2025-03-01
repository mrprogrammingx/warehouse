<?php

namespace App\Services;

use Hekmatinasser\Verta\Verta;

/**
 * Class TimeService
 * @package App\Services
 */
class TimeService
{
    protected $verta;
    public function __construct()
    {
        $this->verta = new Verta();
    }

    public function currentYear()
    {
        return $this->verta->year;
    }

    public function currentMonth()
    {
        return $this->verta->month;
    }

    public function currentDay()
    {
        return $this->verta->day;
    }

    public function currentDate()
    {
        return $this->verta;
    }

    public function currentManualDate()
    {
        return $this->currentYear() . '/' . $this->currentMonth() . '/' . $this->currentDay();
    }
}

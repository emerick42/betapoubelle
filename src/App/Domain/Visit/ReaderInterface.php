<?php

namespace App\Domain\Visit;

interface ReaderInterface
{
    /**
     * Get the current number of visits.
     *
     * @return int
     */
    public function getVisits();
}

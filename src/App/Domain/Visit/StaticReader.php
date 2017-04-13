<?php

namespace App\Domain\Visit;

class StaticReader implements ReaderInterface
{
    /**
     * {@inheritdoc}
     */
    public function getVisits()
    {
        return 0;
    }
}

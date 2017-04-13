<?php

namespace App\Domain\Api;

interface ClientInterface
{
    /**
     * Retrieve informations about the member connected.
     *
     * @return Member|null
     */
    public function getMemberInformations();
}

<?php

namespace App\Application\Query\Astronaute;

class FindQuery
{
    /** @var string */
    public $astronauteId;

    public function __construct(string $astronauteId)
    {
        $this->astronauteId = $astronauteId;
    }
}

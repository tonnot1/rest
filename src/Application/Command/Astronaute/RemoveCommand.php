<?php

namespace App\Application\Command\Astronaute;
class RemoveCommand
{
    /** @var string */
    public $astronauteId;

    public function __construct(string $astronauteId)
    {
        $this->astronauteId = $astronauteId;
    }
}

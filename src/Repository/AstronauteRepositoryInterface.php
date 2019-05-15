<?php

namespace App\Repository;

use App\Entity\Astronaute;

interface AstronauteRepositoryInterface
{
    public function add($data);

    public function set(Astronaute $astronaute);

    public function remove(Astronaute $astronaute);
}

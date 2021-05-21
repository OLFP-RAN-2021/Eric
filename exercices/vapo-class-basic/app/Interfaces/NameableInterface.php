<?php

namespace App\Interfaces;

interface NameableInterface
{

    public function getName(): string;
    public function setName(string $newName): void;
}

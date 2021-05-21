<?php

namespace App\Interfaces;

use App\Model\Vapo;

interface MountableInterface
{
    public function dismount(Vapo $vapo): bool;
    public function isMount(): bool;
    public function mount(Vapo $vapo): bool;
}

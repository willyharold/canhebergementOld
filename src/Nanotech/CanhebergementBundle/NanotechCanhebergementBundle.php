<?php

namespace Nanotech\CanhebergementBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class NanotechCanhebergementBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}

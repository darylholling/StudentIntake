<?php

namespace IntakeBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class IntakeBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}

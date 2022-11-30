<?php

declare(strict_types= 1);

namespace App\Controller\Api;

use App\Repository\UserRepository;

class UserApiController
{
    public function getALL():void
    {
        $rep = new UserRepository();
        $usuarios = $rep->findAll();
        echo json_encode( $usuarios);
    }
}
<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UnluckyController{
    /**
     * @Route("/unlucky/number")
     */
    public function unlucky(){
        $number = 13;

        return new Response(
            '<html><body>Lucky number: '.$number.'</body></html>'
        );
    }
}
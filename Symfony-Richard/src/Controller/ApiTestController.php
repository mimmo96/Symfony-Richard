<?php
// src/Controller/ApiTestController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use GuzzleHttp\Client;
use Symfony\Component\Routing\Annotation\Route;



class ApiTestController extends AbstractController
{
    /**
     * @Route("/test/root")
     */
    public function get_root(): Response
    {

        $client = new Client([
            "base_uri" => "http://localhost:8002",
            "timeout" => 2.0,
        ]);

        $response = $client->request("GET", "/users/1");

        // echo $response->getBody();

        
        return new Response(
            (string) $response->getBody()
        );
    }
}
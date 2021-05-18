<?php
// src/Controller/UserController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use GuzzleHttp\Client;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormBuilderInterface;
use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class UserController extends AbstractController
{
    /**
     * @Route("/register/user")
     */
    public function register_user(Request $request): Response
    {
        $user = new User();

        $form = $this->createFormBuilder($user)
            ->add('nickname', TextType::class)
            ->add('email', TextType::class)
            ->add('password', TextType::class)
            ->add('register', SubmitType::class, ['label' => 'Register to the app'])
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $user = $form->getData();

            $client = new Client([
                "base_uri" => "http://localhost:8002",
                "timeout" => 2.0,
            ]);
    
            $response = $client->request("POST", "/register_user", [
                "json" => [
                    "nickname" => $user->getNickname(),
                    "email" => $user->getEmail(),
                    "password" => $user->getPassword()
                ]
            ]);
    
            return new Response(
                $response->getStatusCode()
            );
        }

        return $this->render('app/user_registration.html.twig', [
            'form' => $form->createView(),
        ]);

    }
}
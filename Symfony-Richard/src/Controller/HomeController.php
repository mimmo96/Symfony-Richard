<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Entity\Comment;
use GuzzleHttp\Client;
use App\Form\CommentForm;
use App\Entity\ConnectionHelper;

class HomeController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function appreciate_richard(Request $request): Response
    {
        $helper = new ConnectionHelper();
        $client = $helper->getClient();

        $user_comment = new Comment();

        $form = $this->createForm(CommentForm::class, $user_comment);
    
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $user_comment = $form->getData();

            $json = [
                "nickname" => $user_comment->getNickname(),
                "email" => $user_comment->getEmail(),
                "text" => $user_comment->getText() 
            ];

            $response = $helper->postRequest("/register_comment", $json);
            return $this->redirectToRoute('home');
        }

        $response = $helper->getRequest("/comments/all");
        $body = $response->getBody();
        $comments = json_decode($body, TRUE);

        return $this->render('app/home.html.twig', ["comments" => $comments, 'form' => $form->createView()]);
    }
}

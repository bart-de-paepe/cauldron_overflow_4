<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class QuestionController extends AbstractController
{
    public function homepage(): Response
    {
        return new Response('First text');
    }

    public function show($slug): Response
    {
        return $this->render('question/show.html.twig', [
            'question' => $slug
        ]);
    }
}
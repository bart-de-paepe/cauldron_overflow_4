<?php

namespace App\Controller;

use App\Service\MarkdownHelper;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class QuestionController extends AbstractController
{
    private LoggerInterface $logger;
    private bool $isDebug;

    public function __construct(LoggerInterface $logger, bool $isDebug, ParameterBagInterface $parameterBag) {


        //dd($parameterBag->get('kernel.environment'));

        $this->logger = $logger;
        $this->isDebug = $isDebug;
    }

    public function homepage(Environment $twigEnvironment): Response
    {
        //return $this->render('question/homepage.html.twig');
        $html = $twigEnvironment->render('question/homepage.html.twig');
        return new Response($html);
    }

    public function show($slug, MarkdownHelper $markdownHelper): Response
    {
        if($this->isDebug){
            $this->logger->info('we are in debug mode');
        }
        $questionText = "I've been turned into a cat, any thoughts on how to turn back? While I'm **adorable**, I don't really care for cat food.";
        $parsedQuestionText = $markdownHelper->parse($questionText);
        /*$parsedQuestionText = $cache->get('markdown_'.md5($questionText), function () use ($questionText, $markdownParser) {
            return $markdownParser->transformMarkdown($questionText);
        });

        dump($cache);
        */
        $answers = [
            'Make sure your cat is sitting `purrrfectly` still 🤣',
            'Honestly, I like furry shoes better than `MY` cat',
            'Maybe... try saying `the` spell backwards?',
        ];

        return $this->render('question/show.html.twig', [
            'question' => ucwords(str_replace('-', ' ', $slug)),
            'answers' => $answers,
            'questionText' => $parsedQuestionText
        ]);
    }
}
<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class CommentController extends AbstractController
{
    public function commentVote($id, $direction, LoggerInterface $logger) {
        //todo use id to query database

        if ($direction === "up") {
            $logger->info('Voting up');
            $currentVoteCount = rand(7, 100);
        }
        else {
            $logger->info('Voting down');
            $currentVoteCount = rand(0, 5);
        }

        //return json
        return new JsonResponse(['votes' => $currentVoteCount]);
    }

}
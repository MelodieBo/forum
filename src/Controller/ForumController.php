<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ThreadRepository;
use App\Repository\MessageRepository;
use App\Entity\Thread;
use App\Entity\Message;

class ForumController extends AbstractController
{
    /**
     * @Route("/", name="forum")
     */
    public function index()
    {
        return $this->render('forum/index.html.twig');
    }

    /**
     * @Route("/threads", name="threads")
     */
    public function threads(ThreadRepository $repo) {   
        $threads = $repo->findAll();
        return $this->render('forum/listeThreads.html.twig', [
            'threads' => $threads,
        ]);
    }

    /**
     * @Route("/message/{id}", name="liste-messages")
     */
    public function detailsThreads(MessageRepository $repo, Thread $thread) {   

        $messages = $repo->findBy(['thread' => $thread]);
        dump($messages);
        return $this->render('forum/listeMessage.html.twig', [
            'messages' => $messages,
            'thread'   => $thread
        ]);
    }


    /**
     * @Route("/detailsMessage/{id}", name="detailsMessage")
     */
    public function detailsMessage(MessageRepository $repo, Message $message) {   
        
        $messages = $repo->findOneBy(['id' => $message]);
        dump($messages);
        return $this->render('forum/detailsMessage.html.twig', [
            'message' => $messages,
        ]);

    }
}

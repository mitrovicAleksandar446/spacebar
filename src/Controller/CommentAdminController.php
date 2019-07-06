<?php

namespace App\Controller;

use App\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CommentAdminController extends AbstractController
{
    /**
     * @Route("/admin/comment", name="comment_admin")
     *
     * @param CommentRepository $commentRepository
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(CommentRepository $commentRepository, Request $request)
    {
        $q = $request->query->get('q');
        $comments = $commentRepository->findAllWithSearch($q);

        return $this->render('comment_admin/index.html.twig', [
            'comments' => $comments,
        ]);
    }
}

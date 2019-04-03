<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     *
     * @return Response
     */
    public function homepage()
    {
        return $this->render("article/homepage.html.twig");
    }

    /**
     * @Route("/news/{slug}", name="article_show")
     * @param string $slug
     * @return Response
     */
    public function show(string $slug)
    {
        return $this->render('article/show.html.twig', [
            'title' => ucwords(str_replace("-", " ", $slug)),
            'comments' => [
                "Comment1",
                "Comment2",
                "Comment3",
            ]
        ]);
    }
}
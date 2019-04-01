<?php

namespace App\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class ArticleController
{
    /**
     * @Route("/")
     *
     * @return Response
     */
    public function homepage()
    {
        return new Response('My first page !');
    }

    /**
     * @Route("/news/{slug}")
     */
    public function show($slug)
    {
        return new Response($slug);
    }
}
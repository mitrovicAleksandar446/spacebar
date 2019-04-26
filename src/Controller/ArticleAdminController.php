<?php
/**
 * Created by PhpStorm.
 * User: aleksa446
 * Date: 4/16/19
 * Time: 10:27 PM
 */

namespace App\Controller;


use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleAdminController extends AbstractController
{
    /**
     * @Route("/admin/article/new")
     */
    public function new(EntityManagerInterface $em)
    {
        die("to do");

        return new Response(sprintf(
            "New article id: %d, slug: %s",
            $article->getId(),
            $article->getSlug()
        ));
    }
}
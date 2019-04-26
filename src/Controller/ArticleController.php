<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Service\MarkdownHelper;
use App\Service\SlackClient;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function homepage(ArticleRepository $repository)
    {
        $articles = $repository->findAllPublishedOrderedByNewest();

        return $this->render('article/homepage.html.twig', [
            'articles' => $articles
        ]);
    }

    /**
     * @Route("/news/{slug}", name="article_show")
     *
     * @param Article $article
     * @param SlackClient $slack
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Http\Client\Exception
     */
    public function show(Article $article, SlackClient $slack)
    {
        if ($article->getSlug() == 'khaaaaan') {
            $slack->sendMessage('Khan', "Ah, Kirk, my old friend...");
        }

//        $repository = $em->getRepository(Article::class);
//
//        /** @var Article $article */
//        $article = $repository->findOneBy(["slug" => $slug]);
//
//        if (!$article) {
//            throw $this->createNotFoundException(sprintf("Article with slug: %s not found", $slug));
//        }

        $comments = [
            'I ate a normal rock once. It did NOT taste like bacon!',
            'Woohoo! I\'m going on an all-asteroid diet!',
            'I like bacon too! Buy some from my site! bakinsomebacon.com',
        ];

        return $this->render('article/show.html.twig', [
            'article' => $article,
            'comments' => $comments,
        ]);
    }

    /**
     * @Route("/news/{slug}/heart", name="article_toggle_heart", methods={"POST"})
     */
    public function toggleArticleHeart(Article $article, LoggerInterface $logger, EntityManagerInterface $em)
    {
        $article->incrementHeartCount();
        $em->flush();

        $logger->info('Article is being hearted!');

        return new JsonResponse(['hearts' => $article->getHeartCount()]);
    }
}

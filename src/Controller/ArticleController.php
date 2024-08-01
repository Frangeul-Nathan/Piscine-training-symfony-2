<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ArticleController extends AbstractController
{
    #[Route('/articles', name: 'articles')]
    public function articleFromDb(ArticleRepository $articleRepository): Response
    {
        $articles = $articleRepository->findAll();

        return $this->render('public/page/articles.html.twig', [
            'articles' => $articles
        ]);
    }

    #[Route('/article/{id}', name: 'show_article')]
    public function showArticle(ArticleRepository $articleRepository, int $id): Response
    {
        $article = $articleRepository->find($id);

        if (!$article) {
            $html404 = $this->renderView('404.html.twig');
            return new Response($html404, 404);
        };

        return $this->render('public/page/show_article.html.twig', [
            'article' => $article
        ]);
    }

}

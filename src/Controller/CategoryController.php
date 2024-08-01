<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CategoryController extends AbstractController
{
    #[Route('/categories', name: 'categories')]
    public function categoriesFromDb(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();

        return $this->render('public/page/categories.html.twig' , [
            'categories' => $categories
        ]);
    }

    #[Route('/categories/{id}', name: 'show_category')]
    public function showCategory(CategoryRepository $categoryRepository, $id): Response
    {
        $category = $categoryRepository->find($id);

        if (!$category) {
            $html404 = $this->renderView('404.html.twig');
            return new Response($html404, 404);
        };

        return $this->render('public/page/show_category.html.twig' , [
            'category' => $category
        ]);
    }
}

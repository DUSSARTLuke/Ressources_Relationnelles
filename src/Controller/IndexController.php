<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ResourceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;


class IndexController extends AbstractController
{
    /**
     * @Rest\Get(
     *     name="home",
     *     path="/app{path}",
     *     requirements={
     *         "path"=".*"
     *     },
     * )
     * @Rest\Route(path="/", name="home")
     */
    public function home(ResourceRepository $resourceRepository, CategoryRepository $categoryRepository)
    {
        $resources = $resourceRepository->findBy([
            'status' => 'PU'
        ]);

        $categories = $categoryRepository->categoriesWithPublishedResources();

//        dd($categories);


        return $this->render("pages/index/index.html.twig", [
            'resources' => $resources,
            'categories' => $categories
        ]);
    }
}

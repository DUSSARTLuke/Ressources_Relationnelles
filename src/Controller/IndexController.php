<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\RelationTypeRepository;
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
    public function home(ResourceRepository $resourceRepository, CategoryRepository $categoryRepository, RelationTypeRepository $relationRepo)
    {
        $resources = $resourceRepository->findBy([
            'status' => 'PU',
            'visibility' => 'PUB'
        ]);

        $relations = $relationRepo->findAll();
        $categories = $categoryRepository->categoriesWithPublishedAndPublicResources();
        $resourceTypes = [
            'GA' => 'Jeu à réaliser / activité',
            'AR' => 'Article',
            'CH' => 'Carte défi',
            'PC' => 'Cours au format PDF',
            'WO' => 'Exercice / atelier',
            'RS' => 'Fiche de lecture',
            'OG' => 'Jeu en ligne',
            'VI' => 'Vidéo'
        ];

        return $this->render("pages/index/index.html.twig", [
            'resources' => $resources,
            'categories' => $categories,
            'relations' => $relations,
            'resourceTypes' => $resourceTypes
        ]);
    }
}

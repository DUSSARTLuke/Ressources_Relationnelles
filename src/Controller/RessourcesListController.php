<?php

namespace App\Controller;

use App\Repository\ResourceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class RessourcesListController extends AbstractController
{
    /**
     * @Route("/ressourcesList/{page}", name="ressources_list")
     */
    public function fillRessourcesList(int $page): Response
    {
        if ($page == 0) {
            $page = null;
        }

        return $this->render('ressources/ressourcesList.html.twig', ['page' => $page]);
    }
}

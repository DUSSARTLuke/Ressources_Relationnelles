<?php

namespace App\Controller;

use App\Entity\Resource;
use App\Repository\ResourceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/ressources", name="ressources_")
 */
class RessourcesController extends AbstractController
{
    /**
     * @Route (path="/list_ressources", name="list")
     */
    public function voirMesRessources(ResourceRepository $repo)
    {
        $ressources = $repo->findBy(['createdBy' => $this->getUser()->getId()]);

        return $this->render('pages/ressources/list.html.twig', ['ressources' => $ressources]);
    }
}

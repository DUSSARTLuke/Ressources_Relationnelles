<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;


class IndexController extends AbstractController
{
    /**
     * @Rest\Get(
     *     name="home",
     *     path="/{path}",
     *     requirements={
     *         "path"=".*"
     *     },
     * )
     */
    public function home()
    {
        return $this->render("index.html.twig");
    }
}

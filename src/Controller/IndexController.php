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
     *     path="/app{path}",
     *     requirements={
     *         "path"=".*"
     *     },
     * )
     * @Rest\Route(path="home", name="home")
     */
    public function home()
    {
        return $this->render("pages/index/index.html.twig");
    }
}

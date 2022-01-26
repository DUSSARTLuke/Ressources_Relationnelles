<?php

namespace App\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
     */
    public function home()
    {
        return $this->render("base.html.twig");
    }
}

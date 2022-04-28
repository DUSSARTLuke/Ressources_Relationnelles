<?php

namespace App\Controller\Admin;

use App\Form\admin\CommentType;
use App\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminDashboardController extends AbstractController
{
    /**
     * @Route(path="/app{route}", name="admin_dashboard", requirements={"route"=".*"})
     */
    public function adminCommentList(): Response
    {
        return $this->renderForm('/pages/admin/admin_dashboard.html.twig', []);
    }

}

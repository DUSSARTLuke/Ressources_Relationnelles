<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\CreationRessourceType;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/profil/", name="profil_")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/edit/{id}/", name="edit")
     */
    public function editRessources(Request $request, EntityManagerInterface $manager, User $user): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($user);
            $manager->flush();

            $this->addFlash('success', " Votre ressource a bien été modifiée !");

            return $this->redirectToRoute('ressources_consult', ['id' => $user->getId()]);
        }

        return $this->render('pages/user/form.html.twig', ['form' => $form->createView(), 'from' => 'edit']);
    }
}

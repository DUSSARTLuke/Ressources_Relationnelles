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
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/profil/", name="profil_")
 */
class UserController extends AbstractController
{
    /**
     * @Route("view/{id}/", name="view")
     */
    public function voirProfil(EntityManagerInterface $manager, User $user): Response
    {
        return $this->render('pages/user/view.html.twig', ["user" => $user]);
    }


    /**
     * @Route("edit/{id}/", name="edit")
     */
    public function editProfil(Request $request, EntityManagerInterface $manager, User $user, UserPasswordEncoderInterface $passwordEncoder,): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pwd = $form->getData()->getPassword();
            $confPwd = $form->getData()->getConfPassword();
            if (($pwd !== '' and $confPwd !== '') and ($pwd === $confPwd)) {
                $user->setPassword($passwordEncoder->encodePassword($user, $pwd));
                $user->setconfPassword($passwordEncoder->encodePassword($user, $confPwd));
            } else {
                $user->setPassword($passwordEncoder->encodePassword($user, $user->getPassword()));
                $user->setconfPassword($passwordEncoder->encodePassword($user, $user->getConfPassword()));
            }
            $manager->persist($user);
            $manager->flush();

            $this->addFlash('success', " Votre profil a bien été modifié !");

        }

        return $this->render('pages/user/form.html.twig', ['form' => $form->createView(), 'from' => 'edit']);
    }
}

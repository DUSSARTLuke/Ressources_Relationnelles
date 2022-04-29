<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\CreationRessourceType;
use App\Form\UserType;
use App\Repository\ResourceRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
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
    public function voirProfil(User $user, ResourceRepository $repo): Response
    {
        $ressources = $repo->findBy(['createdBy' => $this->getUser()->getId()]);

        return $this->render('pages/user/view.html.twig', ["user" => $user, "ressources" => $ressources]);
    }

    /**
     * @Route("delete/{id}", name="delete")
     */
    public function deleteProfil(EntityManagerInterface $manager, User $user): Response {

        $this->redirectToRoute('app_logout');
        $manager->remove($user);
        $manager->flush();
        return $this->redirectToRoute('home');
    }

    /**
     * @Route("edit/{id}/", name="edit")
     */
    public function editProfil(Request $request, UserRepository $uRepo, EntityManagerInterface $manager, User $user, UserPasswordEncoderInterface $passwordEncoder): Response
    {
//        dd($user);
        $pwdAncien = $user->getPassword();
        $confAncien = $user->getConfPassword();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pwd = $form->getData()->getPassword();
            $confPwd = $form->getData()->getConfPassword();
            if (($pwd !== '' and $confPwd !== '') and ($pwd === $confPwd)) {
//                dd($pwd);
                $user->setPassword($passwordEncoder->encodePassword($user, $pwd));
                $user->setconfPassword($passwordEncoder->encodePassword($user, $confPwd));
            } else {
                $user->setPassword($pwdAncien);
                $user->setconfPassword($confAncien);
            }
            $manager->persist($user);
            $manager->flush();

            $this->addFlash('success', " Votre profil a bien été modifié !");

            if($pwdAncien === $user->getPassword()){
                return $this->redirectToRoute('profil_view', ['id' => $user->getId()]);
            } else {
                return $this->redirectToRoute('app_logout');
            }
        }

        return $this->render('pages/user/form.html.twig', ['form' => $form->createView(), 'from' => 'edit']);
    }
}

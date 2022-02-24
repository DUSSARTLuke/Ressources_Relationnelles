<?php

namespace App\Controller;

use App\Entity\User;

use App\Form\UserAccountManagementType;
use App\Repository\UserRepository;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route(path="/utilisateurs", name="user_list")
     */
    public function UserList(UserRepository $userRepository)
    {

        $users = $userRepository->findAll();

        return $this->render('/pages/user/userList.html.twig', [
            'users' => $users
        ]);
    }

    /**
     * @Route(path="/modifier-role-utilisateur/{id}", name="user_update_role")
     */
    public function updateRoleUser(User $user, Request $request, EntityManagerInterface $em)
    {
        $form = $this->createFormBuilder($user)
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'Utilisateur' => 'ROLE_USER',
                    'Modérateur' => 'ROLE_MODERATOR',
                    'Administrateur' => 'ROLE_ADMIN',
                    'Super administrateur' => 'ROLE_SUPER_ADMIN'
                ],
                'expanded' => true,
                'multiple' => true,
                'label' => false
                ])
            ->add('save', SubmitType::class, ['label' => 'Valider la saisie'])
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'Le compte de l\'utilisateur a bien été modifié');

            return $this->redirectToRoute('user_list');
        }

        return $this->renderForm('/includes/user/userAccountManagementForm.html.twig', [
            'form' => $form,
            'id' => $user->getId()
        ]);
    }

    /**
     * @Route(path="/modifier-is-active-utilisateur/{id}", name="user_update_is_active")
     */
    public function updateIsActiveUser(User $user, Request $request, EntityManagerInterface $em)
    {
        $form = $this->createFormBuilder($user)
            ->add('isActive')
            ->add('save', SubmitType::class, ['label' => 'Valider la saisie'])
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'Le compte de l\'utilisateur a bien été modifié');

            return $this->redirectToRoute('user_list');
        }

        return $this->renderForm('/includes/user/userIsActiveUpdate.html.twig', [
            'form' => $form,
            'id' => $user->getId()
        ]);
    }
}

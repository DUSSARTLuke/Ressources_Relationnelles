<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/admin/utilisateurs/", name="user_")
 */
class UserController extends AbstractController
{
    /**
     * @Route(path="list", name="list")
     */
    public function UserList(UserRepository $userRepository)
    {

        $users = $userRepository->findAll();

        return $this->render('/pages/admin/user/userList.html.twig', [
            'users' => $users
        ]);
    }

    /**
     * @Route(path="modifier-role/{id}", name="update_role")
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

        return $this->renderForm('/includes/admin/user/userAccountManagementForm.html.twig', [
            'form' => $form,
            'id' => $user->getId()
        ]);
    }

    /**
     * @Route(path="activate/{id}", name="update_is_active")
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

        return $this->renderForm('/includes/admin/user/userIsActiveUpdate.html.twig', [
            'form' => $form,
            'id' => $user->getId()
        ]);
    }
}

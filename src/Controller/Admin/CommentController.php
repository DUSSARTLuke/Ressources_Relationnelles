<?php

namespace App\Controller\Admin;

use App\Entity\Comment;
use App\Form\admin\CommentType;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/admin/commentaires/", name="comment_")
 */
class CommentController extends AbstractController
{
    /**
     * @Route(path="list", name="admin_list")
     */
    public function adminCommentList(CommentRepository $commentRepository): Response
    {
        $comments = $commentRepository
            ->findCommentsWithAuthor();
        $form = $this->createForm(CommentType::class);

        return $this->renderForm('/pages/admin/comment/commentList.html.twig', [
            'comments' => $comments,
            'form' => $form,
        ]);
    }

    /**
     * @Route(path="utilisateur-commentaires", name="user_list")
     */
    public function userCommentList(CommentRepository $commentRepository): Response
    {
        $comments = $commentRepository
            ->findCommentsWithAuthor();

        return $this->renderForm('/includes/admin/comment/commentListIncludes.html.twig', [
            'comments' => $comments
        ]);
    }

    /**
     * @Route(path="ajouter-un-commentaire", name="create")
     */
    public function createComment(Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(CommentType::class);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment = $form->getData();

            $em->persist($comment);
            $em->flush();

            $this->addFlash('success', 'Le commentaire a bien été modifié');

            return $this->redirectToRoute('comment_list');
        }

        return $this->renderForm('/includes/admin/comment/form/createCommentForm.html.twig', [
            'form' => $form,
        ]);
    }

    /**
     * @Route(path="modifier-un-commentaire/{id}", name="update")
     */
    public function updateComment(Comment $comment, Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment = $form->getData();

            $em->persist($comment);
            $em->flush();

            $this->addFlash('success', 'Le commentaire a bien été modifié');

            return $this->redirectToRoute('comment_admin_list');
        }

        return $this->renderForm('/includes/admin/comment/form/updateCommentForm.html.twig', [
            'form' => $form,
            'id' => $comment->getId()
        ]);
    }

    /**
     * @Route(path="supprimer-un-commentaire/{id}", name="delete")
     */
    public function deleteComment($id, Request $request, CommentRepository $commentRepository, EntityManagerInterface $em): \Symfony\Component\HttpFoundation\RedirectResponse
    {
        $comment = $commentRepository
            ->findOneBy([
                'id' => $id
            ]);

        $comment->setStatus('DE');
        $em->flush();

        return $this->redirectToRoute('comment_admin_list');
    }
}

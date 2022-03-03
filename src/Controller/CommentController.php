<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class CommentController extends AbstractController
{
    /**
     * @Route(path="/admin/commentaires", name="comment_admin_list")
     */
    public function adminCommentList(CommentRepository $commentRepository): Response
    {
        $comments = $commentRepository
            ->findCommentsWithAuthor();
        $form = $this->createForm(CommentType::class);

        return $this->renderForm('/pages/comment/commentList.html.twig', [
            'comments' => $comments,
            'form' => $form,
        ]);
    }

    /**
     * @Route(path="/utilisateur-commentaires", name="comment_user_list")
     */
    public function userCommentList(CommentRepository $commentRepository): Response
    {
        $comments = $commentRepository
            ->findCommentsWithAuthor();

        return $this->renderForm('/includes/comment/commentListIncludes.html.twig', [
            'comments' => $comments
        ]);
    }

    /**
     * @Route(path="/ajouter-un-commentaire", name="comment_create")
     */
    public function createComment(Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(CommentType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment = $form->getData();

            $em->persist($comment);
            $em->flush();

            $this->addFlash('success', 'Le commentaire a bien été créé');

            return $this->redirectToRoute('comment_list');
        }

        return $this->renderForm('/includes/comment/form/createCommentForm.html.twig', [
            'form' => $form,
        ]);
    }

    /**
     * @Route(path="/admin/modifier-un-commentaire/{id}", name="comment_update")
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

        return $this->renderForm('/includes/comment/form/updateCommentForm.html.twig', [
            'form' => $form,
            'id' => $comment->getId()
        ]);
    }

    /**
     * @Route(path="/admin/supprimer-un-commentaire/{id}", name="comment_delete")
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

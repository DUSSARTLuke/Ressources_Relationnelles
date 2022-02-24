<?php

namespace App\Form;

use App\Entity\Comment;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\DBAL\Types\CommentStatusType;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('user', EntityType::class, [
                'label' => 'Utilisateur',
                'class' => User::class,
                'disabled' => true,
                'choice_label' => 'username',
                'row_attr' => [
                    'class' => 'input-group form-control mb-1',
                ],
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Commentaire',
                'row_attr' => [
                    'class' => 'mb-1',
                ],
            ])
            ->add('save', SubmitType::class)
            ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
                $comment = $event->getData();
                $form = $event->getForm();
                if ($comment && null !== $comment->getId()) {
                    $form->add('status', ChoiceType::class, [
                        'label' => 'Statut',
                        'choices'  => CommentStatusType::getChoices(),
                        'row_attr' => [
                            'class' => 'input-group form-control',
                        ],
                    ]);
                }
            });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
        ]);
    }
}

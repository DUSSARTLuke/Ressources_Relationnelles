<?php

namespace App\Form;

use App\DBAL\Types\ResourceStatusType;
use App\DBAL\Types\ResourceType;
use App\Entity\Category;
use App\Entity\RelationType;
use App\Entity\Resource;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ResourceAdminType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('createdBy', EntityType::class, [
                'label' => 'Utilisateur',
                'class' => User::class,
                'disabled' => true,
                'choice_label' => 'username',
                'row_attr' => [
                    'class' => 'input-group form-control mb-1',
                ],
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Contenu',
                'row_attr' => [
                    'class' => 'mb-1',
                ],
            ])
            ->add('status', ChoiceType::class, [
                'label' => 'Statut',
                'choices'  => ResourceStatusType::getChoices(),
                'row_attr' => [
                    'class' => 'input-group form-control',
                ],
            ])
            ->add('resourceType', ChoiceType::class, [
                'label' => 'Type de ressource',
                'choices'  => ResourceType::getChoices(),
                'row_attr' => [
                    'class' => 'input-group form-control',
                ],
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
                'row_attr' => [
                    'class' => 'input-group form-control',
                ],
            ])
            ->add('relationType', EntityType::class, [
                'label' => 'Type de relation',
                'class' => RelationType::class,
                'choice_label' => 'name',
                 'multiple' => true,
                 'expanded' => true,
            ])
            ->add('Valider', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Resource::class,
        ]);
    }
}

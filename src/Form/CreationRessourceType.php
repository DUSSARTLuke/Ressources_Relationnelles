<?php

namespace App\Form;

use App\DBAL\Types\ResourceVisibilityType;
use App\Entity\Category;
use App\Entity\Resource;
use App\Entity\RelationType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CreationRessourceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => function ($category){
                    return $category->getName();
                },
            ])
            ->add('relationType', EntityType::class, [
                'class' => RelationType::class,
                'choice_label' => function ($relationType){
                    return $relationType->getName();
                },
                'multiple' => true,
            ])

            ->add('visibility', ChoiceType::class, [
                'label' => 'Visibilité',
                'choices'  => ResourceVisibilityType::getChoices(),
            ])
            ->add('resourceType', ChoiceType::class, [
                'choices' => [
                    'Jeu à réaliser / activité' => 'GA',
                    'Article' => 'AR',
                    'Carte défi' => 'CH',
                    'Cours au format PDF' => 'PC',
                    'Exercice / atelier' => 'WO',
                    'Fiche de lecture' => 'RS',
                    'Jeu en ligne' => 'OG',
                    'Vidéo' => 'VI'
                ],
            ])
            ->add('content', TextareaType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Resource::class,
        ]);
    }
}
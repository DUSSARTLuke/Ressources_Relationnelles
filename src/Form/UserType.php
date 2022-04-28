<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class)
            ->add('email', EmailType::class)
            ->add('address1', TextType::class)
            ->add('address2', TextType::class)
            ->add('postalCode', NumberType::class)
            ->add('city', TextType::class)
            ->add('birthday', DateTimeType::class, [
                'widget' => 'single_text'
            ])
            ->add('socialSituation', ChoiceType::class, [
                'choices'  => [
                    'Ouvrier' => 'Ouvrier',
                    'Employé non qualifié' => 'Employé non qualifié',
                    'Employé qualifié' => 'Employé qualifié',
                ],
            ])
            ->add('password', PasswordType::class)
            ->add('confPassword', PasswordType::class)
            ->add('isRGPD', CheckboxType::class, [
                'label'    => 'Acceptez-vous que vos données soient collectées par le ministère?'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

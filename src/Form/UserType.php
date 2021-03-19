<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('password', PasswordType::class)
            ->add('roles',  ChoiceType::class, [
                'choices'  => array(User::$rolesvalue),
                'multiple' => true,
                'required' => true,
                'label'    => 'Choisir profil',
                'mapped' => false,
            ]);
            // roles field data transformer
$builder->get('Roles')
    ->addModelTransformer(new CallbackTransformer(
        function ($rolesArray) {
            // transform the array to a string
            return count($rolesArray)? $rolesArray[0]: null;
        },
        function ($rolesString) {
            // transform the string back to an array
            return [$rolesString];
        }
    ));
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }

}

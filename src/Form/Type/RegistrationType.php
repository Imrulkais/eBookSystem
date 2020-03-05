<?php
namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\CallbackTransformer;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class,[
                    'attr'   =>  array( 'class'   => 'form-control')
                ])
            ->add('password', PasswordType::class,[
                'attr'   =>  array( 'class'   => 'form-control')
            ])
            ->add('roles', ChoiceType::class, [
                'expanded' => true,
                'choices' => [
                    'Employee' => 'ROLE_EMPLOYEE',
                    'Administrator' => 'ROLE_ADMINISTRATOR',
                ],
            ])
            ->add('save', SubmitType::class,[
                'attr'   =>  array( 'class'   => 'btn btn-lg btn-primary')
            ]);

        //roles field data transformer
        $builder->get('roles')
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
}
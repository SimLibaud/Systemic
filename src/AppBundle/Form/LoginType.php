<?php
/**
 * User: Simon Libaud
 * Date: 26/02/2017
 * Email: simonlibaud@gmail.com
 */

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LoginType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('app_security_username', TextType::class, [
                'label' => 'login'
            ])
            ->add('app_security_password', PasswordType::class, [
                'label' => 'password'
            ])
        ;
    }

    public function getBlockPrefix()
    {
        return '';
    }

}
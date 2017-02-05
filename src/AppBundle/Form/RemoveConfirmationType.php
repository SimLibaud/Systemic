<?php
/**
 * User: Simon Libaud
 * Date: 05/02/2017
 * Email: simonlibaud@gmail.com
 */

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;

class RemoveConfirmationType extends  AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('remove_confirmation', CheckboxType::class, [
                'label'     => 'removeAllItems',
                'constraints'   => new isTrue(),
                'required'  => true
            ])
            ->add('submit', SubmitType::class, [
                'label'     => 'remove',
                'attr'      => [
                    'class' => 'btn btn-danger',
                ]
            ])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array());
    }
}
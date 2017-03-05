<?php
/**
 * User: Simon Libaud
 * Date: 05/02/2017
 * Email: simonlibaud@gmail.com
 */

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Entity\FinancialYear;


class FinancialYearType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('start', DateType::class, [
                'label' => 'start',
            ])
            ->and('end', DateType::class, [
                'label' => 'end'
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'record',
                'attr' => [
                    'class' => 'btn btn-primary',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FinancialYear::class
        ]);
    }
}
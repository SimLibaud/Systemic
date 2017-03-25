<?php
/**
 * User: Simon Libaud
 * Date: 04/02/2017
 * Email: simonlibaud@gmail.com
 */

namespace AppBundle\Form;

use AppBundle\Repository\UserRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Entity\Organisation;

class OrganisationType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'name',
            ])
            ->add('description', TextareaType::class, [
                'label' => 'description',
                'required'  => false
            ])
            ->add('users', EntityType::class, [
                'class' => 'AppBundle:User',
                'label' => 'associatedUsers',
                'choice_label' => function($user){
                    return $user->getFirstname().' '.$user->getLastname();
                },
                'query_builder' => function(UserRepository $repository){
                    return $repository
                        ->createQueryBuilder('user')
                        ->addOrderBy('user.firstname', 'ASC')
                    ;
                },
                'multiple' => true,
                'expanded' => false,
                'required' => false,
                'by_reference' => false
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
            'data_class' => Organisation::class
        ]);
    }

}
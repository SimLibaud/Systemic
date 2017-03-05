<?php
/**
 * User: Simon Libaud
 * Date: 26/02/2017
 * Email: simonlibaud@gmail.com
 */

namespace AppBundle\Form;

use AppBundle\Security\RolesProvider;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Entity\Group;

class GroupType extends AbstractType
{

    private $rolesProvider;

    public function __construct(RolesProvider $rolesProvider)
    {
        $this->rolesProvider = $rolesProvider;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'name'
            ])
            ->add('roles', ChoiceType::class, [
                'label' => 'roles',
                'multiple' => true,
                'expanded' => false,
                'choices' => $this->getAppRolesChoicesList()
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'record',
                'attr' => [
                    'class' => 'btn btn-primary',
                ]
            ])
        ;
    }

    protected function getAppRolesChoicesList()
    {
        $roles = $this->rolesProvider->getAppRoles();

        return array_combine($roles, $roles);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Group::class
        ]);
    }

}
<?php
/**
 * User: Simon Libaud
 * Date: 26/02/2017
 * Email: simonlibaud@gmail.com
 */

namespace AppBundle\Form;

use AppBundle\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class UserType extends AbstractType
{

    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, [
                'label' => 'identifier'
            ])
            ->add('password', RepeatedType::class, [
                'type'  => PasswordType::class,
                'first_options' => [
                    'label' => 'password'
                ],
                'second_options' => [
                    'label' => 'repeatPassword'
                ]
            ])
            ->add('firstname', TextType::class, [
                'label' => 'firstname'
            ])
            ->add('lastname', TextType::class, [
                'label' => 'lastname'
            ])
            ->add('isEnabled', CheckboxType::class, [
                'label' => 'activate',
                'required' => false
            ])
            ->add('organisations', EntityType::class, [
                'label' => 'organisations',
                'class' => 'AppBundle:Organisation',
                'choice_label' => 'name',
                'multiple'  => true,
                'expanded' => false,
                'required' => false
            ])
            ->add('group', EntityType::class, [
                'label' => 'group',
                'class' => 'AppBundle:Group',
                'choice_label' => 'name',
                'multiple' => false,
                'expanded' => false
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'record',
                'attr' => [
                    'class' => 'btn btn-primary',
                ]
            ])
        ;

        $builder->addEventListener(FormEvents::POST_SET_DATA, function(FormEvent $event) {
            $form = $event->getForm();
            $user = $form->getData();
            if ($user instanceof User and $user->getId() !== null) {

                $form->remove('password');

                // If the connected user is same as the edited, remove of "isEnabled" field
                if (true === $this->isAuthentificatedUser($user)) {
                    $form->remove('isEnabled');
                }
            } else {
                // Enable account by default
                $form->get('isEnabled')->setData(true);
            }
        });
    }

    protected function isAuthentificatedUser(User $user)
    {
        if (null === $this->tokenStorage->getToken() or false === is_object($this->tokenStorage->getToken()->getUser())) {
            return;
        }

        $authentificatedUser = $this->tokenStorage->getToken()->getUser();

        return $authentificatedUser->getId() === $user->getId()
            ? true
            : false
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class
        ]);
    }

}
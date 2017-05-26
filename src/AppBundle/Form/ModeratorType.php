<?php

namespace Raddit\AppBundle\Form;

use Raddit\AppBundle\Entity\Moderator;
use Raddit\AppBundle\Form\DataTransformer\UserTransformer;
use Raddit\AppBundle\Repository\UserRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModeratorType extends AbstractType {
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('user', TextType::class)
            ->add('submit', SubmitType::class)
        ;

        $builder->get('user')->addModelTransformer(
            new UserTransformer($this->userRepository)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Moderator::class,
            'label_format' => 'moderator_form.%name%',
        ]);
    }
}
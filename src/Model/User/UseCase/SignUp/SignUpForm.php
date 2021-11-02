<?php

declare(strict_types=1);

namespace App\Model\User\UseCase\SignUp;

use App\ReadModel\User\UserFetcher;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class SignUpForm extends AbstractType
{
    private UserFetcher $userFetcher;
    
    public function __construct(UserFetcher $userFetcher)
    {
        $this->userFetcher = $userFetcher;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', Type\TextType::class, ['required' => true])
            ->add('lastName', Type\TextType::class, ['required' => true])
            ->add('phone', Type\IntegerType::class, ['required' => true])
            ->add('host', Type\ChoiceType::class, [
                'required' => true,
                'choices' => array_flip($this->userFetcher->all()),
            ])
            ->add('organization', Type\TextType::class, ['required' => true])
            ->add('password', Type\RepeatedType::class, [
                'type'            => Type\PasswordType::class,
                'required'        => true,
                'invalid_message' => 'Пароли не совпадают.',
                'first_options'   => ['label' => 'Пароль'],
                'second_options'  => ['label' => 'Повтор пароля'],
            ]);
    }
    
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SignUpCommand::class,
        ]);
    }
}

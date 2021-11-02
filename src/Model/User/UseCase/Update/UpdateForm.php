<?php

declare(strict_types=1);

namespace App\Model\User\UseCase\Update;

use App\ReadModel\Organization\OrganizationFetcher;
use App\ReadModel\User\UserFetcher;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class UpdateForm extends AbstractType
{
    private UserFetcher $userFetcher;
    private OrganizationFetcher $organizationFetcher;
    
    public function __construct(UserFetcher $userFetcher, OrganizationFetcher $organizationFetcher)
    {
        $this->userFetcher = $userFetcher;
        $this->organizationFetcher = $organizationFetcher;
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
            ->add('organization', Type\ChoiceType::class, [
                'required' => true,
                'choices' => array_flip($this->organizationFetcher->all()),
            ]);
    }
    
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UpdateCommand::class,
        ]);
    }
}

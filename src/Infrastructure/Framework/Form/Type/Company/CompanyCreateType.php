<?php

namespace App\Infrastructure\Framework\Form\Type\Company;

use App\Core\Application\UseCase\Company\CreateCompanyRequest;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\PositiveOrZero;

final class CompanyCreateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'constraints' => [
                    new NotBlank(message:'messssage'),
                    new Length(['max' => 250])
                ],

            ])
            ->add('debtorLimit', IntegerType::class, [
                'constraints' => [
                    new NotBlank(message:'messssage2233'),
                    new PositiveOrZero(),
                    new Length(['min' => 0, 'max' => 9])
                ]
            ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CreateCompanyRequest::class,
            'csrf_protection' => false
        ]);
    }
}
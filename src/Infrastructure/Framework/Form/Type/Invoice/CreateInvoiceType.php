<?php

namespace App\Infrastructure\Framework\Form\Type\Invoice;

use App\Core\Application\UseCase\Invoice\CreateInvoiceRequest;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\PositiveOrZero;

final class CreateInvoiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('sellerId', IntegerType::class, [
                'constraints' => [
                    new NotBlank(message: 'messssage'),
                    new Length(['max' => 6])
                ],
            ])
            ->add('customerId', IntegerType::class, [
                'constraints' => [
                    new NotBlank(message: 'messssage'),
                    new Length(['max' => 6])
                ],
            ])
            ->add('cost', IntegerType::class, [
                'constraints' => [
                    new NotBlank(message: 'messssage'),
                    new Length(['max' => 6]),
                    new PositiveOrZero()
                ],
            ])
            ->add('quantity', IntegerType::class, [
                'constraints' => [
                    new NotBlank(message: 'messssage'),
                    new Length(['max' => 6]),
                    new PositiveOrZero()
                ],
            ])
            ->add('title', TextType::class, [
                'constraints' => [
                    new NotBlank(message: 'messssage'),
                ],
            ])
            ->add('type', TextType::class, [
                'constraints' => [
                    new NotBlank(message: 'messssage'),
                    new Choice(['service', 'sale'])
                ],
            ])->add('status', TextType::class, [
                'constraints' => [
                    new NotBlank(message: 'messssage'),
                    new Choice(['pending', 'paid'])
                ],
            ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CreateInvoiceRequest::class,
            'csrf_protection' => false
        ]);
    }
}
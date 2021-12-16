<?php

namespace App\Infrastructure\Framework\Form\Type\Invoice;

use App\Core\Application\UseCase\Invoice\InvoicePaidStatusRequest;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

final class InvoicePaidStatusType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('invoiceId', IntegerType::class, [
                'constraints' => [
                    new NotBlank(message: 'messssage'),
                    new Length(['max' => 6])
                ],
            ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => InvoicePaidStatusRequest::class,
            'csrf_protection' => false
        ]);
    }
}
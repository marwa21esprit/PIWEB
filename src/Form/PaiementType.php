<?php

namespace App\Form;

use App\Entity\Paiement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Regex;

class PaiementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Name',
                'mapped' => false,
                'attr' => ['class' => 'form-control'],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Name cannot be blank.']),
                    new Regex([
                        'pattern' => '/^[a-zA-Z -]+$/',
                        'message' => 'Name must contain only letters, spaces, and hyphens.',
                    ]),
                ],
            ])
            ->add('cardNumber', PasswordType::class, [
                'label' => 'Card Number',
                'mapped' => false,
                'attr' => ['class' => 'form-control'],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Card number cannot be blank.']),
                    new Assert\Regex([
                        'pattern' => '/^\d+$/',
                        'message' => 'Card number must contain only numbers.',
                    ]),
                ],
            ])
            ->add('cvv', PasswordType::class, [
                'label' => 'CVV',
                'mapped' => false,
                'attr' => ['class' => 'form-control'],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'CVV cannot be blank.']),
                    new Assert\Regex([
                        'pattern' => '/^\d+$/',
                        'message' => 'CVV must contain only numbers.',
                    ]),
                    new Assert\Length([
                        'min' => 3,
                        'max' => 3,
                        'exactMessage' => 'CVV must be exactly 3 digits long.',
                    ]),
                ],
            ])
            ->add('expireDate', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Expire Date',
                'mapped' => false,
                'attr' => ['class' => 'form-control'],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Expire date cannot be blank.']),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Paiement::class,
        ]);
    }
}

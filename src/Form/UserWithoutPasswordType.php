<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\CallbackTransformer;

class UserWithoutPasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')

            ->add('name', null, [
                'label' => 'Nom', // Label in French
            ])
            ->add('address', null, [
                'label' => 'Adresse', // Label in French
            ])
            ->add('question', ChoiceType::class, [
                'choices' => [
                    'Quel est votre plat préféré?' => 'Quel est votre plat préféré?',
                    'Quelle est votre couleur préférée?' => 'Quelle est votre couleur préférée?',
                    'Quel est le nom de votre animal de compagnie?' => 'Quel est le nom de votre animal de compagnie?',
                    'Quel est votre sport préféré?' => 'Quel est votre sport préféré?',
                ],
                'placeholder' => 'Choisir une question', // Optional: add a selection option
                'required' => true, // Optional: set to true if you want to make the field required
                'label' => 'Question de sécurité', // Label in French
            ])
            ->add('answer', null, [
                'label' => 'Réponse', // Label in French
            ]);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

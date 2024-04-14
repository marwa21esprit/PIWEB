<?php

namespace App\Form;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Validator\Constraints as Assert;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('roles', ChoiceType::class, [
                'required' => true,
                'multiple' => false,
                'expanded' => false,
                'choices' => [
                    'Tuteur' => 'Tuteur',
                    'Apprenant' => 'Apprenant',
                    'Organisateur d\'événement' => 'Organisateur d\'événement',
                ],
                'label' => 'Rôle', // Label in French
            ])
            ->add('password', PasswordType::class, [
                'attr' => ['class' => 'form-control mb-3'],
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Veuillez saisir un mot de passe',
                    ]),
                    new Assert\Length([
                        'min' => 8,
                        'minMessage' => 'Le mot de passe doit contenir au moins {{ limit }} caractères.',
                        'max' => 4096,
                    ]),
                    new Assert\Regex([
                        'pattern' => "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/",
                        'message' => "Le mot de passe doit contenir au moins une lettre minuscule, une lettre majuscule et un chiffre."
                    ]),
                ],
            ])
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

        $builder->get('roles')
            ->addModelTransformer(new CallbackTransformer(
                function ($rolesArray) {
                    return count($rolesArray) ? $rolesArray[0] : null;
                },
                function ($rolesString) {
                    return [$rolesString];
                }
            ));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

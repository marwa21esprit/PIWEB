<?php

namespace App\Form;

use App\Entity\Etablissement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints as Assert;

class EtablissementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('imgEtablissement',FileType::class, [
                'label'=>false,
                'mapped'=>false,
                'required'=>false
            ])
            ->add('nomEtablissement')
            'label'=>false,
            'mapped'=>false,
            'required'=>false
            ])
            ->add('nomEtablissement', null, [
                'label' => 'Nom de l\'établissement', // Label in French
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Le nom de l\'établissement ne doit pas être vide.',
                    ]),
                    new Assert\Regex([
                        'pattern' => '/^[A-Za-zÀ-ÖØ-öø-ÿ\s]+$/',
                        'message' => 'Le nom de l\'établissement ne doit contenir que des lettres et des espaces.',
                    ]),
                ],
            ])
            ->add('adresseEtablissement')
            ->add('typeEtablissement', ChoiceType::class, [
                'label' => 'Type',
                'choices' => [
                    'École' => 'École',
                    'Université' => 'Université',
                    'Centre de formation' => 'Centre de formation',
                    'Université virtuelle' => 'Université virtuelle',
                    'Institut Supérieur' => 'Institut Supérieur',
                    'Ecole ing' => 'Ecole Nationale d\'Ingénieurs',
                ],
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('telEtablissement', null, [
                'label' => 'Numéro de téléphone de l\'établissement', // Label in French
                'constraints' => [
                    new Assert\Length([
                        'min' => 8,
                        'max' => 8,
                        'exactMessage' => 'Le numéro de téléphone doit contenir exactement {{ limit }} chiffres.',
                        'exactMessage' => 'The phone number must contain exactly {{ limit }} digits.',
                    ]),
                ],
            ])
            ->add('directeurEtablissement')
            ->add('dateFondation', DateType::class, [
                'widget' => 'single_text',
                'required' => false,
                'placeholder' => [
                    'year' => 'YYYY',
                    'month' => 'MM',
                    'day' => 'DD',
                ],
                'empty_data' => function ($form) {
                    $entity = $form->getData();
                    if ($entity && $entity->getDateObtentionCertificat() !== null) {
                        return $entity->getDateObtentionCertificat()->format('Y-m-d');
                    } else {
                        return date('Y-m-d');
                    }
                },
=======
                'data' => new \DateTime(),
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Etablissement::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\Etablissement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

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
            ->add('telEtablissement')
            ->add('directeurEtablissement')
            ->add('dateFondation')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Etablissement::class,
        ]);
    }
}

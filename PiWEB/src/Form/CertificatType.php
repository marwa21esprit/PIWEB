<?php

namespace App\Form;

use App\Entity\Certificat;
use App\Entity\Etablissement; // Import the Etablissement entity
use Symfony\Bridge\Doctrine\Form\Type\EntityType; // Import EntityType
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class CertificatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomCertificat')
            ->add('domaineCertificat', ChoiceType::class, [
                'choices' => [
                    'Finance' => 'Finance',
                    'Santé' => 'Santé',
                    'Marketing' => 'Marketing',
                    'Éducation' => 'Éducation',
                    'Communication' => 'Communication',
                    'Ingénierie' => 'Ingénierie',
                    'Droit' => 'Droit',
                    'Sciences sociales' => 'Sciences sociales',
                    'Arts et design' => 'Arts et design',
                ],
            ])
            ->add('niveau', ChoiceType::class, [
                'choices' => [
                    'Certificat' => 'Certificat',
                    'Technicien Spécialisé' => 'Technicien Spécialisé',
                    'Technicien Supérieur' => 'Technicien Supérieur',
                    'Licence' => 'Licence',
                    'Master' => 'Master',
                    'Doctorat' => 'Doctorat',
                ],
            ])
            ->add('dateObtentionCertificat')
            ->add('idEtablissement', EntityType::class, [
                'class' => Etablissement::class,
                'choice_label' => 'nomEtablissement',
                'placeholder' => 'Select an etablissement',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Certificat::class,
        ]);
    }
}

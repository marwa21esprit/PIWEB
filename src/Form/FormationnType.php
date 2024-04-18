<?php

namespace App\Form;

use App\Entity\Formationn;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class FormationnType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom_niveau')
            ->add('categorie', ChoiceType::class, [
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
            ->add('titre')
            ->add('description')
            ->add('date_d', DateType::class, [
                'widget' => 'single_text',
                'required' => false,
                'placeholder' => [
                    'year' => 'YYYY',
                    'month' => 'MM',
                    'day' => 'DD',
                ],
                'data' => new \DateTime(),
            ])
            ->add('date_f', DateType::class, [
                'widget' => 'single_text',
                'required' => false,
                'placeholder' => [
                    'year' => 'YYYY',
                    'month' => 'MM',
                    'day' => 'DD',
                ],
                'data' => new \DateTime(),
            ])
            ->add('lien');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Formationn::class,
        ]);
    }
}

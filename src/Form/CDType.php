<?php

namespace App\Form;

use App\Entity\CD;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CDType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('cote')
            ->add('format')
            ->add('codeOeuvre')
            ->add('plages')
            ->add('duration')
            ->add('ressources', CollectionType::class, [
                'entry_type' => RessourcesType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CD::class,
        ]);
    }
}

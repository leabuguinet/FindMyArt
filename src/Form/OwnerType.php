<?php

namespace App\Form;

use App\Entity\OwnerType\Artist;
use App\Entity\OwnerType\FindMyArt;
use App\Entity\OwnerType\Gallery;
use App\Entity\OwnerType\ArtSchool;
use App\Entity\Owner;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OwnerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('email')
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Artiste' => 'artist',
                    'FindMyArt' => 'findmyart',
                    'Galerie' => 'gallery',
                    'École d\'art' => 'artschool'

                ],
                'mapped' => false,
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        
        $resolver->setDefaults([
            'data_class' => Owner::class,
            'empty_data' => function (FormInterface $form) {
                $type = $form->get('type')->getData();
                if ('artist' === $type) {
                    return new Artist();
                }
                if ('findmyart' === $type) {
                    return new FindMyArt();
                }
                if ('gallery' === $type) {
                    return new Gallery();
                }
                if ('artschool' === $type) {
                    return new ArtSchool();
                }
           }
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\OwnerType\Artist;
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
           }
        ]);
    }
}

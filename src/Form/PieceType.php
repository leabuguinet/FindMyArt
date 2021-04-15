<?php

namespace App\Form;

use App\Entity\PieceType\ContemporaryArt;
use App\Entity\PieceType\DigitalArt;
use App\Entity\PieceType\Photography;
use App\Entity\PieceType\StreetArt;

use App\Entity\Piece;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Owner;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class PieceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('artist')
            ->add('style', ChoiceType::class, [
                'choices' => [
                    'Art Contemporain' => 'contemporaryArt',
                    'Art digital' => 'digitalArt',
                    'Photographie' => 'photography',
                    'Street Art' => 'streetArt'
                ],
                'mapped' => false,
            ])
            ->add('availability')
            ->add('image')
            ->add('size')
            ->add('description')
            ->add('materialsTechnique')
            ->add('creationDate')
            ->add('updatedAt')
            ->add('owner', EntityType::class, 
            [
                'class' => Owner::class,
                'choice_label' => 'name'
            ])
            /* ->add('rentingDetails') */
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Piece::class,
            'empty_data' => function (FormInterface $form) {
                $style = $form->get('style')->getData();
                if ('contemporaryArt' === $style) {
                    return new ContemporaryArt();
                }
                if ('digitalArt' === $style) {
                    return new DigitalArt();
                }
                if ('photography' === $style) {
                    return new Photography();
                }
                if ('streetArt' === $style) {
                    return new StreetArt();
                }
           }
        ]);
    
    }
}

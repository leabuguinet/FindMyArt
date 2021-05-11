<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UserEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname')
            ->add('lastname')
            ->add('email')
            ->add('password')  
            ->add('address')            
            ->add('city')
            ->add('postcode')
            ->add('phone')
            
            -> add('identityCardFile', FileType::class, [
                'label' => 'Carte d\'identité',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Nous avons besoin de votre carte d\'identité',
                    ]),
                ],
            ])
            -> add('residenceCertificateFile', FileType::class, [
                'label' => 'Justificatif de domicile',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Nous avons besoin de votre justificatif de domicile',
                    ]),
                ],
            ])
            -> add('insuranceCertificateFile', FileType::class, [
                'label' => 'Attestation d\'assurance domicile',
                          'constraints' => [
                    new NotBlank([
                        'message' => 'Nous avons besoin de votre attestation d\'assurance domicile',
                    ]),
                ],
            ])
            ->add('Enregistrer',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

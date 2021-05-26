<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, array('label'=> 'Prénom'))
            ->add('lastname', TextType::class, array('label'=> 'Nom'))
            ->add('email', EmailType::class, array('label'=> 'Adresse email'))
            // ->add('city', TextType::class, array('label'=> 'Ville'))
            // ->add('postcode', NumberType::class, array('label'=> 'Code Postal'))
            // ->add('address', TextType::class, array('label'=> 'Adresse'))
            // ->add('phone', TelType::class, array('label'=> 'Téléphone'))
            ->add('plainPassword', PasswordType::class, [
                 // instead of being set onto the object directly,
                 // this is read and encoded in the controller
                 'label' => 'Mot de passe',
                 'mapped' => false,
                 'constraints' => [
                     new NotBlank([
                         'message' => 'Merci de choisir un mot de passe',
                     ]),
                     new Length([
                         'min' => 6,
                         'minMessage' => 'Votre mot de passe doit comprendre {{ limit }} caractères',
                         // max length allowed by Symfony for security reasons
                        'max' => 4096,
                     ]),
                 ],
             ])
            ->add('agreeTerms', CheckboxType::class, [
                 'label' => 'Conditions d\'utilisation',
                 'mapped' => false,
                 'constraints' => [
                     new IsTrue([
                         'message' => 'Vous devez accepter les conditions d\'utilisation',
                     ]),
                 ],
             ])
            // -> add('identityCardFile', FileType::class, [
            //     'label' => 'Carte d\'identité',
            //     'constraints' => [
            //         new NotBlank([
            //             'message' => 'Nous avons besoin de votre carte d\'identité',
            //         ]),
            //     ],
            // ])
            // -> add('residenceCertificateFile', FileType::class, [
            //     'label' => 'Justificatif de domicile',
            //     'constraints' => [
            //         new NotBlank([
            //             'message' => 'Nous avons besoin de votre justificatif de domicile',
            //         ]),
            //     ],
            // ])
            // -> add('insuranceCertificateFile', FileType::class, [
            //     'label' => 'Attestation d\'assurance domicile',
            //               'constraints' => [
            //         new NotBlank([
            //             'message' => 'Nous avons besoin de votre attestation d\'assurance domicile',
            //         ]),
            //     ],
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

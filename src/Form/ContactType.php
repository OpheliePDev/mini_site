<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;

final class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom complet',
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez saisir votre nom.'])
                ],
                'attr' => [
                    'placeholder' => 'Exemple : John DOE',
                    'aria-label' => 'Nom complet',
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez saisir une adresse e-mail.']),
                    new Email(['message' => 'Veuillez saisir une adresse e-mail valide.']),
                ],
                'attr' => [
                    'placeholder' => 'example@domaine.com',
                    'aria-label' => 'Adress e-mail',
                ]
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Message',
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez écrire votre message.'])
                ],
                'attr' => [
                    'placeholder' => 'Écrivez votre message ici...',
                    'rows' => 6,
                    'aria-label' => 'Message',
                ]
            ]);
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([]);
    }
}
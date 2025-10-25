<?php

namespace App\Form;

use App\Entity\Task;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('priority', ChoiceType::class, [
                'choices' => [
                    'Haute 🔥' => 'High',
                    'Moyenne ⚖️' => 'Medium',
                    'Faible 🌱' => 'Low'
                ],
                'placeholder' => 'Sélectionne une priorité',
                'attr' => [
                    'class' => 'form-select',
                    'style' => 'cursor: pointer;'
                ],
            ])
            ->add('createdAt', DateType::class, [
                'widget' => 'single_text',
                'attr' => [
                    'readonly' => true,
                    'class' => 'form-control-plaintext bg-light border-0'
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
        ]);
    }
}

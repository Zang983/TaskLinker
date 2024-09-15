<?php

namespace App\Form;

use App\Entity\Status;
use App\Entity\Task;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('deadline', null, [
                'widget' => 'single_text',
            ])
            ->add('status', EntityType::class, [
                'class' => Status::class,
                'choice_label' => 'libelle',
                'choice_value' => $options['typeOfTask'],
            ])
            ->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'fullname',
            ])
            ->add('Ajouter', SubmitType::class, ['attr' => ['class' => 'button button-submit']]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
            'typeOfTask' => null,
        ]);

    }
}

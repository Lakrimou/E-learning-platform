<?php

namespace App\Form\Type;

use Doctrine\Bundle\MongoDBBundle\Form\Type\DocumentType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StreamType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('description', TextareaType::class)
            ->add('enabled', RadioType::class)
            ->add('supervisorStream', DocumentType::class, [
                'class'        => 'App\Document\User',
                'choice_label' => 'username',
                'placeholder' => '-- Teachers --'
            ])
            ->add('grades', DocumentType::class, [
                'class'        => 'App\Document\Grade',
                'choice_label' => 'name',
                'multiple'     => true,
                'required'     => false,
            ])
            ->add('courses', DocumentType::class, [
                'class'        => 'App\Document\Course',
                'choice_label' => 'name',
                'multiple'     => true,
                'required'     => false,
            ])
            ->add('classes', DocumentType::class, [
                'class'        => 'App\Document\Classe',
                'choice_label' => 'name',
                'multiple'     => true,
                'required'     => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'App\Document\Stream',
        ]);
    }

}
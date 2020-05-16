<?php

namespace App\Form\Type;

use App\Form\Type\DataTransformer\DateTimeTransformer;
use Doctrine\Bundle\MongoDBBundle\Form\Type\DocumentType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CourseType extends AbstractType
{
    private $dateTimeTransformer;

    public function __construct(DateTimeTransformer $dateTimeTransformer)
    {
        $this->dateTimeTransformer = $dateTimeTransformer;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('description', TextareaType::class)
            ->add('startDate', TextType::class, [
                    'attr' => array(
                        'class' => 'form-control input-inline datetimepicker',
                        'data-provide' => 'datepicker',
                        'data-format' => 'dd/mm/yyyy HH:ii',
                    ),
                ]
            )
            ->add('endDate', TextType::class, [
                    'attr' => array(
                        'class' => 'form-control input-inline datetimepicker',
                        'data-provide' => 'datepicker',
                        'data-format' => 'dd/mm/yyyy HH:ii',
                    ),
                ]
            )
            ->add('supervisor', DocumentType::class, [
                'class'        => 'App\Document\User',
                'choice_label' => 'username',
                'placeholder' => '-- Teachers --'
            ])
            ->add('category', ChoiceType::class, [
                'placeholder' => '-- Selectionner une catégorie --',
                'choices'        => [
                    'Obligatoire' => 'obligatoire',
                    'Optionel' => 'Optionel',
                    'Examen d\'entré' => 'Examen d\'entré'
                ]
            ])
            ->add('type', ChoiceType::class, [
                'placeholder' => '-- Selectionner un type --',
                'choices'        => [
                    'Matière' => 'Matière',
                    'Thèse' => 'Thèse',
                    'Stage' => 'Stage'
                ]
            ])
            ->add('studentLimit', IntegerType::class, [
                'required' => false
            ])
            ->add('hoursPerWeek', IntegerType::class, [
                'required' => false
            ])
            ->add('totalWeek', IntegerType::class, [
                'required' => false
            ])
            ->add('enabled', RadioType::class)
            ->add('streams', DocumentType::class, [
                'class'        => 'App\Document\Stream',
                'choice_label' => 'name',
                'multiple'     => true,
                'required'     => false,
            ])
            ->add('grades', DocumentType::class, [
                'class'        => 'App\Document\Grade',
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
            ->add('note', TextType::class, [
                'required' => false
            ])
        ;
        $builder->get('startDate')
            ->addModelTransformer($this->dateTimeTransformer);
        $builder->get('endDate')
            ->addModelTransformer($this->dateTimeTransformer);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'App\Document\Course',
        ]);
    }

}
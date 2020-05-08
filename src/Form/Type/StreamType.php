<?php

namespace App\Form\Type;

use App\Form\Type\DataTransformer\DateTimeTransformer;
use Doctrine\Bundle\MongoDBBundle\Form\Type\DocumentType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StreamType extends AbstractType
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
            ->add('language', TextType::class)
            ->add('enabled', RadioType::class)
            ->add('streams', DocumentType::class, [
                'class'        => 'App\Document\Stream',
                'choice_label' => 'name',
                'multiple'     => true,
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
            'data_class' => 'App\Document\Grade',
        ]);
    }

}
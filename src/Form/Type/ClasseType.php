<?php

namespace App\Form\Type;

use App\Document\Stream;
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
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClasseType extends AbstractType
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
            ->add('classType', ChoiceType::class, [
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
            ->add('absenceLimit', IntegerType::class, [
                'required' => false
            ])
            ->add('enabled', RadioType::class)
            ->add('stream', DocumentType::class, [
                'class'        => 'App\Document\Stream',
                'placeholder'   => '',
                /*'choice_label' => 'name',*/
            ])
            ->add('supervisor', DocumentType::class, [
                'class'        => 'App\Document\User',
                'choice_label' => 'username',
            ])
        ;

        $formModifier = function (FormInterface $form, Stream $stream = null) {
            $grades = null === $stream ? [] : $stream->getGrades();

            $form->add('grade', DocumentType::class, [
                'class' => 'App\Document\Grade',
                'placeholder' => '',
                'choices' => $grades,
            ]);
        };

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($formModifier) {

                $data = $event->getData();

                $formModifier($event->getForm(), $data->getStream());
            }
        );

        $builder->get('stream')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifier) {
                $stream = $event->getForm()->getData();
                $formModifier($event->getForm()->getParent(), $stream);
            }
        );

        $builder->get('startDate')
            ->addModelTransformer($this->dateTimeTransformer);
        $builder->get('endDate')
            ->addModelTransformer($this->dateTimeTransformer);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'App\Document\Classe',
        ]);
    }

}
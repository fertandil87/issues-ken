<?php

namespace Amex\TriviaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserAnswerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('answer')
            ->add('responseTime')
            ->add('rightAnswer')
            ->add('date')
            ->add('user')
            ->add('challenge')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Amex\TriviaBundle\Entity\UserAnswer'
        ));
    }

    public function getName()
    {
        return 'amex_triviabundle_useranswertype';
    }
}

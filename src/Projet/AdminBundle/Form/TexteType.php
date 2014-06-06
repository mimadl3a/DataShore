<?php

namespace Projet\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TexteType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('contenu','textarea',array(
        	'attr'=>array(
        		'cols'=>'60',
        		'rows'=>'10'
            )
        ))
            ->add('page','hidden')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Projet\AdminBundle\Entity\Texte'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'projet_adminbundle_texte';
    }
}

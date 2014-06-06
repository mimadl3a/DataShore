<?php

namespace Projet\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use EWZ\Bundle\RecaptchaBundle\Validator\Constraints\True;

class CategorieProduitType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle')
            ->add('recaptcha', 'ewz_recaptcha', 
            		array(
	            		'attr'=> array(
		            		'options' => array(
		            			'theme' => 'clean'
		            		),
            		),
            		'mapped' => false,
            		'constraints'   => array(
            			new True()
            		)
        )
       );
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Projet\AdminBundle\Entity\CategorieProduit'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'projet_adminbundle_categorieproduit';
    }
}

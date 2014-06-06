<?php

namespace Projet\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class InfoSuppProduitType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('couleur')
            ->add('taille')
            ->add('quantite','integer', 
            	array(
		            'attr' => array(
		            	'min' => 0
		           	)
            	)
		    )
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Projet\AdminBundle\Entity\InfoSuppProduit'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'projet_adminbundle_infosuppproduit';
    }
}

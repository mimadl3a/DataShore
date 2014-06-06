<?php

namespace Projet\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProduitType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle')
            ->add('prixHt')
            ->add('prixTtc')
            ->add('description')
            ->add('metaKeywords')
            ->add('metaDescription')
            ->add('reference')
            ->add('photoPrincipale','file',array(
                'required' => false,
                'data_class'=> null
            ))
            ->add('lien')
            ->add('disponible')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Projet\AdminBundle\Entity\Produit'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'projet_adminbundle_produit';
    }
}

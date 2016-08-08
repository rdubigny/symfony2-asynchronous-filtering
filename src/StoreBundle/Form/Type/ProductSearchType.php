<?php

namespace StoreBundle\Form\Type;

use Doctrine\ORM\EntityRepository;
use StoreBundle\Repository\ProductRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceList;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ProductSearchType extends AbstractType
{
    /**
     * @var array
     */
    private $productRepository;

    /**
     * @param ProductRepository $productRepository
     */
    public function __construct($productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'csrf_protection' => false,
        ));
    }


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setMethod('GET')
            ->add('search', 'text', array('required' => false))
            ->add('brands', 'entity', array(
                'class'        => 'StoreBundle\Entity\Brand',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('b')
                        ->orderBy('b.title', 'ASC');
                },
                'choice_label' => 'title',
                'choice_value' => 'id',
                'expanded'     => true,
                'multiple'     => true,
            ))
        ->add('Filter', 'submit');
    }

    public function getName()
    {
        return 'product_search';
    }
}

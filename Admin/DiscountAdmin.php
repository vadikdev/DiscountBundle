<?php
/**
 * Created by PhpStorm.
 * User: vadik
 * Date: 09.04.16
 * Time: 18:11
 */

namespace Vadiktok\DiscountBundle\Admin;

use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Sonata\AdminBundle\Admin\AbstractAdmin;

class DiscountAdmin extends AbstractAdmin {

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('code', TextType::class);
        $formMapper->add('discount', ChoiceType::class, [
            'choices' => range(0, 100),
            'label' => 'Discount rate (%)'
        ]);
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('code');
        $datagridMapper->add('used');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('code');
        $listMapper->addIdentifier('used');
        $listMapper->addIdentifier('created');
    }

    public function prePersist($object) {
        $object->setCreated(new \DateTime());
    }
}
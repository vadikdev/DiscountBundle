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
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Sonata\AdminBundle\Admin\AbstractAdmin;

class BlockedIPAdmin extends AbstractAdmin {


    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('IP', TextType::class);
        $formMapper->add('access', DateTimeType::class);
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('IP');
        $datagridMapper->add('access');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('IP');
        $listMapper->addIdentifier('access');
    }
}
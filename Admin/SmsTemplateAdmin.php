<?php
/**
 * Copyright (c) 2017. Denis N. Ragozin <dragozin@accurateweb.ru>
 *
 * For the full copyright and license information, please view the LICENSE file that was distributed with this source code.
 */

/**
 * @author Denis N. Ragozin <dragozin@accurateweb.ru>
 */

namespace Accurateweb\PropelSmsTemplateAdminBundle\Admin;


use Accurateweb\PatientPortalBundle\Model\Sms\SmsTemplate\SmsTemplate;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

class SmsTemplateAdmin extends Admin
{
  protected $translationDomain = 'PropelSmsTemplateAdminBundle';

  protected function configureFormFields(FormMapper $form)
  {
    $form->add('Text', 'textarea', array('label' => 'Шаблон'));
  }

  protected function configureListFields(ListMapper $list)
  {
    $list
      ->add('Alias', NULL, ['label' => 'Алиас'])
      ->add('Description', NULL, ['label' => 'Описание'])
      ->add('_action', 'actions', array(
        'template' => 'SonataAdminBundle:CRUD:list__action.html.twig',
        'actions' => array(
//          'show' => array('template' => 'SonataAdminBundle:CRUD:list__action_show.html.twig'),
          'edit' => array('template' => 'SonataAdminBundle:CRUD:list__action_edit.html.twig'),
//          'delete' => array('template' => 'SonataAdminBundle:CRUD:list__action_delete.html.twig')
        ),
        'label'    => 'Действия'
      ));
  }

  protected function configureDatagridFilters(DatagridMapper $filter)
  {
    parent::configureDatagridFilters($filter);
  }

  protected function configureShowFields(ShowMapper $filter)
  {
    parent::configureShowFields($filter);
  }

  public function toString($object)
  {
    return $object instanceof SmsTemplate
      ? $object->getDescription()
      : 'SMS Template';
  }

  protected function configureRoutes(RouteCollection $collection)
  {
    // to remove a single route
    $collection
      ->remove('show')
      ->remove('create')
      ->remove('delete');
    // OR remove all route except named ones
    //$collection->clearExcept(array('list', 'show'));
  }
}
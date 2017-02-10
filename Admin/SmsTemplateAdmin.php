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


use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class SmsTemplateAdmin extends Admin
{
  protected $translationDomain = 'PropelSmsTemplateAdminBundle';

  protected function configureFormFields(FormMapper $form)
  {
    parent::configureFormFields($form);
  }

  protected function configureListFields(ListMapper $list)
  {
    $list->add('Alias', NULL, ['label' => 'Алиас']);
  }

  protected function configureDatagridFilters(DatagridMapper $filter)
  {
    parent::configureDatagridFilters($filter);
  }

  protected function configureShowFields(ShowMapper $filter)
  {
    parent::configureShowFields($filter);
  }
}
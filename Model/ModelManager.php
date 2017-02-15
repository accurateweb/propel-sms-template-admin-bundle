<?php
/**
 * Copyright (c) 2017. Denis N. Ragozin <dragozin@accurateweb.ru>
 *
 * For the full copyright and license information, please view the LICENSE file that was distributed with this source code.
 */

/**
 * @author Denis N. Ragozin <dragozin@accurateweb.ru>
 */

namespace Accurateweb\PropelSmsTemplateAdminBundle\Model;


use Accurateweb\PatientPortalBundle\Model\Sms\SmsTemplate\SmsTemplate;
use Accurateweb\PropelSmsTemplateAdminBundle\DataGrid\ProxyQuery;
use Accurateweb\SmsBundle\Exception\TemplateNotFoundException;
use Accurateweb\SmsBundle\Sms\Factory\SmsFactory;

class ModelManager extends \Sonata\PropelAdminBundle\Model\ModelManager
{
  private $smsFactory;

  function __construct(SmsFactory $smsFactory)
  {
    $this->smsFactory = $smsFactory;
  }

  public function createQuery($class, $alias = 'o')
  {
    $queryClass = $class . 'Query';

    return new ProxyQuery($queryClass::create($alias), $this->smsFactory);
  }

  public function find($class, $id)
  {
    $obj =  $this->createQuery($class)->findOneByAlias($id);

    try
    {
      $template = $this->smsFactory->getTemplate($id);

      if (!$obj)
      {
        $obj = new SmsTemplate();
        $obj->fromSmsTemplate($template);
      }
      else
      {
        $obj->setDescription($template->getDescription());
        $obj->setSupportedVariables($template->getSupportedVariables());
      }
    }
    catch (TemplateNotFoundException $e)
    {
      if ($obj)
      {
        $obj = null;
      }
    }

    return $obj;
  }
}
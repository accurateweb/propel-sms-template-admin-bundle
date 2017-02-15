<?php
/**
 * Copyright (c) 2017. Denis N. Ragozin <dragozin@accurateweb.ru>
 *
 * For the full copyright and license information, please view the LICENSE file that was distributed with this source code.
 */

/**
 * @author Denis N. Ragozin <dragozin@accurateweb.ru>
 */

namespace Accurateweb\PropelSmsTemplateAdminBundle\DataGrid;


use Accurateweb\PatientPortalBundle\Model\Sms\SmsTemplate\SmsTemplate;
use Accurateweb\SmsBundle\Sms\Factory\SmsFactory;
use ModelCriteria;

class ProxyQuery extends \Sonata\PropelAdminBundle\Datagrid\ProxyQuery
{
  private $smsFactory;

  public function __construct(ModelCriteria $query, SmsFactory $smsFactory)
  {
    $this->smsFactory = $smsFactory;

    parent::__construct($query);
  }

  public function execute(array $params = array(), $hydrationMode = null)
  {
    $result = parent::execute($params, $hydrationMode);

    $templateList = $this->smsFactory->getTemplates();

    $newResult = new \PropelObjectCollection();

    foreach ($templateList as $alias => $template)
    {
      $found = false;
      /* @var $template SmsTemplate */
      foreach ($result as $existingTemplateObject)
      {
        if ($existingTemplateObject->getAlias() == $alias)
        {
          $found = true;
          $newResult->append($existingTemplateObject);

          $existingTemplateObject->setDescription($template->getDescription());
          $existingTemplateObject->setSupportedVariables($template->getSupportedVariables());

          break;
        }
      }

      if (!$found)
      {
        $newResult->append($this->createTemplateObject($alias, $template));
      }
    }

    $this->result = $newResult;

    return $newResult;
  }

  /**
   * Creates a template model for template
   *
   * @param $alias
   * @param \Accurateweb\SmsBundle\Template\SmsTemplate $template
   * @return SmsTemplate
   */
  protected function createTemplateObject($alias, \Accurateweb\SmsBundle\Template\SmsTemplate $template)
  {
    $obj = new SmsTemplate();
    $obj->fromSmsTemplate($template);

    return $obj;
  }
}
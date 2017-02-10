<?php
/**
 * Copyright (c) 2017. Denis N. Ragozin <dragozin@accurateweb.ru>
 *
 * For the full copyright and license information, please view the LICENSE file that was distributed with this source code.
 */

/**
 * @author Denis N. Ragozin <dragozin@accurateweb.ru>
 */

namespace Accurateweb\PropelSmsBundle\Template\Loader;


class PropelTemplateLoader implements TemplateLoaderInterface
{
  private $model,
          $column;

  function __construct($model, $column)
  {
    $this->model = $model;
    $this->column = $column;
  }

  /**
   * @param $templateName
   */
  public function load($templateName)
  {
    $query = call_user_func([$this->model.'Query', 'create']);

    $object = $query->filterBy($this->column, $templateName)
                    ->findOne();
  }
}
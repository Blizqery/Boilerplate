<?php
/**
 * BaseForm.php.
 * User: Ladislav Tomsa
 * Date: 11. 7. 2015
 * Time: 15:03
 */

namespace App\AdminModule\Forms;

abstract class BaseForm extends \ADT\BaseForm {

    use \Kdyby\Autowired\AutowireProperties;

    public function __construct(\Nette\DI\Container $dic)
    {
        $this->injectProperties($dic);
        parent::__construct();
    }
}
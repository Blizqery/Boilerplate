<?php
/**
 * User: Ladislav Tomsa
 * Date: 11. 7. 2015
 * Time: 14:21
 */

namespace App\Components\Grids;


abstract class BaseGrid extends \ADT\Datagrid\Datagrid
{
    use \Kdyby\Autowired\AutowireProperties;

    public function __construct(\Nette\DI\Container $dic)
    {
        $this->injectProperties($dic);
        parent::__construct();

        $this->setRowPrimaryKey('id');

        $this->setDataSourceCallback($this->dataSourceFactory);

        // cellsTemplate musí být zde, aby si mohla zděděná třída zvolit prioritu
        $this->addCellsTemplate(__DIR__ . DIRECTORY_SEPARATOR . 'BaseGrid.latte');
        $this->addCellsTemplate(preg_replace('/\.php$/', '.latte', $this->getReflection()->fileName));
    }

    abstract function dataSourceFactory($filter, $order);

    public function getFilteredDataSource()
    {
        return $this->getData();
    }

    public function createComponentForm() {
        $form = parent::createComponentForm();

        if (isset($form['filter']) && isset($form['filter']['cancel'])) {
            $form['filter']['cancel']->caption = "×";
        }

        return $form;
    }

}
<?php
/**
 * Builder.php.
 * User: Ladislav Tomsa
 * Date: 11. 7. 2015
 * Time: 14:31
 */

namespace App\Forms;



class Builder extends \Nette\Object
{

    /** @var array */
    protected $modifiers;

    /** @return \Nette\ComponentModel\IContainer */
    public function build(\Nette\ComponentModel\IContainer $container, $defaults = []) {
        foreach ($this->modifiers as $modifier) {
            $modifier($container, $defaults);
        }

        return $container;
    }

}
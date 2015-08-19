<?php
/**
 * BasePresenter.php.
 * User: Ladislav Tomsa
 * Date: 11. 7. 2015
 * Time: 14:47
 */

namespace App\AdminModule\Presenters;


use Nette;

/**
 * Base presenter for all application presenters.
 */
abstract class BasePresenter extends Nette\Application\UI\Presenter
{
    use \Kdyby\Autowired\AutowireProperties;
    use \Kdyby\Autowired\AutowireComponentFactories;

    protected function startup() {
        parent::startup();

        // If user is not signed in, redirect to sign in page
        if(!$this->getUser()->isLoggedIn() && $this->name !== "Admin:Sign" && $this->action !== "in") {
            $this->redirect('Sign:in');
        }

        /**
         * If user is not allowed to access the page, redirect to Homepage:default
         * Roles, resources and rights are defined in App/model/Authorizator
         */
        if (!$this->getUser()->isAllowed($this->name, $this->action)) {
            $this->flashMessage('Permission denied.', 'danger');
            $this->redirect('Homepage:default');
        }
    }
}
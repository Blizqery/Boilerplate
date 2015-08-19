<?php
/**
 * SignPresenter.php.
 * User: Ladislav Tomsa
 * Date: 11. 7. 2015
 * Time: 15:01
 */

namespace App\AdminModule\Presenters;

/**
 * Class SignPresenter
 * @package App\Presenters
 */
class SignPresenter extends BasePresenter
{
    /**
     * @autowire
     * @var \App\AdminModule\Forms\ISignFormFactory
     */
    public $signFactory;


    /**
     * If user is logged in, redirect to Homepage:default
     */
    public function actionIn() {
        if($this->getUser()->isLoggedIn()) {
            $this->redirect('Homepage:default');
        }
    }

    /**
     * Sign out
     */
    public function actionOut()
    {
        if($this->getUser()->isLoggedIn()) {
            $this->getUser()->logout(TRUE);
            $this->getSession()->destroy();
            $this->flashMessage("Odhlášení proběhlo úspěšně.", "success");
            $this->redirect("Sign:in");
        } else {
            $this->redirect("Sign:in");
        }
    }

    /**
     * Sign in
     */
    protected function createComponentSignInForm(\App\AdminModule\Forms\ISignFormFactory $factory)
    {
        $form = $factory->create();
        return $form;
    }


}
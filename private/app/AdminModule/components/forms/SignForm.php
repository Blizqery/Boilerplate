<?php
/**
 * SignForm.php.
 * User: Ladislav Tomsa
 * Date: 11. 7. 2015
 * Time: 15:04
 */


namespace App\AdminModule\Forms;

use Nette\Application\UI\Form,
    Nette\Security\User;

interface ISignFormFactory {

    /**
     * @return SignForm
     */
    public function create();
}
class SignForm extends BaseForm
{
    /**
     * @autowire
     * @var User
     */
    protected $user;

    /**
     * @return Form
     */
    public function init(Form $form)
    {
        $form->addText('username', 'Uživatelské jméno')
            ->setAttribute('placeholder', "Uživatelské jméno")
            ->setRequired('Prosím, vyplňtě své jméno.');
        $form->addPassword('password', 'Heslo:')
            ->setAttribute('placeholder', "Heslo")
            ->setRequired('Prosím, vyplně své heslo.');
        $form->addCheckbox('remember', ' Zapamatovat přihlášení');
        $form->addSubmit('send', 'Přihlásit se');
        $form->addProtection();
    }


    public function processForm($values)
    {
        if ($values->remember) {
            $this->user->setExpiration('14 days', FALSE);
        } else {
            $this->user->setExpiration('20 minutes', TRUE);
        }
        try {
            $this->user->login($values->username, $values->password);
            $this->presenter->redirect("Homepage:");
        } catch (Nette\Security\AuthenticationException $e) {
            $this->addError($e->getMessage());
        }
    }

}
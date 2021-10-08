<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette\Application\UI\Form;
use Doctrine\ORM\Mapping\Builder\FieldBuilder;
use Nette;


use Nettrine\DBAL\DI\DbalExtension;

final class HomepagePresenter extends Nette\Application\UI\Presenter
{
    private ?bool $login = true;

    public function renderDefault() : void
    {
        $this->template->login = $this->login;
    }

    public function handleShowLogin() : void
    {

        if ($this->isAjax()) {
            $this->login = false;
            $this->redrawControl('loginScreen');
        }
    }

    public function createComponentLoginForm() : Form {
        $form = new Form;

        $form   ->setHtmlAttribute('class','tf');

        $form   ->addText('name', 'Name: ')
                ->setRequired('You dont have a NAME ?');

        $form   ->addPassword('passw','Password: ')
                ->setRequired('It wont work without password!');

        $form   ->addSubmit('submit', 'Login');

        $form   ->onSuccess[] = [$this, 'Succeeded'];

        return $form;

    }


    public function succeeded(Form $form, \stdClass $values) : void
    {
        try {
            $this->getUser()->login($values->name, $values->passw);
            $this->redirect('Todo:todo');

        } catch (Nette\Security\AuthenticationException $e) {
            $form->addError('Nesprávné přihlašovací jméno nebo heslo.');
        }
    }


}

<?php

declare(strict_types=1);

namespace App\Model;

use App\Presenters\HomepagePresenter;

use Nette\Forms\Form;
use Nette\Security\User;

Class LoginForm
{
    public Form $form;
    public User $user;
    public HomepagePresenter $homepagePresenter;


    /**
     * @param Form $form
     */
    public function __construct($user)
    {
        $this->user = $user;
        $form = new Form;
        $form   ->setHtmlAttribute('class','tf');
        $form   ->addText('name', 'Name: ')
                ->setRequired('You dont have a NAME ?');
        $form   ->addPassword('passw','Password: ')
                ->setRequired('It wont work without password!');
        $form   ->addSubmit('submit', 'Login');

        $form   ->onSuccess[] = [$this, 'Succeded'];

        $this->form = $form;
    }


    public function renderMe() : void {
        $this->form->render();
    }

    public function succeded() : void {
        $values = $this->form->getValues();

        try {
            $this->user->getUser()->login($values->name, $values->passw);
//            TODO redirect

        } catch (Nette\Security\AuthenticationException $e) {
            $this->form->addError('Nesprávné přihlašovací jméno nebo heslo.');

        }
    }



}
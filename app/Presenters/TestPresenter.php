<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Model\TodoCollection;
use Nette;
use Nette\Application\UI\Form;
use App\Model\Todo;
use App\Model\Database\Entity\NetrineTodo;

final class TestPresenter extends Nette\Application\UI\Presenter
{

    /**
     * @var Todo @inject
     */
    public Todo $todo;
    public TodoCollection $todoCollection;


    public function renderTest() : void
    {
           $this->template->comment = $this->todoCollection->getById(3);

    }



}

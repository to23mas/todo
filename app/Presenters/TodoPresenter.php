<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;
use App\Model\Todo;
use App\Model\TodoCollection;

final class TodoPresenter extends Nette\Application\UI\Presenter
{

    /**
     * @var Todo @inject
     */
    public Todo $todo;

    /**
     * @var TodoCollection @inject
     */
    public TodoCollection $todoCollection;


    public function renderTodo() : void
    {
        $this->template->high   = $this->todoCollection->getByPriority(3);
        $this->template->medium = $this->todoCollection->getByPriority(2);
        $this->template->low    = $this->todoCollection->getByPriority(1);
    }

    public function createComponentTodoForm() : Form {

        $pr = [
            '3' => 'high',
            '2' => 'medium',
            '1' => 'low',
        ];
        $form = new Form;
        $form   ->addText('task','Task: ')
                ->setRequired('Enter smth!!');
        $form->addRadioList('priority', 'Priority: ', $pr)
                ->setRequired('Choose one!!!') ;
        $form   ->addSubmit('send', 'Save');
        $form   ->onSuccess[] = [$this, 'formSucceeded'];

        return $form;
    }

    public function formSucceeded(Form $form, \stdClass $data) : void {

        $this->todo->saveToDatabase($data->task, $data->priority);

        $form->reset();
        $this->redrawControl('todoSection');
        $this->payload->url = $this->link('this');
    }

    public function handleDel(?int $id) : void
    {
        $this->todo->delete($id);

        if($this->isAjax()){
            $this->redrawControl('todoSection');
        }else {
            $this->redirect('Todo:todo');
        }
    }

    public function handleCheck(?int $id, ?bool $complete) : void
    {
        $this->todo->check($id, $complete);
        if($this->isAjax()){
            $this->redrawControl('todoSection');
        }else {
            $this->redirect('Todo:todo');
        }
    }

    public function handleComment() : void {
        $this->redirect('Test:test');
    }
}

<?php
namespace App\Model;

use App\Model\Database\Entity\NetrineTodo;
use Doctrine\ORM\EntityRepository;
use Nette;
use Nettrine\ORM\EntityManagerDecorator;

class Todo
{

    protected EntityManagerDecorator $entityManager;
    protected EntityRepository $repository;

    public function __construct(EntityManagerDecorator $entityManagerDecorator)
    {
        $this->entityManager = $entityManagerDecorator;
        $this->repository = $entityManagerDecorator->getRepository(NetrineTodo::class);
    }


    public function saveToDatabase(?string $task, ?int $priority) : void
    {
        $entity = new NetrineTodo($task, $priority);
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }

    public function delete(int $id): void
    {
        $entity = $this->repository->find($id);
        $this->entityManager->remove($entity);
        $this->entityManager->flush();
    }

    public function check(int $id, bool $complete)
    {
        $entity = $this->repository->find($id);
        if($complete){
            $entity->setComplete(0);
        }else{
            $entity->setComplete(1);
        }
        $this->entityManager->flush();
    }
}
<?php
namespace App\Model;

use App\Model\Database\Entity\NetrineTodo;
use Doctrine\ORM\EntityRepository;
use Nette;
use Nettrine\ORM\EntityManagerDecorator;

class TodoCollection
{
    protected EntityManagerDecorator $entityManager;
    protected EntityRepository $repository;

    public function __construct(EntityManagerDecorator $entityManagerDecorator)
    {
        $this->entityManager = $entityManagerDecorator;
        $this->repository = $entityManagerDecorator->getRepository(NetrineTodo::class);
    }

    public function getByPriority(int $priority): array
    {
        return $this->repository->findBy(['priority' => $priority], ['complete' => 'ASC', 'created_at' => 'DESC']);
    }
    public function getById(int $id): array
    {
        return $this->repository->find($id);
    }

    public function getTask(int $id)
    {
        return $this->repository->find($id);
    }

    public function getComments(int $id)
    {
        $entity = $this->repository->find($id);
        $entity->getComments();
        $this->entityManager->flush();
    }


}
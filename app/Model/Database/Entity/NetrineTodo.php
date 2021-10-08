<?php declare(strict_types = 1);

namespace App\Model\Database\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Nettrine\ORM\Entity;




/**
 * @ORM\Entity
 * @ORM\Table(name="tasks")
 */
class NetrineTodo {


    /**
     * @ORM\Id
     * @ORM\GeneratedValue()
     * @ORM\Column(name="id", type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(name="task", type="string")
     */
    private string $task;

    /**
     * @ORM\Column(name="complete", type="boolean")
     */
    private bool $complete = false;

    /**
     * @ORM\Column(name="priority", type="integer")
     */
    private int $priority;
    /**
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private \DateTimeInterface $created_at;

    /****************************************/

    /**
     * @ORM\OneToMany(targetEntity="App\Model\Database\Entity\Comments", mappedBy="tasks")
     */
    private $comments;

    /****************************************/
    /**
     * @param string $task
     * @param int $priority
     * @param bool $complete
     */
    public function __construct(string $task, int $priority, bool $complete = false)
    {
        $this->task = $task;
        $this->complete = $complete;
        $this->priority = $priority;
        $this->created_at = new \DateTime();
        $this->comments = new ArrayCollection();
    }


//    public function addComment(Comments $comment): self
//    {
//        $this->comments[] = $comment;
//
//        return $this;
//    }

//    public function removeComment(Comments $comment): bool
//    {
//        return $this->comments->removeElement($comment);
//    }
//    public function getComments(): Collection
//    {
//        return $this->comments;
//    }

    /**
     * @return null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTask(): string
    {
        return $this->task;
    }

    /**
     * @return bool
     */
    public function isComplete(): bool
    {
        return $this->complete;
    }

    /**
     * @return int
     */
    public function getPriority(): int
    {
        return $this->priority;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getCreatedAt() : \DateTimeInterface
    {
        return $this->created_at;
    }

    /**
     * @param string $task
     */
    public function setTask(string $task): void
    {
        $this->task = $task;
    }

    /**
     * @param bool $complete
     */
    public function setComplete(bool $complete): void
    {
        $this->complete = $complete;
    }

    /**
     * @param int $priority
     */
    public function setPriority(int $priority): void
    {
        $this->priority = $priority;
    }

    /**
     * @param mixed $comment
     */
    public function setComment($comment): void
    {
        $this->comment = $comment;
    }


}

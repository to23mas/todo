<?php declare(strict_types = 1);

namespace App\Model\Database\Entity;


use Doctrine\ORM\Mapping as ORM;

use Nettrine\ORM\Entity;

/**
 * @ORM\Entity
 * @ORM\Table(name="comments")
 */
class Comments{


    /**
     * @ORM\Id
     * @ORM\GeneratedValue()
     * @ORM\Column(name="id", type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(name="task", type="string")
     */
    private $text;


    /**
     * @ORM\ManyToOne(targetEntity="App\Model\Database\Entity\NetrineTodo", inversedBy="comments")
     * @ORM\JoinColumn(name="tasks_id", referencedColumnName="id")
     */
    private $netrineTodo;

    /**
     * @param $text
     */
    public function __construct($text)
    {
        $this->text = $text;
    }

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
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText(string $text): void
    {
        $this->text = $text;
    }






}
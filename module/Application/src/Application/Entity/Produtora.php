<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Produtora
 *
 * @ORM\Table(name="produtora")
 * @ORM\Entity(repositoryClass="Application\Entity\Repository\Produtora")
 */
class Produtora
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=100, nullable=true)
     */
    private $nome;



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nome
     *
     * @param string $nome
     *
     * @return Produtora
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome
     *
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }
    
         public function toArray()
    {
        return[
            'id' =>$this->getId(),
            'nome' =>$this->getNome(),
        ];
    }

}

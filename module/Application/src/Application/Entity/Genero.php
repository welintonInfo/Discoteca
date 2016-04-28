<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Genero
 *
 * @ORM\Table(name="genero")
 * @ORM\Entity(repositoryClass="Application\Entity\Repository\Genero")
 */
class Genero
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
     * @ORM\Column(name="descricao", type="string", length=45, nullable=true)
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
     * Set descricao
     *
     * @param string $nome
     *
     * @ORM\Entity(repositoryClass="Application\Entity\Repository\Genero")
     */
    public function setNome($nome)
    {
        $this->$nome = $nome;

        return $this;
    }

    /**
     * Get descricao
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

<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Musica
 *
 * @ORM\Table(name="musica", indexes={@ORM\Index(name="fk_Musica_Album1_idx", columns={"Album_id"}), @ORM\Index(name="fk_Musica_Genero1_idx", columns={"Genero_id"})})
 * @ORM\Entity(repositoryClass="Application\Entity\Repository\Musica")
 */
class Musica
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
     * @var \Application\Entity\Album
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Album")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Album_id", referencedColumnName="id")
     * })
     */
    private $album;

    /**
     * @var \Application\Entity\Genero
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Genero")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Genero_id", referencedColumnName="id")
     * })
     */
    private $genero;



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
     * @return Musica
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

    /**
     * Set album
     *
     * @param \Application\Entity\Album $album
     *
     * @return Musica
     */
    public function setAlbum($album = null)
    {
        $this->album = $album;

        return $this;
    }

    /**
     * Get album
     *
     * @return \Application\Entity\Album
     */
    public function getAlbum()
    {
        return $this->album;
    }

    /**
     * Set genero
     *
     * @param \Application\Entity\Genero $genero
     *
     * @return Musica
     */
    public function setGenero($genero = null)
    {
        $this->genero = $genero;

        return $this;
    }

    /**
     * Get genero
     *
     * @return \Application\Entity\Genero
     */
    public function getGenero()
    {
        return $this->genero;
    }
    
     public function toArray()
    {
        return[
            'id' =>$this->getId(),
            'nome' =>$this->getNome(),
   	    'album' =>$this->getAlbum(),
	    'genero' =>$this->getGenero(),
        ];
    }
}

<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Album
 *
 * @ORM\Table(name="album", indexes={@ORM\Index(name="fk_Album_Produtora1_idx", columns={"Produtora_id"}), @ORM\Index(name="fk_Album_Artista1_idx", columns={"Artista_id"})})
 * @ORM\Entity(repositoryClass="Application\Entity\Repository\Album")
 */
class Album
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
     * @var float
     *
     * @ORM\Column(name="valor", type="float", precision=10, scale=0, nullable=true)
     */
    private $valor;

    /**
     * @var \Application\Entity\Artista
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Artista")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Artista_id", referencedColumnName="id")
     * })
     */
    private $artista;

    /**
     * @var \Application\Entity\Produtora
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Produtora")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Produtora_id", referencedColumnName="id")
     * })
     */
    private $produtora;



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
     * @return Album
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
     * Set valor
     *
     * @param float $valor
     *
     * @return Album
     */
    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Get valor
     *
     * @return float
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Set artista
     *
     * @param \Application\Entity\Artista $artista
     *
     * @return Album
     */
    public function setArtista($artista = null)
    {
        $this->artista = $artista;

        return $this;
    }

    /**
     * Get artista
     *
     * @return \Application\Entity\Artista
     */
    public function getArtista()
    {
        return $this->artista;
    }

    /**
     * Set produtora
     *
     * @param \Application\Entity\Produtora $produtora
     *
     * @return Album
     */
    public function setProdutora($produtora = null)
    {
        $this->produtora = $produtora;

        return $this;
    }

    /**
     * Get produtora
     *
     * @return \Application\Entity\Produtora
     */
    public function getProdutora()
    {
        return $this->produtora;
    }
    
    /**
     * @ORM\OneToMany(targetEntity="Application\Entity\Musica", mappedBy="album")
    */
    private $musicas;
    public function getMusicas()
    {
        return $this->musicas;
    }
    
     public function toArray()
    {
        return[
            'id' =>$this->getId(),
            'nome' =>$this->getNome(),
	    'valor' =>$this->getValor(),
	    'artista' =>$this->getArtista(),
	    'produtora' =>$this->getProdutora(),		
        ];
    }
}

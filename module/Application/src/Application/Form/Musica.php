<?php
namespace Application\Form;
use Doctrine\ORM\EntityManager;

use Zend\Form\Form;
class Musica extends Form 
{
    protected $entityManager;
    public function __construct($array,$nome = null, $options = null) {
        parent::__construct($nome,$options);
     
        
        $this->setAttribute('method','post');
        $id = new \Zend\Form\Element\Hidden('id');
        $this->add($id);
              
        $nome = new \Zend\Form\Element\Text('nome');
        $nome->setLabel('Nome da Musica')
                ->setAttributes(['class' => 'texto-label'])
                ->setAttribute('class', 'form-control');
        $this->add($nome);
        
        $album = new \Zend\Form\Element\Select('album');
        
        $album->setLabel('Album')
                ->setAttributes(['class' =>'texto-label'])
                ->setAttribute('class', 'form-control')
                ->setValueOptions($array['Album']);
        $this->add($album);        
              
        $genero = new \Zend\Form\Element\Select('genero');
        $genero->setLabel('Genero')
                ->setAttributes(['class' =>'texto-label'])
                ->setAttribute('class', 'form-control')
                ->setValueOptions($array['Genero']);;
        $this->add($genero);         
        
       $submit = new \Zend\Form\Element\Submit('submit');
        $submit->setValue('Salvar')
                ->setAttributes(['class' => 'texto-label'])
                ->setAttribute('class', 'btn');
        $this->add($submit);
    }
    
   

}


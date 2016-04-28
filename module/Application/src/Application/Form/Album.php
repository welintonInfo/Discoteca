<?php
namespace Application\Form;
use Doctrine\ORM\EntityManager;
use Zend\Mvc\Controller\AbstractActionController;

use Zend\Form\Form;
class Album extends Form
{
    protected $entityManager;
    
    public function __construct($array, $nome = null, $options = null) {
        parent::__construct($nome,$options);
     
//        print_r($array);exit;
//        $this->setAttribute('method','post');
        $id = new \Zend\Form\Element\Hidden('id');
        $this->add($id);
        
        $nome = new \Zend\Form\Element\Text('nome');
        $nome->setLabel('Nome do Album')->setAttributes(['class' => 'texto-label'])
                ->setAttribute('class', 'form-control');
        $this->add($nome);
               
        
        $artista = new \Zend\Form\Element\Select('artista');        
        $artista->setLabel('Artista/Banda')->setAttributes(['class' => 'texto-label'])
                ->setAttribute('class', 'form-control')
                ->setValueOptions($array['artista']);
        
        $this->add($artista); 
        
       

        $produtora = new \Zend\Form\Element\Select('produtora');
        $produtora->setLabel('Produtora')->setAttributes(['class' => 'texto-label'])
                ->setAttribute('class', 'form-control')
                ->setValueOptions($array['produtora']);
        $this->add($produtora);
        
        $valor = new \Zend\Form\Element\Text('valor');
        $valor->setLabel('Valor R$')->setAttributes(['class' => 'texto-label'])
                ->setAttribute('class', 'form-control');
        $this->add($valor);
        
    $submit = new \Zend\Form\Element\Submit('submit');
        $submit->setValue('Salvar')
                ->setAttributes(['class' => 'texto-label'])
                ->setAttribute('class', 'btn');
        $this->add($submit);
    }
    
    

}


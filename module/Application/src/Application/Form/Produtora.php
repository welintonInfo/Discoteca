<?php
namespace Application\Form;
use Doctrine\ORM\EntityManager;
use Zend\Form\Form;
class Produtora extends Form
{
    public function __construct($nome = null, $options = null) {
        parent::__construct($nome,$options);
        
        $this->setAttribute('method','post');
        $id = new \Zend\Form\Element\Hidden('id');
        $this->add($id);
        
        $nome = new \Zend\Form\Element\Text('nome');
        $nome->setLabel('Nome da Produtora')->setAttributes(['class' => 'texto-label'])->setAttribute('class', 'form-control');
        $this->add($nome);
        
        $submit = new \Zend\Form\Element\Submit('submit');
        $submit->setValue('Salvar')
                ->setAttributes(['class' => 'texto-label'])
                ->setAttribute('class', 'btn');
        $this->add($submit);
    }
}


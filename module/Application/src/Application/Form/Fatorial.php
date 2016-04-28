<?php
namespace Application\Form;
use Doctrine\ORM\EntityManager;
use Zend\Form\Form;


class Fatorial extends Form
{
    public function __construct($nome = null, $options = null) {
        parent::__construct($nome,$options);
        
        $this->setAttribute('method','post');
        $this->setInputFilter(new ArtistaFilter);
       
        
        $fat = new \Zend\Form\Element\Text('num');
        $fat->setLabel('Numero para o fatorial')
                ->setAttributes(['class' => 'texto-label'])
                ->setAttribute('class', 'form-control');
        $this->add($fat);
        
        
        $submit = new \Zend\Form\Element\Submit('submit');
        $submit->setValue('Calcular')
                ->setAttributes(['class' => 'texto-label'])
                ->setAttribute('class', 'btn');
        $this->add($submit);
    }
}


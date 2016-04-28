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
        
        
    $submit = new \Zend\Form\Element\Submit('submit');
        $submit->setValue('Salvar')
                ->setAttributes(['class' => 'texto-label'])
                ->setAttribute('class', 'btn');
        $this->add($submit);
    }
    
    

}


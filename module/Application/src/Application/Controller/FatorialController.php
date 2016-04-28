<?php
 
namespace Application\Controller;
 
use Application\Controller\AbstractController;
use Zend\View\Model\ViewModel;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;
use Application\Form\Fatorial as Form;


 
class FatorialController extends AbstractController
{
    public function indexAction()
    {
        
        $req = $this->getRequest();
        $form = new Form();
         $msg = null; 
         $fat = 0;
        $num = $this->params()->fromRoute('num',false);
        $comb  =  $this->params()->fromRoute('comb',false);
        if($req->isPost())
        {
            $post = $req->getPost('num');
            $fat = $this->Fatorial($post);
            $msg = 'Valor do fatorial é: <strong style="font-size:18px;">'.$fat.'</strong>';
           
        }else
        {
            if($num)
            {
                $form->setData($fat->toArray());
                
            }
        
        }
        return new ViewModel(array('fat' => $fat,'form' => $form, 'msg' => $msg));
       
    }
    
    public function Fatorial($num)
    {
        if($num > 1)
        {
           return $num * $this->Fatorial($num - 1);
        }
       return 1;
    }
    
    
}
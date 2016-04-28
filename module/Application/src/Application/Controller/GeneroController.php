<?php
 
namespace Application\Controller;
 
use Application\Controller\AbstractController;
use Zend\View\Model\ViewModel;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;
use Application\Form\Genero as FormGenero;


 
class GeneroController extends AbstractController
{
    public function indexAction()
    {
        @$em = $this->getServiceLocator()->get('Doctrine\orm\EntityManager');
         $repo = $this->getEntity('Genero');
        $req = $this->getRequest();
        $formGenero = new FormGenero();
         $msg = ''; 
        $id = $this->params()->fromRoute('id',false);
        if($req->isPost())
        {
            $post = $req->getPost()->toArray();
            $msg = $repo->salvar($post);
           
        }else
        {
            if($id)
            {
                $genero = $repo->find($id);
                $formGenero->setData($genero->toArray());
            }
        }
        
            
        
        $dados = $repo->findAll();
        $page = $this->params()->fromRoute('page');
        $paginator = new Paginator(new ArrayAdapter($dados));
        $paginator->setCurrentPageNumber($page)
                ->setDefaultItemCountPerPage(5);
        
        return new ViewModel(array('dados' => $paginator,'form' => $formGenero, 'msg' => $msg));
       
    }
    
    
    
    public function deleteAction()
    {
      @$em = $this->getServiceLocator()->get('Doctrine\orm\EntityManager');
       $repo = $this->getEntity('Genero');      
         $req = $this->getRequest();
        $id = $this->params()->fromRoute('id',0);
       if($repo->delete($id))
           $msg = 'Registro deletado';
        
        return $this->redirect()->toRoute('full-app',array('controller' => 'genero'));
      
    }
    
}
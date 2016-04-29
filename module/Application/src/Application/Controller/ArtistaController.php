<?php
 
namespace Application\Controller;
 
use Application\Controller\AbstractController;
use Zend\View\Model\ViewModel;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;
use Application\Form\Artista as FormArtista;


 
class ArtistaController extends AbstractController
{
    public function indexAction()
    {
        @$em = $this->getServiceLocator()->get('Doctrine\orm\EntityManager');
        $repo = $em->getRepository('Application\Entity\Artista');
        $req = $this->getRequest();
        $formArtista = new FormArtista();
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
                $artista = $repo->find($id);
                $formArtista->setData($artista->toArray());
            }
        }
        
            
        
        $dados = $repo->findAll();
        $page = $this->params()->fromRoute('page');
        $paginator = new Paginator(new ArrayAdapter($dados));
        $paginator->setCurrentPageNumber($page)
                ->setDefaultItemCountPerPage(3);
        
        return new ViewModel(array('dados' => $paginator,'form' => $formArtista, 'msg' => $msg));
       
    }
    
    
    
    public function deleteAction()
    {
      @$em = $this->getServiceLocator()->get('Doctrine\orm\EntityManager');
       $repo = $this->getEntity('Artista');      
       $req = $this->getRequest();
       $id = $this->params()->fromRoute('id',0);
       if($repo->delete($id))
           $msg = 'Registro deletado';
        
        return $this->redirect()->toRoute('full-app',array('controller' => 'artista'));
      
    }
    
}
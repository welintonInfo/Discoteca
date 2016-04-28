<?php
 
namespace Application\Controller;
 
use Application\Controller\AbstractController;
use Zend\View\Model\ViewModel;
use Application\Form\Produtora as FormProdutora;
 
class ProdutoraController extends AbstractController
{
    public function indexAction()
    {
        @$em = $this->getServiceLocator()->get('Doctrine\orm\EntityManager');
        $entidade = $em->getRepository('Application\Entity\Produtora');
        $req = $this->getRequest();
        $msg = '';
        $formProdutora = new FormProdutora();      
        $id = $this->params()->fromRoute('id',false);
        if($req->isPost())
        {
            $post = $req->getPost()->toArray();
            $msg = $entidade->salvar($post);
        }else
        {
            if($id)
            {
                $produtora = $entidade->find($id);
                $formProdutora->setData($produtora->toArray());
            }
        }         
        $dados = $entidade->findAll();
        
        return new ViewModel(array('dados' => $dados,'form' => $formProdutora, 'msg' => $msg));
       
    }
        public function deleteAction()
    {
      @$em = $this->getServiceLocator()->get('Doctrine\orm\EntityManager');
      $repo = $em->getRepository('Application\Entity\Produtora');      
         $req = $this->getRequest();
        $id = $this->params()->fromRoute('id',0);
       if($repo->delete($id))
           echo 'Registro deletado';
        
        return $this->redirect()->toRoute('full-app',array('controller' => 'produtora'));
      
    }
}
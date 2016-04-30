<?php
 
namespace Application\Controller;
 
use Zend\View\Model\ViewModel;
use Doctrine\DBAL\DBALException;
use Application\Form\Album as FormAlbum;
 
class AlbumController extends AbstractController
{
    public function indexAction()
    {
       $repo = $this->getEntity('Album');
       $msg = ''; 
       $msgError = null;
        $req = $this->getRequest();
        $param['artista']=$this->getOptionSelect('Artista');
        $param['produtora']=$this->getOptionSelect('Produtora');
        $formAlbum = new FormAlbum($param);      
        $id = $this->params()->fromRoute('id',false);
        if($req->isPost())
        {
            try{
                $post = $req->getPost()->toArray();
                $msg = $repo->salvar($post);
            } catch (DBALException $ex) {
                $msgError = "Impossivel salvar registro!<br>
                    Necessário preencher todos os campos Artista/Banda* e Produtora* ";
            }


        }else
        {
            if($id)
            {
                $album = $repo->find($id);
                $formAlbum->setData($album->toArray());
            }
        }
        $dados = $repo->findAll();

        return new ViewModel(array('dados' => $dados,'form' => $formAlbum, 'msg' => $msg, 'msgError' => $msgError));
       
    }
   
      public function deleteAction()
    {
        @$em = $this->getServiceLocator()->get('Doctrine\orm\EntityManager');
       $repo = $this->getEntity('Album');   
         $req = $this->getRequest();
        $id = $this->params()->fromRoute('id',0);
       $repo->delete($id); 
        
        return $this->redirect()->toRoute('full-app',array('controller' => 'album'));
    }    
      
}
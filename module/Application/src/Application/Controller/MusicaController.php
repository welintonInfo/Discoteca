<?php
 
namespace Application\Controller;
 
use Doctrine\DBAL\DBALException;
use Zend\View\Model\ViewModel;
use Application\Form\Musica as FormMusica;
 
class MusicaController extends AbstractController
{
    public function indexAction()
    {
        
        $entidade = $this->getEntity('Musica');
        $params['Album'] = $this->getOptionSelect('Album');
        $params['Genero'] = $this->getOptionSelect('Genero');
         $msg = ''; 
         $msgError = null;
        $req = $this->getRequest();
        $formMusica = new FormMusica($params);      
        $id = $this->params()->fromRoute('id',false);
        if($req->isPost())
        {
            try{
                 $post = $req->getPost()->toArray();
                 $msg = $entidade->salvar($post);
            } catch (DBALException $ex) {
                  $msgError = "Impossivel salvar registro!<br> Necessário preencher todos os campos Album* e Genero* ";  
            }
        }else
        {
            if($id)
            {
                $musica = $entidade->find($id);
                $formMusica->setData($musica->toArray());
            }
        }         
        $dados = $entidade->findAll();
        
        return new ViewModel(array('dados' => $dados,'form' => $formMusica, 'msg' =>$msg, 'msgError' => $msgError));
       
    }
    
        public function deleteAction()
    {
      @$em = $this->getServiceLocator()->get('Doctrine\orm\EntityManager');
       $repo = $this->getEntity('Musica');      
         $req = $this->getRequest();
        $id = $this->params()->fromRoute('id',0);
       if($repo->delete($id))
           $msg = 'Registro deletado';
        
        return $this->redirect()->toRoute('full-app',array('controller' => 'musica'));
      
    }
}
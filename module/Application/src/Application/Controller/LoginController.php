<?php
 
namespace Application\Controller;
 
use Application\Controller\AbstractController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;


class LoginController extends AbstractController
{
    public function indexAction()
    {
    $request = $this->getRequest();
         
        if ($request->isPost()) {
            $dadosForm = $request->getPost()->toArray();
             
            /**
             * Aqui aplica todo o processo de validação do usuário.
             * Ex.: consulta ao banco de dados procurando pelo usuário e senha.             
             */
             
            if ($dadosForm['usuario'] == 'admin' && $dadosForm['senha'] == '123') {
                $sessao = new Container('Auth');
                $sessao->admin = true;
                return $this->redirect()->toRoute('home');
            } else {
               return $this->redirect()->toRoute('login/default', array('action' => 'acesso-negado'));
            }
        }
 
    $view =  new ViewModel();
    return $view->setTerminal(true);
    }
    
    public function sairAction()
    {
        $sessao = new Container;
        $sessao->getManager()->getStorage()->clear();
        return $this->redirect()->toRoute('login');
    }
}
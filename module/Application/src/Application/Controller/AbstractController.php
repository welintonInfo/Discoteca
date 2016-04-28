<?php
 
namespace Application\Controller;
 
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;
use Zend\View\Model\ViewModel; 

class AbstractController extends AbstractActionController
{
    protected $em;
    protected $entity;
    protected $controller;
    protected $route;
    protected $service;
    protected $form;
    
    
    
//FUNÇÕES PARA AS SELECTS DO DB
    public function getEntity($entity) {
         @$em = $this->getServiceLocator()->get('Doctrine\orm\EntityManager');
         return $em->getRepository('Application\Entity\\'.$entity);
    }
    
     public function getOptionSelect($entity) 
    {
        @$em = $this->getServiceLocator()->get('Doctrine\orm\EntityManager');
        $repo = $em->getRepository('Application\Entity\\'.$entity);
        
        $ent = $repo->findBy([],['nome'=>'ASC']);
        $array['0']='---';
        foreach ($ent as $dados):
            $array[$dados->getId()]=$dados->getNome();
        endforeach;
        return $array;
    }
   
    

    
    public function indexAction()
    {
        $list = $this->getEm()->getRepository($this->entity)->findAll();
        $page = $this->params()->fromRoute('page');
        
        $paginator = new Paginator(new ArrayAdapter($list));
        $paginator->setCurrentPageNumber($page)
                ->setDefaultItemCountPerPage(10);
        
        return new ViewModel(array('data' => $paginator, 'page' => $page));
        
    }
    
    /**
     * Inserir registro
     */
    public function inserirAction()
    {
        if(is_string($this->form))
            $form = new$this->form;
        else
            $form = $this->form;
        
        $request = $this->getRequest();
        if($request->isPost())
        {
            $form->setData($request->getPost());            
            if ($form->isValid())
            {
                $service = $this->getServiceLocator()->get($this->service);
                if ($service->salvar($request->getPost()->toArray()))
                {
                    $this->flashMessenger()
                            ->addSuccessMessage('Cadastrado com sucesso');
                }
                else
                {
                    $this->flashMessenger()
                            ->addErrorMessage('Não foi possivel cadastrar! Tente novamente mais tarde.');
                }
                return $this->redirect()->toRoute($this->route, array('controller' => $this->controller));
            }
        }
        
        if ($this->flashMessenger()->hasSuccessMessages())
        {
            return new ViewModel(array(
                'success' => $this->flashMessenger()->getSuccessMessages()));
        }
        if ($this->flashMessenger()->hasErrorMessages())
        {
            return new ViewModel(array(
                'form' => $form,
                'error' => $this->flashMessenger()->getErrorMessages()));
        }
        
        $this->flashMessenger()->clearMessages();
        return new ViewModel(array('form' => $form));
    }
    
    /**
     * Editar registro
     */
    public function editarAction()
    {
        if(is_string($this->form))
            $form = new$this->form;
        else
            $form = $this->form;
        
        $request = $this->getRequest();
        $param = $this->params()->fromRoute('id',0);
        
        $repository = $this->getEm()->getRepository($this->entity)->find($param);
        
            if ($repository)
            {   
                //VERIFICA SE O ARRAY VEM COM UM DATA
                $array = array();
                foreach ($repository->toArray() as $key => $value):
                    if ($value instanceof \DateTime)
                        $array[$key] = $value->format('d/m/Y');
                    else
                        $array[$key] = $value;
                endforeach;
                
                $form->setData($array);
                //VERIFICA SE O ARRAY VEM COM UM DATA
                
                
                if ($request->isPost())
                {
                        $form->setData($request->getPost());            
                       if ($form->isValid())
                       {
                            $service = $this->getServiceLocator()->get($this->service);
                            
                            $data = $request->getPost()->toArray();
                            $data['id']  =(int) $param;
                            
                            if ($service->salvar($data))
                            {
                                $this->flashMessenger()
                                        ->addSuccessMessage('Atualizado com sucesso');
                            }
                            else
                            {
                                $this->flashMessenger()
                                        ->addErrorMessage('Não foi possivel atualizar! Tente novamente mais tarde.');
                            }
                            return $this->redirect()->toRoute($this->route, array('controller' => $this->controller));
                        }
                        else
                        {
                            $this->flashMessenger()->addInfoMessage('Registro não foi encontrado');
                            return $this->redirect()->toRoute($this->route, array('controller' => $this->controller));
                        }
                }
                if ($this->flashMessenger()->hasSuccessMessages())
                {
                            return new ViewModel(array(
                                'form' => $form,
                                'success' => $this->flashMessenger()->getSuccessMessages(),
                                'id'     => $param  
                            ));        
                }
                if ($this->flashMessenger()->hasErrorMessages())
                {
                            return new ViewModel(array(
                                'form' => $form,
                                'error' => $this->flashMessenger()->getErrorMessages(),
                                'id' => $param   
                            ));
                }    
        }
         if ($this->flashMessenger()->hasInfoMessages())
                {
                            return new ViewModel(array(
                                'form' => $form,
                                'warning' => $this->flashMessenger()->getInfoMessages(),
                                'id' => $param   
                            ));
                }
        $this->flashMessenger()->clearMessages();
        return new ViewModel(array('form' => $form, 'id' => $param));        
    }
    
    
    /**
     * Excluir registro
     */
    public function excluirAction()
    {
        $service = $this->getServiceLocator()->get($this->service);
        $id = $this->params()->fromRoute('id',0);
        if ($service->delete($id))
            $this->flashMessenger ()->addSuccessMessage ('Registro deletado com sucesso!');
        else
            $this->flashMessenger ()->addErrorMessage ('Não foi possivel deletar o registro!');
        
        return $this->redirect()->toRoute($this->route, array('controller' => $this->controller));
    }


/**
 * @return \Doctrine\ORM\EntityManager
 */
    public function getEm()
    {
        if($this->em == null)
        {
         $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }
        return $this->em;
    }

    
 
    
}
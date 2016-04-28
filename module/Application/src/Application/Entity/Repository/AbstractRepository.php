<?php

namespace Application\Entity\Repository;
use Doctrine\ORM\EntityRepository;
use Zend\Stdlib\Hydrator;

/**
 * Description of AbstractRepository
 * @author Welinton
 */

class AbstractRepository extends EntityRepository 
{
    public function delete($id)
    {
        $entity = $this->getEntityManager()->getReference($this->getEntityName(), $id);
            if($entity)
            {
                $this->getEntityManager()->remove($entity);
                $this->getEntityManager()->flush();
                return $entity;
            }else
            {
                return false;
            }
            
    }
    
    public function insert(array $data)
    {
       $entityName = $this->getEntityName();
       $entity = new $entityName($data);
       (new Hydrator\ClassMethods())->hydrate($data, $entity);
       $this->setReferencias($data, $entity);
       $this->getEntityManager()->persist($entity);
       $this->getEntityManager()->flush();
       
       return $entity;
    }
    
    public function salvar(array $data)
    {
        //print_r($data);exit;
        if ($data == '' || $data == null)
        {
            return 'Por favor coloque os dados para gravar';
        }
        else{       
        if(isset($data['id']) && $data['id']>0)
        {
            $this->update($data);
            return '2';
        }else
        {
            $this->insert($data);
           return '1';
            
            
        
        }  
        }
    }
    
    public function update(array $data)
    {
        $entityName = $this->getClassName();
        $entity = $this->getEntityManager()->getReference($entityName, $data['id']);
        (new Hydrator\ClassMethods())->hydrate($data, $entity);
        $this->setReferencias($data, $entity);
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
        return $entity;
    }
    
    public function setReferencias(array $data,$entity)
    {
       $association = $this->getClassMetadata()->getAssociationMappings();
       foreach ($association as $column => $arrayAssociation)
       {
           $association = $column;
           if(array_key_exists('joinColumns', $arrayAssociation)&& isset($data[$association]))
           {
               $entityAssociationName = $arrayAssociation['targetEntity'];
               $referencia = $this->getEntityManager()->getReference($entityAssociationName, $data[$association]);
               $metodoSet = 'set' . ucfirst($association);
               $entity->$metodoSet($referencia);
           }
       }
    }
    
}
    
    

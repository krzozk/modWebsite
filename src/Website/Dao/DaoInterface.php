<?php
namespace Website\Dao;

interface DaoInterface
{		
	public function setEntityManager($entityManager);	
	
	public function getEntityManager();	
}
<?php

namespace Website\Dao;

use Doctrine\ORM\Query\ResultSetMapping;
class ContactDao implements DaoInterface
{
    private $_entityManager;
    /**
     * Assign an EntityManager object.
     * @param EntityManager $entityManager
     * @see \Application\Dao\DaoInterface::setEntityManager()
     */
    public function setEntityManager($entityManager)
    {
        $this->_entityManager = $entityManager;
    }
    /**
     * Returns an EntityManager object.
     * @return EntityManager
     * @see \Application\Dao\DaoInterface::getEntityManager()
     */
    public function getEntityManager()
    {
        return $this->_entityManager;
    }

    /**
     * Saves a contact in the database.
     * @param Contact $contact
     */
    public function save($contact)
    {
        try {
            $this->getEntityManager()->persist($contact);
            $this->getEntityManager()->flush();
            return $contact->getId();
        } catch (Exception $ex) {
            error_log('Error trying to save a Contact.');
        }
        return false;
    }

    /**
     * Regresa un objeto de tipo Contact.
     * @param array $params
     * @return Contact $action
     */
    public function searchByCriteria(array $params, array $orderBy = null, $limit = null, $offset = null)
    {
        $contactlist = array();
        try{

            /*$courses = $this->getEntityManager()->getRepository('Application\Entity\Courses');
             $contactlist = $courses->findBy($params,$orderBy,$limit,$offset);*/

            $connection = $this->getEntityManager()->getConnection();
            $rsm = new ResultSetMapping();

            $query = "true";
            $orderby = "";
            $limite = "";

            if(isset($params["title"]) && isset($params["brief_description"])){
                $query .= " AND (title LIKE '%".$params["title"]."%' OR brief_description LIKE '%".$params["brief_description"]."%')";
                unset($params["title"]);
                unset($params["brief_description"]);
            }

            foreach ($params as $key => $value) {
                switch ($key) {
                    case 'startdate':
                        $query .= " AND ( $key BETWEEN '".date("Y-m-d 00:00:00",$value)."' AND '".date("Y-m-d 23:59:59",$value)."')";
                        break;

                    default:
                        $query .= " AND ".$key."=".$value;
                        break;
                }
            }

            if(is_array($orderBy) && count($orderBy) > 0){
                $orderby = "ORDER BY ".trim(implode(",",$orderBy),",");
            }

            if(is_numeric($limit)){

                $limite = "LIMIT ".(is_numeric($offset) ? "$offset ," : "" )." $limit";
            }

            $statement = $connection->prepare("SELECT * FROM courses WHERE $query  $orderby $limite ;", $rsm);

            $statement->execute();
            while ($row = $statement->fetch()){
                $row['titleslug'] = str_replace(" ", "-", $row['title']);
                $row['tags'] = explode(",", $row['tags']);
                $courselist[] = $row;
            }

        } catch( Exception $oEx ){
            error_log('Error al tratar de obtener un objeto Course.');
        }
        return $contactlist;
    }
    /**
     * Returns the total of courses.
     * @param array $params
     * @return number $total
     */
    public function getTotalCourses(array $params)
    {
        $total = 0;
        try{
            $connection = $this->getEntityManager()->getConnection();
            $rsm = new ResultSetMapping();

            $query = "true";

            if(isset($params["title"]) && isset($params["brief_description"])){
                $query .= " AND (title LIKE '%".$params["title"]."%' OR brief_description LIKE '%".$params["brief_description"]."%')";
                unset($params["title"]);
                unset($params["brief_description"]);
            }

            foreach ($params as $key => $value) {
                switch ($key) {
                    case 'startdate':
                        $query .= " AND ( $key BETWEEN '".date("Y-m-d 00:00:00",$value)."' AND '".date("Y-m-d 23:59:59",$value)."')";
                        break;

                    default:
                        $query .= " AND ".$key."=".$value;
                        break;
                }
            }

            $statement = $connection->prepare("SELECT COUNT(*) AS total FROM courses WHERE $query ;", $rsm);

            $statement->execute();
            if ($row = $statement->fetch()){
                $total = $row['total'];
            }

        } catch( Exception $oEx ){
            error_log('Error trying to get the Course totals.');
        }
        return $total;
    }
    /**
     * Returns a Course Object.
     * @param array $params
     * @return Course $course
     */
    public function getOneBy($params)
    {
        try {
            $courses = $this->getEntityManager()->getRepository('Courses\Entity\Course');
            $course = $courses->findOneBy($params);
        } catch (Exception $ex) {
            error_log('Error trying to get a Course.');
        }
        return $course;
    }
    /**
     * Regresa un objeto de tipo Course.
     * @param string $title
     * @return Course $action
     */
    public function getOneByTitle($title)
    {
        try{
            $connection = $this->getEntityManager()->getConnection();
            $rsm = new ResultSetMapping();

            $statement = $connection->prepare("SELECT * FROM courses WHERE title_slug='$title' ;", $rsm);
            $statement->execute();
            while ($row = $statement->fetch()){
                return $row;
            }
        } catch( Exception $oEx ){
            error_log('Error al tratar de obtener un objeto Course.');
        }
        return null;
    }

    public function removePrerequisite($prereqId)
    {
        try {
            $connection = $this->getEntityManager()->getConnection();
            $rsm = new ResultSetMapping();
            $statement = $connection->prepare("DELETE from course_prerequisites WHERE id=?;", $rsm);
            $statement->bindValue(1, $prereqId);
            $statement->execute();
            return true;
        } catch (Exception $ex) {
            error_log('Error trying to remove a prerequisite.');
        }
        return false;
    }
}
?>

<?php

namespace MVC\Core;

use MVC\Core\Model;
use MVC\Core\ResourceModelInterface;
use MVC\Config\Database;
use PDO;

class ResourceModel implements ResourceModelInterface
{
    private $table;
    private $id;
    private $model;

    public function _init($table, $id, $model)
    {
        $this->table = $table;
        $this->id = $id;
        $this->model = $model;
    }

    public function save($model)
    {
        $arrModel= $model->getProperties();
       
        $placeholder=[];
        $insert_key=[];
        $placeUpdate=[];
        
        if ($model->getId()===null){
            unset($arrModel['id']);
            //insert
            foreach ($arrModel as $key=>$value){
                $insert_key[] =$key;
                array_push($placeholder, ':'.$key);

            }
            
            $strKeyIns= implode(', ',$insert_key);
            $strPlaceholder=implode(', ',$placeholder);
            $sql_insert="INSERT INTO $this->table ({$strKeyIns}) VALUES ({$strPlaceholder})";
            $obj_insert =Database::getBdd()->prepare($sql_insert);

            return $obj_insert->execute($arrModel);
        
            
        }else{
            unset($arrModel['created_at']);
             //update
            foreach ($arrModel as $k=>$item){
                array_push($placeUpdate, $k.' = :'.$k);
            }

            $strPlaceUpdate=implode(', ',$placeUpdate);
            $sql_update="UPDATE {$this->table} SET $strPlaceUpdate WHERE id=:id ";
            $obj_update=Database::getBdd()->prepare($sql_update);

            return $obj_update->execute($arrModel);
        }
    }

    public function delete($id)
    {
        $sql = "DELETE FROM $this->table WHERE id =" .$id ;
        $req = Database::getBdd()->prepare($sql);
        return $req->execute();
    }

    public function find($id)
    {
        $sql = "SELECT * FROM $this->table WHERE id =" . $id;
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetch();
    }

    public function all($model)
    {
        $sql = "SELECT * FROM $this->table";
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_OBJ);
    }
}
?>
<?php
require_once('/srv/http/cryptoquest/libs/globals.php');
/**
 * Database class. Contains functions to access the database.
 * connect()->connects to the DB. Globals stored in lib.
 */
class Database{
  private static $db_handle;
  public static function connect(){
    try{
      self::$db_handle=new PDO("mysql:host=".SERVER.";dbname=".DBNAME,USER, PASSWORD);
      self::$db_handle->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); 
    }
    catch(PDOException $e){
      echo "Conncection failed. ".$e->getMessage();
      echo $e;
    }
  }
  public static function insert($table_name, $data){
        /**
         * $data is an associative array containing information to be inserted into $table_name. 
         * Using unnamed placeholder style.
         * @return array
         */
        $placeholder=array();
        for($i=0; $i<count($data); $i++){
          array_push($placeholder, "?");
        }
        $keys=array_keys($data);
        $values=array_values($data);

        $sql="INSERT INTO $table_name (".implode(",", $keys).") VALUES (".implode(",",$placeholder).")";
      
       
        $statement=self::$db_handle->prepare($sql);
        if($statement===false){
          
          return false;
        }
        $results=$statement->execute($values);
        if($results===false){
         
          return false;
        }
        else
          return $statement->fetchAll(PDO::FETCH_ASSOC);
      }
      public static function query(){
        /**
         * Function which performs the query, and returns back the results
         * @return array results of query passed
         */
        $sql=func_get_arg(0);
        $params=array_slice(func_get_args(), 1);

        $statement=self::$db_handle->prepare($sql);
       
        if($statement===false){
          return false;
        }
        if(count($params)==0){
          $results=$statement->execute();
        }
        else
          $results=$statement->execute($params);
       
        if($results===false)
          return false;
        else{
          return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
      }

      public static function update(){
        $sql=func_get_arg(0);
        $params=array_slice(func_get_args(), 1);
        $statement=self::$db_handle->prepare($sql);
          $results=$statement->execute($params);
        if($results===false)
          return false;
        else{
          return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
      }
    }
    Database::connect();

    ?>

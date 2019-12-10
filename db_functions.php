<?php

class DB_Functions{

    private $con;

    function __construct(){
        require_once dirname(__FILE__).'/db_connect.php';
        $db=new Db_Connect();
        $this->con=$db->connect();

    }
    

    
 function registerNewUser($phone,$name,$birthdate,$address)
   
    {

      
            $stmt=$this->con-> prepare("INSERT INTO `user` (Phone, Name, Birthdate, Address) 
            VALUES ( ?,?,?,?)");   //null because id is autoincremt (int ) field in sql database;
            $stmt->bind_param("ssss",$phone,$name,$birthdate,$address);
            $result=$stmt->execute();
            $stmt->close();
            if($result)
            {
              $stmt= $this->con->prepare("SELECT * FROM user WHERE Phone=?");
              $stmt->bind_param("s",$phone);
            
              $stmt->execute();
              $user=$stmt->get_result()->fetch_assoc();
              $stmt->close();
              return $user;
            }
            else
            return false;
          
          
                
       
    }
    
   public function checkExistsUser($phone)
    
    {
        $stmt= $this->con->prepare("SELECT * FROM user WHERE phone=?");
        $stmt->bind_param("s",$phone);
      
        $stmt->execute();
        $stmt->store_result();
        if($stmt->num_rows>0)
        {$stmt ->close();
             return true;
        }
        else
        {
             $stmt ->close();
             return false;
        }
       
      }
    

  /*public  function userLogin($username ,$pass)
  
    {
      $password=md5($pass);
        $stmt= $this->con->prepare("SELECT id FROM users WHERE username=? AND password =?");
        
        $stmt->bind_param("ss",$username,$password);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows>0;
  
    }*/


 function getUserInformation($phone)
   
   {
        $stmt= $this->con->prepare("SELECT * FROM user WHERE phone=?");
        $stmt->bind_param("s",$phone);
      if($stmt->execute())
      {
        $user=$stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $user;
      }
      else{
        return NULL;
      }
        

      


    }
    public function getBanners(){
      
      //Select 3 Newest Banner;
     // $result=$this->con->query("SELECT *from banner order by ID LIMIT 3");
      $result=$this->con->query("SELECT *from banner");
      $banners=array();
      while($item=$result->fetch_assoc())
      {
           $banners[]=$item;

      }
      return $banners;



         }

         //return menu list
         public function getMenu(){
      
          //Select 3 Newest Banner;
    
          $result=$this->con->query("SELECT *from menu ");
          $menu=array();
          while($item=$result->fetch_assoc())
          {
               $menu[]=$item;
    
          }
          return $menu;
    
    
    
             }

            //Get Drink base Menuid
            //return list of Drinks
             public function getDrinkByMenuID($menuId){
      
              //Select 3 Newest Banner;
              $query="SELECT *FROM Drink WHERE Menuid='".$menuId."'";
        
              $result=$this->con->query($query);
              $drinks=array();
              while($item=$result->fetch_assoc())
              {
                   $drinks[]=$item;
        
              }
              return $drinks;
        
        
        
                 }
    

  }

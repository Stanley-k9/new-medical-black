<?php
class User{
 
   
    private $conn;
    private $table_name = "guest";
 
 
    public $guestname;
    public $guestemail;
    public $guestelephone;
    public $idNum;
    public $adults;
    public $children;
	public $times;
	public $dates;
	public $comments;
	
    
    public function __construct($db){
        $this->conn = $db;
    }
    
    function enter(){

       
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                guestname=:guestname, guestemail=:guestemail, guestelephone=:guestelephone,idNum=:idNum, adults=:adults,
children=:children, comments=:comments,times=:times,dates=:dates";
    
    
                
        
        $stmt = $this->conn->prepare($query);
    
      $this->guestname=htmlspecialchars(strip_tags($this->guestname));
        $this->guestemail=htmlspecialchars(strip_tags($this->guestemail));
        $this->guestelephone=htmlspecialchars(strip_tags($this->guestelephone));
        $this->idNum=htmlspecialchars(strip_tags($this->idNum));
        $this->adults=htmlspecialchars(strip_tags($this->adults));
        $this->children=htmlspecialchars(strip_tags($this->children));
        $this->comments=htmlspecialchars(strip_tags($this->comments));
        $this->times=htmlspecialchars(strip_tags($this->times));
        $this->dates=htmlspecialchars(strip_tags($this->dates));

	   $stmt->bindParam(":guestname", $this->guestname);
        $stmt->bindParam(":guestemail", $this->guestemail);
        $stmt->bindParam(":guestelephone", $this->guestelephone);
        $stmt->bindParam(":idNum", $this->idNum);
        $stmt->bindParam(":adults", $this->adults); 
        $stmt->bindParam(":children", $this->children);
        $stmt->bindParam(":comments", $this->comments);
        $stmt->bindParam(":times", $this->times);
        $stmt->bindParam(":dates", $this->dates);


        if($stmt->execute()){
            $this->id = $this->conn->lastInsertId();
            return true;
        }
    
        return false;

        function isAlreadyExist(){
            $query = "SELECT *
                FROM
                    " . $this->table_name . " 
                WHERE
                guestname='".$this->guestname."'";
           
            $stmt = $this->conn->prepare($query);
            
            $stmt->execute();
            if($stmt->rowCount() > 0){
                return true;
            }
            else{
                return false;
            }
        }
        
    }
    
}
	
	
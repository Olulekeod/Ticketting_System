<?php



 //Create a class Database that holds The connection







class Database{



 



      



   private $connection;



   // Add a new method Connec_db() when we want to connect to the database we should call this method



	  public function connect_db(){



		 



		



$this->connection = mysqli_connect('Localhost', 'root', '', 'master_db');



		  



	//$this->connection = mysqli_connect('localhost', 'root', '', 'jubileechaletsdb');



		



		







		  if(mysqli_connect_error()){



		  die("Database Connection Failed" . mysqli_connect_error() . mysqli_connect_errno());



		  }



		  



		  



		  



	  }



	 







    //a method to sanitize the user submitted data by passing this information and returning the sanitized data.



    public function sanitize($var){



	$return = mysqli_real_escape_string($this->connection, $var);



	return $return;



}

    

public function Member_Update($Submission_ID,$UserID){
    $sql = "UPDATE `members` SET VerificationStatus ='1' WHERE MemberID = '$UserID'";
    $res = mysqli_query($this->connection, $sql);
    if($res){
        return true;
    }else{
        return false;
    }
}

public function User_GetAll($clientid){
	$sql = "SELECT * FROM `members` where MemberID ='$clientid' ";
    $res = mysqli_query($this->connection, $sql);
    $res1 = mysqli_fetch_assoc($res);
	return $res1;
}

public function Members_CountAllRecordsVerified(){
    $sql = "SELECT COUNT(*) As total_records FROM `members` where VerificationStatus = '1' ";
    

    $res = mysqli_query($this->connection, $sql);
        $eventcount = mysqli_fetch_array($res);
    return $eventcount;
       
}
public function Members_CountAllRecordsUnVerified(){
    $sql = "SELECT COUNT(*) As total_records FROM `members` where VerificationStatus = '0' ";
    

    $res = mysqli_query($this->connection, $sql);
        $eventcount = mysqli_fetch_array($res);
    return $eventcount;
       
}
public function Members_CountAllRecords(){
    $sql = "SELECT COUNT(*) As total_records FROM `members` ";
    

    $res = mysqli_query($this->connection, $sql);
        $eventcount = mysqli_fetch_array($res);
    return $eventcount;
       
}

public function Contact_Count(){
	$sql = "SELECT COUNT(*) As total_records FROM `members`";
	

	$res = mysqli_query($this->connection, $sql);
        $eventcount = mysqli_fetch_array($res);
	return $eventcount;
       
}
public function Member_Details_Update($fname,$lname, $Email, $Phone,$Age,$Department,$clientid,$filename){
    $sql = "UPDATE `members` SET Name_First_Name ='$fname', Name_Last_Name='$lname',
    E_mail='$Email', Telephone='$Phone', Age_of_Child_Children='$Age',Department='$Department',Photo_ID = '$filename' WHERE MemberID = '$clientid'";
    $res = mysqli_query($this->connection, $sql);
    if($res){
        return true;
    }else{
        return false;
    }
}



public function Contact_GetALL_Unverified($offset,$total_records_per_page){
    $sql = "SELECT * FROM `members` where VerificationStatus = '0' LIMIT $offset, $total_records_per_page ";
    
    $res = mysqli_query($this->connection, $sql);
    return $res;
}
public function Contact_GetALL($offset,$total_records_per_page){
    $sql = "SELECT * FROM `members` LIMIT $offset, $total_records_per_page ";
    
    $res = mysqli_query($this->connection, $sql);
    return $res;
}
public function AdminDetails_Get($EmailAddress){
	$sql = "SELECT * FROM `fnd_admin` where Email ='$EmailAddress' ";
    $res = mysqli_query($this->connection, $sql);
    $res1 = mysqli_fetch_assoc($res);
	return $res1;
}

public function Admin_CheckCredentials($email,$password){
	$sql = "SELECT * FROM `fnd_admin` WHERE  Email = '$email' && Password = '$password'";
        // mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $res = mysqli_query($this->connection, $sql);
         
	   $data = mysqli_fetch_array($res);
	   $result = mysqli_num_rows ($res);
   
    
         if ($result ==1){
            
             
             return true;
         }else
         {
             
             return false;
             
         }
	      // return $res;

}

public function Contact_GetALL1($offset,$total_records_per_page){
    $sql = "SELECT `cam09photos`.PhotoFile,
                    `cam9`.Name_First_Name,
                    `cam9`.Name_Last_Name,
                    `cam9`.E_mail,
                    `cam9`.Telephone,
                    `cam9`.Age_of_Child_Children,
                    `cam9`.Photo_ID
    
     FROM `cam9` JOIN `cam09photos` ON `cam09photos`.PhotoFile LIKE '%'+  `cam9`.Photo_ID +'%' 
    LIMIT $offset, $total_records_per_page ";
    
    $res = mysqli_query($this->connection, $sql);
    return $res;
}

public function Contact_GetALL2($offset,$total_records_per_page){
    $sql = "SELECT * FROM `cam9`

    INNER JOIN cam09photos ON cam09photos.PhotoFile LIKE CONCAT('%', cam9.Photo_ID, '%');
    
     LIMIT $offset, $total_records_per_page ";
    
    $res = mysqli_query($this->connection, $sql);
    return $res;
}

//SELECT * FROM A INNER JOIN B ON B.MYCOL LIKE CONCAT('%', A.MYCOL, '%');
// SELECT *
//   FROM TABLE a
//   JOIN TABLE b ON b.column LIKE '%'+ a.column +'%'




public function Contact_GetALL5($offset,$total_records_per_page){
    $sql = "SELECT 
    
    `cam09photos`.PhotoFile,
                    `cam9`.Name_First_Name,
                    `cam9`.Name_Last_Name,
                    `cam9`.E_mail,
                    `cam9`.Telephone,
                    `cam9`.Age_of_Child_Children,
                    `cam9`.Photo_ID
	
	 FROM `cam9` 
	
	 INNER JOIN `cam09photos`
    ON `customerreservations`.ContactID = `fnd_contact`.ContactID

	INNER JOIN `fnd_reservations`
    ON `customerreservations`.reservationid = `fnd_reservations`.ReservationID 
	
	
	ORDER BY DateCreated ASC  LIMIT $offset, $total_records_per_page ";
    
    $res = mysqli_query($this->connection, $sql);
    return $res;
}




}



 



$database = new Database();



 $database->connect_db();



?>
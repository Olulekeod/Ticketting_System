<?php
session_start();


//check if User is Logged in
if (empty ($_SESSION['FND_Admin_Email'])){

    echo '<script> window.location="index.php"</script>';

}else{
    include 'masterDB.php';


//Get Contact Details
$AdminDetails = $database->AdminDetails_Get($_SESSION['FND_Admin_Email']);
    

$AdminID = $AdminDetails['AdminID'];
$AdminEmail = $AdminDetails['Email'];




$clientid = $_GET["i"];



$Clients_Details = $database->User_GetAll($clientid);

$UserID = $Clients_Details['MemberID'];
$Name_First_Name = $Clients_Details['Name_First_Name'];
$Name_Last_Name = $Clients_Details['Name_Last_Name'];
$E_mail = $Clients_Details['E_mail'];
$Telephone = $Clients_Details['Telephone'];
$Age_of_Child_Children = $Clients_Details['Age_of_Child_Children'];
$Department = $Clients_Details['Department'];
$Submission_ID = $Clients_Details['Submission_ID'];
$Photo_ID = $Clients_Details['Photo_ID'];
$FolderName = $Clients_Details['FolderName'];
$VerificationStatus = $Clients_Details['VerificationStatus'];




if ($FolderName == 'cam3'){
    $prematch = 'DSC_';

   }
   elseif($FolderName == 'cam4'){

       $prematch = 'DSC_';
   }
   elseif($FolderName == 'cam5'){

       $prematch = 'DSC_';
   }elseif($FolderName == 'cam6'){
       $prematch = 'DSC_';
   }
   elseif($FolderName == 'cam7'){
       $prematch = 'DSC_';
   }
   elseif($FolderName == 'cam8'){
       $prematch = 'DSC_';
   }
   elseif($FolderName == 'cam9'){
       $prematch = 'IMG_';
   }
   elseif($FolderName == 'cam10'){
       $prematch = 'IMG_';
   }
   elseif($FolderName == 'cam11'){
       $prematch = 'DSC_';
   } 
   elseif($FolderName == 'cam1'){

    $prematch = 'DSC_';
}
elseif($FolderName == 'cam2'){

    $prematch = 'DSC_';
}
elseif($FolderName == 'cam3'){

    $prematch = 'DSC_';
}
   else{


   }
// //get customer 
// $Bookings_GetALL = $database->Bookings_GetALL();


//  //Get Contact Details
//  $Admin_Contacts_Count = $database->Admin_Contacts_Count();
//  $contactscount = $Admin_Contacts_Count['total_records'];
 
// //Get orders Details
// $Admin_Orders_Count = $database->Admin_Orders_Count();
// $orderscount = $Admin_Orders_Count['total_records'];


//   //Get Contact Details
//   $Admin_Items_sold = $database->Admin_Items_sold();
//   $itemssold = $Admin_Items_sold['GrossTotal'];
  
//   //get orders 
// $Orders_GetALL = $database->Orders_GetALL();


// if (isset($_GET['page_no']) && $_GET['page_no']!="") {
//     $page_no = $_GET['page_no'];
//     } else {
//         $page_no = 1;
//         }
//     $total_records_per_page = 20;
    
    
//     $offset = ($page_no-1) * $total_records_per_page;
//     $previous_page = $page_no - 1;
//     $next_page = $page_no + 1;
//     $adjacents = "2";
    
    
//     $result_count = $database-> Reservations_Count();
    
    
//     $total_records = $result_count;
//     $total_records = $total_records['total_records'];
//     $total_no_of_pages = ceil($total_records / $total_records_per_page);
//     $second_last = $total_no_of_pages - 1; // total pages minus 1
    
    
//     $Reservations_GetALL = $database->Reservations_GetALL($offset,$total_records_per_page);
    
        
        
}





if(isset($_POST['btUpdateMember'])){
	
	
	
	//sanitize User Inputs
	$fname = $database->sanitize($_POST['fname']);
	$lname = $database->sanitize($_POST['lname']);
	$Email = $database->sanitize($_POST['Email']);
	$Phone = $database->sanitize($_POST['Phone']);
	$Age = $database->sanitize($_POST['Age']);
	$Department = $database->sanitize($_POST['Department']);



    $FolderName = "cam9";
    $target_dir = "../$FolderName/";

    //file upload
    $target_file = $target_dir . basename($_FILES["GalleryImage"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    // $errormessage = ""
    // echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $errormessage = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    // $uploadOk = 0;
    }else{
    
    $target_dir = "$FolderName/";
    
    $file = $_FILES['GalleryImage']['name'];
    $path = pathinfo($file);
    $filename = $path['filename'];
    $ext = $path['extension'];
    $temp_name = $_FILES['GalleryImage']['tmp_name'];
    $pathname = $filename.".".$ext;
    $path_filename_ext = $target_dir.$filename.".".$ext;
    
    
    
    move_uploaded_file($temp_name,$path_filename_ext);
    
    }





   



//$candidateStatus = "0";
	if ( empty ($fname && $lname)){
	
	$errormessage ="Kindly Check All Fields";
	
	}else{
			$Contact_Update = $database->Member_Details_Update($fname,$lname, $Email, $Phone,$Age,$Department,$clientid,$filename);
	
		
		if($Contact_Update){
			
            // $str2 = substr($Photo_ID, 4);
            // rename($FolderName . '/' . $str2 . '.JPG', 'deletedImage/'.$Photo_ID);
            // $target_dir1 = "cam9/Thankyou";
            // unlink($target_dir1);
			
			
			$successmessage ="Member's Details Updated Sucessfully";
			 
// 			 $clientid = $Candidate_Contact_Create;
            header("Refresh:0");
			
// 			 $Clients_Details = $database->Candidates_DetailsGetByID($clientid);
    
//             $Client_ID = $Clients_Details['AUSTID'];
            
            
            // header("Location:index.php?id=$Client_ID");

           // header("Refresh:0");


// 			Candidates_DetailsGetByID
	
		
		}else{
			
			
			$errormessage ="Kindly Check All Fields";
	
		}
	
	
	}
	
}






?>

<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Membership Management</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href=" assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href=" assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href=" assets/libs/css/style.css">
    <link rel="stylesheet" href=" assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <link rel="stylesheet" type="text/css" href=" assets/vendor/datatables/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href=" assets/vendor/datatables/css/buttons.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href=" assets/vendor/datatables/css/select.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href=" assets/vendor/datatables/css/fixedHeader.bootstrap4.css">
</head>

<body>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
         <!-- ============================================================== -->
        <!-- navbar -->
        <!-- ============================================================== -->
         <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg bg-white fixed-top">
            <?php include 'TopNav.php' ?>
            </nav>
        </div>
        <!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- left sidebar -->
        <!-- ============================================================== -->
       <div class="nav-left-sidebar sidebar-dark">
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light">
                <?php 
                
                $page = 'Membership';

                include 'sidenav.php' ?>
                </nav>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end left sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="dashboard-wrapper">
            <div class="container-fluid  dashboard-content">
                <!-- ============================================================== -->
                <!-- pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title">Member Management</h2>
                            <p class="pageheader-text"></p>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="Dashboard" class="breadcrumb-link">Dashboard</a></li>
                                          <li class="breadcrumb-item"><a href="MembersMgt" class="breadcrumb-link">Member Mgt</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Member Preview</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <!--<div style=" float: right;">-->
                    <!--  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add Reservations</button>-->
                    <!--     </div>-->
                    </div>



                  
                </div>
                <!-- ============================================================== -->
                <!-- end pageheader -->
                <!-- ============================================================== -->
            <form method="post" enctype="multipart/form-data">
           <div class="row">
               <div class="col-lg-12 col-12">
                   <p style="color:green;">
                    <?php 
                    
                    if (isset($successmessage)){
                        
                        echo $successmessage;

}
                    
                      ?> </p>
                   
                   </div>

                   

                      <div class="col-lg-6 col-6">
                  <img src="../<?php echo $FolderName ; ?>/<?php echo $prematch ; ?><?php echo str_pad($Photo_ID , 4, '0', STR_PAD_LEFT); ?>.JPG" height="200" width="200" class=""></img>
                   
                   </div>
                   <div class="col-lg-6 col-6">
          <div class="form-group">
            <label for="Reservation" class="col-form-label">Passport Re-Upload:</label>
            <input type="file" name="GalleryImage" class="form-control" id="website">
          </div>
          </div>
               
            <div class="col-lg-6 col-12">
          <div class="form-group">
            <label for="Reservation" class="col-form-label">First Name:</label>
            <input type="text" name="fname" value="<?php echo $Name_First_Name  ?>" class="form-control" id="website">
          </div>
          </div>
          <div class="col-lg-6 col-12">
          <div class="form-group">
            <label for="Title" class="col-form-label">Last Name:</label>
            <input type="text" name="lname" value="<?php echo $Name_Last_Name  ?>" class="form-control" id="Title">
          </div>
          </div>
             
          <div class="col-lg-6 col-12">
          <div class="form-group">
            <label for="Email" class="col-form-label">Email:</label>
            <input type="Email" name="Email" value="<?php echo $E_mail  ?>" class="form-control" id="website">
          </div>
          </div>
          <div class="col-lg-6 col-12">
          <div class="form-group">
            <label for="text" class="col-form-label">Phone Number:</label>
            <input type="text" name="Phone" value="<?php echo $Telephone   ?>" class="form-control" id="Phone">
          </div>
          </div>
          <div class="col-lg-6 col-12">
          <div class="form-group">
            <label for="text" class="col-form-label">Age of Children:</label>
            <input type="text" name="Age" value="<?php echo $Age_of_Child_Children  ?>" class="form-control" id="website">
          </div>
          </div>
          <div class="col-lg-6 col-12">
          <div class="form-group">
            <label for="Email" class="col-form-label">Department:</label>
            <input type="text" name="Department" value="<?php echo $Department  ?>" class="form-control" id="website">
          </div>
          </div>
          <div class="col-lg-6 col-12">
          <div class="form-group">
            <label for="SubmissionID" class="col-form-label">SubmissionID:</label>
            <input type="text" name="SubmissionID" readonly value="<?php echo $Submission_ID  ?>" class="form-control" id="website">
          </div>
          </div>
               
           
             <div class="col-lg-6 col-12 pt-4">
           <div class="form-group">
             <button type="submit" name="btUpdateMember" class="btn btn-primary">Update</button>
          </div>
           </div>
           
           
           
        
           
         
      </div>
            </form>
        
           
            </div>
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <div class="footer">
                <?php include 'Footer.php'; ?>
            </div>
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Reservation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post">
             <div class="Container-fluid">
            <div class="row">
            <div class="col-lg-6 col-12">
          <div class="form-group">
            <label for="Reservation" class="col-form-label">Reservation Name:</label>
            <input type="text" name="Reservation" class="form-control" id="website">
          </div>
          </div>
          <div class="col-lg-6 col-12">
          <div class="form-group">
            <label for="Title" class="col-form-label">Reservation Title:</label>
            <input type="text" name="Title" class="form-control" id="Title">
          </div>
          </div>
                <div class="col-lg-12 col-12">
          <div class="form-group">
            <label for="Description" class="col-form-label">Reservation Description:</label>
           
            <textarea name="txtDescription" class="form-control" id="" cols="30" rows="5"></textarea>
          </div>
          </div>
          <div class="col-lg-6 col-12">
           <div class="form-group">
            <label for="contact-name" class="col-form-label">Price/person:</label>
            <input type="text" name="Price" class="form-control" id="Price">
          </div>
           </div>
           <div class="col-lg-6 col-12">
           <div class="form-group">
            <label for="contact-name" class="col-form-label">Days Alloted:</label>
            <input type="number" name="Days" class="form-control" id="contactemail">
          </div>
           </div>
           <div class="col-lg-6 col-12">
           <div class="form-group">
            <label for="contact-name" class="col-form-label">Ratings:</label>
            <input type="number" name="Ratings" class="form-control" id="contactemail">
          </div>
           </div>
        
           
         
      </div>
          
          
          
          
    </div>
            </div> 
            
         
         
         
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="btnAddReservations" class="btn btn-primary">Add</button>
      </div>
          </form>
    </div>
  </div>
</div>


            </div>
           
            
            <!-- ============================================================== -->
            <!-- end footer -->
            <!-- ============================================================== -->
        </div>
    </div>
    
    <!-- ============================================================== -->
    <!-- end main wrapper -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <script src=" assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src=" assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src=" assets/vendor/slimscroll/jquery.slimscroll.js"></script>
    <script src=" assets/vendor/multi-select/js/jquery.multi-select.js"></script>
    <script src=" assets/libs/js/main-js.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src=" assets/vendor/datatables/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src=" assets/vendor/datatables/js/buttons.bootstrap4.min.js"></script>
    <script src=" assets/vendor/datatables/js/data-table.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/rowgroup/1.0.4/js/dataTables.rowGroup.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.2.7/js/dataTables.select.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>
    
</body>
 
</html>
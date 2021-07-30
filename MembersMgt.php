<?php
session_start();


//check if User is Logged in
if (empty ($_SESSION['FND_Admin_Email'])){

    echo '<script> window.location="index"</script>';

}else{
    include 'masterDB.php';


//Get Contact Details
$AdminDetails = $database->AdminDetails_Get($_SESSION['FND_Admin_Email']);
    

$AdminID = $AdminDetails['AdminID'];
$AdminEmail = $AdminDetails['Email'];


// $Client_GetALLcOUNT = $database->Client_GetALLcOUNT();
// $totalclient = $Client_GetALLcOUNT['total_records'];


// $Bookings_GetALLcOUNT = $database->Bookings_GetALLcOUNT();
// $totalBooking = $Bookings_GetALLcOUNT['total_records'];



// // //get customer 
//  $Customer_GetAll = $database->Customer_GetAll();
//  $Orders_GetAll = $database->Orders_GetALL();



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


if (isset($_GET['page_no']) && $_GET['page_no']!="") {
    $page_no = $_GET['page_no'];
    } else {
        $page_no = 1;
        }
    $total_records_per_page = 20;
    
    
    $offset = ($page_no-1) * $total_records_per_page;
    $previous_page = $page_no - 1;
    $next_page = $page_no + 1;
    $adjacents = "2";
    
    
    $result_count = $database-> Contact_Count();
    
    
    $total_records = $result_count;
    $total_records = $total_records['total_records'];
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
    $second_last = $total_no_of_pages - 1; // total pages minus 1
    
    
    $Contact_GetALL = $database->Contact_GetALL($offset,$total_records_per_page);
    

}






if(isset($_POST['btnlogin'])){
//sanitize User Inputs
$loginemail = $database->sanitize($_POST['txtemail']);
$loginpassword = $database->sanitize($_POST['txtpassword']);

	//check if email exist
	$AdminLogin = $database->Admin_CheckCredentials($loginemail,$loginpassword);

	if ($AdminLogin > 0){

		$_SESSION['FND_Admin_Email'] = $loginemail;
		echo '<script> window.location="Admin_Dashboard.php"</script>';



	}else{

		$loginerrormessage = "Invalid Email or Password";


	}
    




}






?>
<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Members Management</title>
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
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title">Members Management</h2>
                            <p class="pageheader-text"></p>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="Dashboard" class="breadcrumb-link">Dashboard</a></li>
                                        
                                        <li class="breadcrumb-item active" aria-current="page">Member Mgt</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end pageheader -->
                <!-- ============================================================== -->
            
                <div class="row">
                    <!-- ============================================================== -->
                    <!-- data table  -->
                    <!-- ============================================================== -->
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <!-- <div class="card-header">
                                <h5 class="mb-0">Data Tables - Print, Excel, CSV, PDF Buttons</h5>
                                <p>This example shows DataTables and the Buttons extension being used with the Bootstrap 4 framework providing the styling.</p>
                            </div> -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered second" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>FirstName</th>
                                                <th>LastName</th>
                                                <th>Email</th>
                                                <th>PhoneNumber</th>
                                                <th>Submission ID</th>
                                                <th>Verification Status</th>
                                                <th>Action</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                        
                                        <tr>

                                        <?php 
				  
				 
    
                  $curentnumber = ($page_no - 1) * $total_records_per_page + 1;
                               
                               
                      $counter = 1;				  
             while($r = mysqli_fetch_assoc($Contact_GetALL)){
             ?>
                                                <?php echo "<td>".$curentnumber."</td>"; ?> 
                                               <td><?php echo $r['Name_First_Name']; ?></td>
                                               <td><?php echo $r['Name_Last_Name']; ?></td>
                                               <td><?php echo $r['E_mail']; ?></td>
                                               <td><?php echo $r['Telephone']; ?></td>
                                               <td><?php echo $r['Submission_ID']; ?></td>
                                               <td><?php 
                                               
                                               if ($r['VerificationStatus'] == 1){
                                                    echo "Verified";

                                               }else{

                                                echo "Pending";
                                               }
                                               
                                              ?></td>
                                                <td><a href="Member_Preview?i=<?php echo $r['MemberID']; ?>">View</a></td>
                                            </tr>
                                            <?php $curentnumber++; } ?>

                                            

                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end data table  -->
                    <!-- ============================================================== -->
                </div>
            
        
           
            </div>
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <div class="footer">
                <?php include 'Footer.php'; ?>
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
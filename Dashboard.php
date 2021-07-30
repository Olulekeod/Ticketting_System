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


$Client_GetALLcOUNT = $database->Members_CountAllRecordsVerified();
$totalclient = $Client_GetALLcOUNT['total_records'];


$Members_CountAllRecordsUnVerified = $database->Members_CountAllRecordsUnVerified();
$unverified = $Members_CountAllRecordsUnVerified['total_records'];


$Members_CountAllRecords = $database->Members_CountAllRecords();
$Members_Records = $Members_CountAllRecords['total_records'];



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
    
    
    $result_count = $database-> Members_CountAllRecordsUnVerified();
    
    
    $total_records = $result_count;
    $total_records = $total_records['total_records'];
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
    $second_last = $total_no_of_pages - 1; // total pages minus 1
    
    
    $Contact_GetALL = $database->Contact_GetALL_Unverified($offset,$total_records_per_page);
    

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
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/libs/css/style.css">
    <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <link rel="stylesheet" href="assets/vendor/charts/chartist-bundle/chartist.css">
    <link rel="stylesheet" href="assets/vendor/charts/morris-bundle/morris.css">
    <link rel="stylesheet" href="assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendor/charts/c3charts/c3.css">
    <link rel="stylesheet" href="assets/vendor/fonts/flag-icon-css/flag-icon.min.css">
    <title>CGCC Administrator Dashboard</title>
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
                
                $page = 'Dashboard';
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
            <div class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content ">
                    <!-- ============================================================== -->
                    <!-- pageheader  -->
                    <!-- ============================================================== -->
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="page-header">
                                <h2 class="pageheader-title">Dashboard - Welcome <?php echo $AdminEmail ?></h2>
                                <p class="pageheader-text">Nulla euismod urna eros, sit amet scelerisque torton lectus vel mauris facilisis faucibus at enim quis massa lobortis rutrum.</p>
                                <div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                           
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end pageheader  -->
                    <!-- ============================================================== -->
                    <div class="ecommerce-widget">

                    <div class="row">
                            <!-- ============================================================== -->
                            <!-- sales  -->
                            <!-- ============================================================== -->
                            <div class="col-xl-4 col-lg-34 col-md-6 col-sm-12 col-12">
                                <div class="card border-3 border-top border-top-primary">
                                    <div class="card-body">
                                        <h5 class="text-muted">Verified Members</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1"><?php echo $totalclient  ?></h1>
                                        </div>
                                        <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                                            <span class="icon-circle-small icon-box-xs text-success bg-success-light"><i class="fa fa-fw fa-arrow-up"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end sales  -->
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- new customer  -->
                            <!-- ============================================================== -->
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                                <div class="card border-3 border-top border-top-primary">
                                    <div class="card-body">
                                        <h5 class="text-muted">Unverified Members</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1"><?php echo $unverified  ?></h1>
                                        </div>
                                        <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                                            <span class="icon-circle-small icon-box-xs text-success bg-success-light"><i class="fa fa-fw fa-arrow-up"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end new customer  -->
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- visitor  -->
                            <!-- ============================================================== -->
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                                <div class="card border-3 border-top border-top-primary">
                                    <div class="card-body">
                                        <h5 class="text-muted">Total Members</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1"><?php echo $Members_Records  ?></h1>
                                        </div>
                                        <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                                            <span class="icon-circle-small icon-box-xs text-success bg-success-light"><i class="fa fa-fw fa-arrow-up"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end visitor  -->
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- total orders  -->
                            <!-- ============================================================== -->
                            <!-- <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="card border-3 border-top border-top-primary">
                                    <div class="card-body">
                                        <h5 class="text-muted">Total Orders</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1">1340</h1>
                                        </div>
                                        <div class="metric-label d-inline-block float-right text-danger font-weight-bold">
                                            <span class="icon-circle-small icon-box-xs text-danger bg-danger-light bg-danger-light "><i class="fa fa-fw fa-arrow-down"></i></span><span class="ml-1">4%</span>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <!-- ============================================================== -->
                            <!-- end total orders  -->
                            <!-- ============================================================== -->
                        </div>
                        
                        <div class="row">
                            <!-- ============================================================== -->
                      
                            <!-- ============================================================== -->

                                          <!-- recent orders  -->
                            <!-- ============================================================== -->
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="card">
                                    <h5 class="card-header">Recent Complaint</h5>
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead class="bg-light">
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
                                                <?php 
				  
				 
    
                  $curentnumber = ($page_no - 1) * $total_records_per_page + 1;
                               
                               
                      $counter = 1;				  
             while($r = mysqli_fetch_assoc($Contact_GetALL)){
             ?>
                                                    <tr>
                                                       
                                                       
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
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- ============================================================== -->
                            <!-- end recent orders  -->

    
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- customer acquistion  -->
                            <!-- ============================================================== -->
                         
                            <!-- ============================================================== -->
                            <!-- end customer acquistion  -->
                            <!-- ============================================================== -->
                        </div>
                   

             
                    </div>
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
        <!-- ============================================================== -->
        <!-- end wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <!-- jquery 3.3.1 -->
    <script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <!-- bootstap bundle js -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <!-- slimscroll js -->
    <script src="assets/vendor/slimscroll/jquery.slimscroll.js"></script>
    <!-- main js -->
    <script src="assets/libs/js/main-js.js"></script>
    <!-- chart chartist js -->
    <script src="assets/vendor/charts/chartist-bundle/chartist.min.js"></script>
    <!-- sparkline js -->
    <script src="assets/vendor/charts/sparkline/jquery.sparkline.js"></script>
    <!-- morris js -->
    <script src="assets/vendor/charts/morris-bundle/raphael.min.js"></script>
    <script src="assets/vendor/charts/morris-bundle/morris.js"></script>
    <!-- chart c3 js -->
    <script src="assets/vendor/charts/c3charts/c3.min.js"></script>
    <script src="assets/vendor/charts/c3charts/d3-5.4.0.min.js"></script>
    <script src="assets/vendor/charts/c3charts/C3chartjs.js"></script>
    <script src="assets/libs/js/dashboard-ecommerce.js"></script>
</body>
 
</html>
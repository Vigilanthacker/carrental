<?php
// Include necessary files and initialize session
session_start();
include('includes/config.php');

// Check if user is logged in
if(empty($_SESSION['alogin'])){
    header('location:index.php');
}

// Check if user ID is provided
if(empty($_GET['id'])){
    header('location:manageuser.php');
}

// Fetch user details from database
$user_id = intval($_GET['id']);
$sql = "SELECT * FROM tblusers WHERE id = :id";
$query = $dbh->prepare($sql);
$query->bindParam(':id', $user_id, PDO::PARAM_INT);
$query->execute();
$user = $query->fetch(PDO::FETCH_ASSOC);

// Check if user exists
if(!$user){
    header('location:manageuser.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
    <link rel="icon" href="assets/images/favicon-icons/favicon.png" type="image/png">
    <title>Print User Data</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    	<!-- Font awesome -->
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<!-- Sandstone Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Bootstrap Datatables -->
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<!-- Bootstrap social button library -->
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<!-- Bootstrap select -->
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<!-- Bootstrap file input -->
	<link rel="stylesheet" href="css/fileinput.min.css">
	<!-- Awesome Bootstrap checkbox -->
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<!-- Admin Stye -->
	<link rel="stylesheet" href="css/style.css">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/images/favicon-icon/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/images/favicon-icon/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="assets/images/favicon-icon/apple-touch-icon-57-precomposed.png">
<link rel="shortcut icon" href="assets/images/favicon-icon/favicon.png">
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">

  <style>
		.errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
		</style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="page-title">User Details</h2>
                <div class="table-responsive">
                    <!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">User Details</div>
							<div class="panel-body">
							
                <table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                        <tbody>
                            <tr>
                                <th>Name</th>
                                <td><?php echo htmlentities($user['FullName']); ?></td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td><?php echo htmlentities($user['EmailId']); ?></td>
                            </tr>
                            <tr>
                                <th>Contact No</th>
                                <td><?php echo htmlentities($user['ContactNo']); ?></td>
                            </tr>
                            <tr>
                                <th>City</th>
                                <td><?php echo htmlentities($user['City']); ?></td>
                            </tr>
                            <tr>
                                <th>Country</th>
                                <td><?php echo htmlentities($user['Country']); ?></td>
                            </tr>
                            <tr>
                                <th>dob</th>
                                <td><?php echo htmlentities($user['dob']); ?></td>
                            </tr>
                            <tr>
                                <th>Registration Date</th>
                                <td><?php echo htmlentities($user['RegDate']); ?></td>
                            </tr>
                            <!-- Add more user details as needed -->
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    <!-- Print button to trigger printing -->
    <div class="text-center mt-3">
        <button class="btn btn-primary" onclick="window.print()">Print</button>
    </div>
    <script src="js/bootstrap.min.js"></script>
    <!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
	
</body>
</html>

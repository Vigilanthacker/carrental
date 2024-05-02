<?php
session_start();
error_reporting(0);
include('includes/config.php');

if(strlen($_SESSION['alogin']) == 0) {	
    header('location:index.php');
} else {
    // If the form is submitted
    if(isset($_POST['submit'])) {
        // Get user IP address
        $user_ip = $_SERVER['REMOTE_ADDR'];
        // Get user city and country using an IP lookup service (you need to implement this)
        $user_city = ''; // Implement IP lookup to get the city
        $user_country = ''; // Implement IP lookup to get the country
        // Get user email from the session
        $user_email = $_SESSION['alogin'];
        // Get current date and time
        $login_time = date('Y-m-d H:i:s');

        // Insert log entry into the database
        $sql = "INSERT INTO tblsyslogs(u_email, u_ip, u_city, u_country, u_logintime) VALUES (:u_email, :u_ip, :u_city, :u_country, :u_logintime)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':u_email', $user_email, PDO::PARAM_STR);
        $query->bindParam(':u_ip', $user_ip, PDO::PARAM_STR);
        $query->bindParam(':u_city', $user_city, PDO::PARAM_STR);
        $query->bindParam(':u_country', $user_country, PDO::PARAM_STR);
        $query->bindParam(':u_logintime', $login_time, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();

        if($lastInsertId) {
            $msg = "Log entry added successfully";
        } else {
            $error = "Error adding log entry";
        }
    }
 ?>

<!doctype html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="theme-color" content="#3e454c">
    
    <title>Car Rental Portal | Admin Manage testimonials</title>

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
    <?php include('includes/header.php');?>

    <div class="ts-main-content">
        <?php include('includes/leftbar.php');?>
        <div class="content-wrapper">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-12">

                        <h2 class="page-title">System Logs</h2>

                        <!-- Form to submit logs -->
                        <form method="post">
                            <button type="submit" name="submit">Add Log Entry</button>
                        </form>

                        <!-- Zero Configuration Table -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-key"></i>  
                                System Logs
                            </div>
                            <div class="panel-body">
                                <?php if(isset($error)){?>
                                    <div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div>
                                <?php } elseif(isset($msg)){?>
                                    <div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div>
                                <?php }?>
                                <table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>User Email</th>
                                            <th>User IP</th>
                                            <th>User City</th>
                                            <th>Country</th>
                                            <th>User Login Time</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>User Email</th>
                                            <th>User IP</th>
                                            <th>User City</th>
                                            <th>Country</th>
                                            <th>User Login Time</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php 
                                        $sql = "SELECT u_email, u_ip, u_city, u_country, u_logintime FROM tblsyslogs";
                                        $query = $dbh->prepare($sql);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        $cnt = 1;
                                        if($query->rowCount() > 0) {
                                            foreach($results as $result) { ?>  
                                                <tr>
                                                    <td><?php echo htmlentities($cnt);?></td>
                                                    <td><?php echo htmlentities($result->u_email);?></td>
                                                    <td><?php echo htmlentities($result->u_ip);?></td>
                                                    <td><?php echo htmlentities($result->u_city);?></td>
                                                    <td><?php echo htmlentities($result->u_country);?></td>
                                                    <td><?php echo htmlentities($result->u_logintime) ;?></td>
                                                </tr>
                                                <?php $cnt = $cnt + 1; 
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="card-footer small text-muted">
                            <?php
                            date_default_timezone_set("Africa/Nairobi");
                            echo "The time is " . date("h:i:sa");
                            ?> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
<?php } ?>

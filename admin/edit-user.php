<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0) {   
    header('location:index.php');
} else { 

    if(isset($_POST['submit'])) {
        $fullname=$_POST['fullname'];
        $email=$_POST['email'];
        $contactno=$_POST['contactno'];
        $ip=$_POST['ip'];
        $city=$_POST['city'];
        $country=$_POST['country'];
        $id=intval($_GET['id']);

        $sql = "UPDATE tblusers SET FullName=:fullname, EmailId=:email, ContactNo=:contactno, IP=:ip, City=:city, Country=:country WHERE id=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':fullname',$fullname,PDO::PARAM_STR);
        $query->bindParam(':email',$email,PDO::PARAM_STR);
        $query->bindParam(':contactno',$contactno,PDO::PARAM_STR);
        $query->bindParam(':ip',$ip,PDO::PARAM_STR);
        $query->bindParam(':city',$city,PDO::PARAM_STR);
        $query->bindParam(':country',$country,PDO::PARAM_STR);
        $query->bindParam(':id',$id,PDO::PARAM_STR);
        $query->execute();

        $msg="Data updated successfully";
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
    <title>Edit User | Admin Panel</title>
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-social.css">
    <link rel="stylesheet" href="css/bootstrap-select.css">
    <link rel="stylesheet" href="css/fileinput.min.css">
    <link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include('includes/header.php');?>
    <div class="ts-main-content">
        <?php include('includes/leftbar.php');?>
        <div class="content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="page-title">Edit User</h2>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">User Information</div>
                                    <div class="panel-body">
                                        <?php if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
                                        <?php 
                                        $id=intval($_GET['id']);
                                        $sql ="SELECT * FROM tblusers WHERE id=:id";
                                        $query = $dbh->prepare($sql);
                                        $query->bindParam(':id', $id, PDO::PARAM_STR);
                                        $query->execute();
                                        $results=$query->fetchAll(PDO::FETCH_OBJ);
                                        $cnt=1;
                                        if($query->rowCount() > 0) {
                                            foreach($results as $result) {
                                        ?>
                                        <form method="post" class="form-horizontal" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Full Name</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="fullname" class="form-control" value="<?php echo htmlentities($result->FullName)?>" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Email</label>
                                                <div class="col-sm-10">
                                                    <input type="email" name="email" class="form-control" value="<?php echo htmlentities($result->EmailId)?>" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Contact No</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="contactno" class="form-control" value="<?php echo htmlentities($result->ContactNo)?>" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">IP Address</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="ip" class="form-control" value="<?php echo htmlentities($result->IP)?>" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">City</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="city" class="form-control" value="<?php echo htmlentities($result->City)?>" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Country</label>
                                                <div class="col-sm-10">
                                                      <input type="text" name="country" class="form-control" value="<?php echo htmlentities($result->Country)?>" readonly>
                                                  </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-sm-8 col-sm-offset-2">
                                                    <button class="btn btn-primary" name="submit" type="submit">Save Changes</button>
                                                </div>
                                            </div>
                                        </form>
                                        <?php 
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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

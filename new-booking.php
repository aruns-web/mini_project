<?php //error_reporting(0);
include('includes/config.php'); 

if(isset($_POST['book']))
{
$ptype=$_POST['packagetype'];
$wpoint=$_POST['washingpoint'];   
$fname=$_POST['fname'];
$mobile=$_POST['contactno'];
$mail=$_POST['email'];
$vehicleno=$_POST['vno'];
$vmodel=$_POST['model'];
$date=$_POST['washdate'];
$time=$_POST['washtime'];
$message=$_POST['message'];
$status='New';
$bno=mt_rand(100000000, 999999999);
$sql="INSERT INTO tblcarwashbooking(bookingId,packageType,carWashPoint,fullName,mobileNumber,email,vno,model,washDate,washTime,message,status) VALUES(:bno,:ptype,:wpoint,:fname,:mobile,:mail,:vehicleno,:vmodel,:date,:time,:message,:status)";
$query = $dbh->prepare($sql);
$query->bindParam(':bno',$bno,PDO::PARAM_STR);
$query->bindParam(':ptype',$ptype,PDO::PARAM_STR);
$query->bindParam(':wpoint',$wpoint,PDO::PARAM_STR);
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':mobile',$mobile,PDO::PARAM_STR);
$query->bindParam(':mail',$mail,PDO::PARAM_STR);
$query->bindParam(':vehicleno',$vehicleno,PDO::PARAM_STR);
$query->bindParam(':vmodel',$vmodel,PDO::PARAM_STR);
$query->bindParam(':date',$date,PDO::PARAM_STR);
$query->bindParam(':time',$time,PDO::PARAM_STR);
$query->bindParam(':message',$message,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
 
  echo '<script>alert("Your booking done successfully. Booking number is "+"'.$bno.'")</script>';
 echo "<script>window.location.href ='washing-plans.php'</script>";
}
else 
{
 echo "<script>alert('Something went wrong. Please try again.');</script>";
}

}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Car Wash Management System | Bookings Page</title>


        <!-- Favicon -->
        <link href="img/favicon.ico" rel="icon">

        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"> 
        
        <!-- CSS Libraries -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="lib/flaticon/font/flaticon.css" rel="stylesheet">
        <link href="lib/animate/animate.min.css" rel="stylesheet">
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="css/style.css" rel="stylesheet">
    </head>

    <body>
<?php include_once('includes/header.php');?>
            <!-- Page Header Start -->
        <div class="page-header">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2>Bookings</h2>
                    </div>
                    <div class="col-12">
                        <a href="index.php">Home</a>
                        <a href="new-booking.php">Bookings</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Header End -->





     		<!--grid-->
 	<div class="grid-form">
 
 <!---->
        <div class="grid-form1">
            <h3>Add Car Washing Booking</h3>
 
                <div class="tab-content">
                        <div class="tab-pane active" id="horizontal-form">
                             <form class="form-horizontal" name="washingpoint" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                     <label for="focusedinput" class="col-sm-2 control-label">Package Type</label>
                                     <div class="col-sm-8">
                                  <select name="packagetype" required class="form-control">
                                     <option value="">Package Type</option>
                                     <option value="1">BASIC CLEANING ($10.99)</option>
                                     <option value="2">PREMIUM CLEANING ($20.99)</option>
                                     <option value="3 ">COMPLEX CLEANING($30.99)</option>
                                  </select>
                                </div>
                        </div>
                        <div class="form-group">
                                <label for="focusedinput" class="col-sm-2 control-label">Washing Point</label>
                                <div class="col-sm-8">
                                    <select name="washingpoint" required class="form-control">
                                        <option value="">Select Washing Point</option>
 <?php $sql = "SELECT * from tblwashingpoints";
 $query = $dbh -> prepare($sql);
 $query->execute();
 $results=$query->fetchAll(PDO::FETCH_OBJ);
 foreach($results as $result)
 {               ?>  
     <option value="<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->washingPointName);?> (<?php echo htmlentities($result->washingPointAddress);?>)</option>
 <?php } ?>
                                    </select>
                                </div>
                        </div>
 
                        <div class="form-group">
                                <label for="focusedinput" class="col-sm-2 control-label">Full Name</label>
                                <div class="col-sm-8">
                                    <input type="text" name="fname" class="form-control" required placeholder="Full Name">
                                </div>
                        </div>
                        
                        <div class="form-group">
                                <label for="focusedinput" class="col-sm-2 control-label">Mobile No</label>
                                <div class="col-sm-8">
                                    <input type="text" name="contactno" class="form-control" pattern="[0-9]{10}" title="10 numeric characters only" required placeholder="Mobile No.">
                                </div>
                        </div>


                        <div class="form-group">
                                <label for="focusedinput" class="col-sm-2 control-label">E Mail</label>
                                <div class="col-sm-8">
                                <input type="text" name="email" class="form-control" required placeholder="E Mail">
                                </div>
                        </div>


                        <div class="form-group">
                                <label for="focusedinput" class="col-sm-2 control-label">Vehicle No</label>
                                <div class="col-sm-8">
                                <input type="text" name="vno" class="form-control" required placeholder="Vehicle No">
                                </div>
                        </div>

                        <div class="form-group">
                                <label for="focusedinput" class="col-sm-2 control-label">Vehicle Model</label>
                                <div class="col-sm-8">
                                <input type="text" name="model" class="form-control" required placeholder="Vehicle Model">
                                </div>
                        </div>

                        <div class="form-group">
								<label for="focusedinput" class="col-sm-2 control-label">Wash Date</label>
								<div class="col-sm-8">
									<input type="date" name="washdate" required class="form-control">
							    </div>
						</div>
 

                        <div class="form-group">
                                <label for="focusedinput" class="col-sm-2 control-label">Wash Time</label>
                                <div class="col-sm-8">
                                    <input type="time" name="washtime" required class="form-control">
                                </div>
                        </div>


                        <div class="form-group">
                                <label for="focusedinput" class="col-sm-2 control-label">Message (if any)</label>
                                <div class="col-sm-8">
                                    <textarea name="message"  class="form-control" placeholder="Message if any"></textarea>
                                </div>
                        </div>
 
                        <div class="row">
                                <div class="col-sm-8 col-sm-offset-2">
                                    <button type="submit" name="book" class="btn-primary btn">Add</button>
 
                                     <button type="reset" class="btn-inverse btn">Reset</button>
                        </div>
        </div>
    </div>
                     
                            </form>
             <div class="panel-footer">
         
           </div>
        </form>
        </div>
    </div>
      <!--//grid-->











        

        
        
        


        <!-- Footer Start -->
   <?php include_once('includes/footer.php');?>  
        


        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="lib/waypoints/waypoints.min.js"></script>
        <script src="lib/counterup/counterup.min.js"></script>
        
        <!-- Contact Javascript File -->
        <script src="mail/jqBootstrapValidation.min.js"></script>
        <script src="mail/contact.js"></script>

        <!-- Template Javascript -->
        <script src="js/main.js"></script>
    </body>
</html>


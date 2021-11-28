<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
  <?php 
     // 1.make Db Connection
     $conn = @mysqli_connect('localhost', 'root', '', 'selfdatabase_db') or die ("could not connect to database");
     // 2.build the query
     if(isset($_GET['register'])){
        //sanatized the data
        $name = mysqli_real_escape_string($conn, $_GET["name"]);
        $email = mysqli_real_escape_string($conn, $_GET["email"]);
        $pass = mysqli_real_escape_string($conn, $_GET["pass"]);
        $cpass = mysqli_real_escape_string($conn, $_GET["cpass"]);
     
         if(isset($_GET['agree'])){
              $agree = mysqli_real_escape_string($conn, $_GET["agree"]);
         }
         if((isset($agree)) && ($agree=="yes")){

            $duplicate = "SELECT * FROM selfusers_tbl WHERE email = '$email' ";
            $result = mysqli_query($conn, $duplicate);
            $count = mysqli_num_rows($result);
   if($count > 0){
     echo "<script> swal('Opps! Email Alredy Exists', 'Please Use Valid Email!', 'error');</script>";
   }else{
    if($pass === $cpass){
      $salt = mt_rand(10,1000);
       $pass = hash('sha512', $salt.$pass.$salt);
       $sql = "INSERT INTO selfusers_tbl(`name`,`email`, `password`, `salt`) VALUES ('$name','$email','$pass','$salt')";
        //3. excute the query
         mysqli_query($conn, $sql);

       header('Location: ' .'index.php?msg=1' );
    
    }
    else{
     //  echo"not Match";
     echo "<script> swal('Please Enter the Match Password!', 'Please!', 'error');</script>";
    }
   }
          
         }
         else{
          echo "<script> swal('Please accept terms and condition!', 'Please!', 'error');</script>";
        }
        // header('Location: ' .'index.php' );
     }
    
// Close Db Connection
mysqli_close($conn);
  ?>
  <?php 
   if((isset($_GET['msg'])) && ($_GET['msg'] == 1)){
    echo "<script> swal('Great Job', 'Registered Succssfully..', 'success');</script>";
}
?>
    <div class="form bg-white m-auto mt-5">
        <div class="row">
            <div class="col-md-7 col-12 bg-img"> </div>
            <div class="col-12 col-md-5">
                <form class="me-2 mt-md-4" >
                    <div class="mb-2">
                      <label for="name" class="form-label">Full Name</label>
                      <input required type="text"  name="name" class="form-control" id="name" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-2">
                      <label for="exampleInputEmail1" class="form-label">Email address</label>
                       <input required type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-2">
                      <label for="exampleInputPassword1" class="form-label">Password</label>
                      <input required type="password" name="pass" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="mb-2">
                      <label for="exampleInputPassword2" class="form-label">Confirm Password</label>
                      <input required type="password" name="cpass" class="form-control" id="exampleInputPassword2">
                    </div>
                    <div class="mb-2 form-check d-flex align-items-center ">
                      <input name="agree" value="yes" type="checkbox" class="form-check-input" id="exampleCheck1">
                      <label class="form-check-label mt-1 mx-1" for="exampleCheck1">Terms and Conditions</label>
                    </div>
                    <button type="submit" name="register" class="btn btn-primary btn-sm  ">Register</button>
                  </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
 <script>
      var bgImg = document.querySelector(".bg-img")
    setInterval(()=>{
        var hue = Math.random()*400
          bgImg.style.filter = 'hue-rotate('+hue+'deg)'
    },500)
 </script>
 <script src="js/main.js"></script>
</body>
</html>
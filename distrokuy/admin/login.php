<?php
session_start();
// koneksi
$koneksi = new mysqli("localhost","root","","distrokuy");
?>

<!DOCTYPE html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Admin</title>
    <link href="assets/css/style.css" rel="stylesheet" />
</head>

<body>
    <div class="container">
        <div class="row text-center ">
            <div class="col-md-12">
                <br /><br />
                <br /><br />
                <img src="http://localhost/distrokuy/admin/assets/images/distrokuy.png" width="280" height="120">
                <br /><br />

                 <br />
            </div>
        </div>
         <div class="row ">
               
                  <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                        <strong> Login Admin </strong>  
                            </div>
                            <div class="panel-body">
                                <form role="form" method="post">
                                     <div class="form-group input-group">
                                            <label></label>
                                            <input type="text" class="form-control" name="user" placeholder="username" />
                                        </div>
                                            <div class="form-group input-group">
                                            
                                            <input type="password" class="form-control"  name="pass" placeholder="password" />
                                        </div>    
                                     <button class="btn btn-primary" name="login" >Login</button>
                                    </form>

                                    <?php
                                     if (isset($_POST['login']))
                                     {
                                      $ambil = $koneksi->query("SELECT * FROM admin WHERE username='$_POST[user]'
                                      AND password = '$_POST[pass]'");
                                      $yangcocok = $ambil->num_rows;
                                      if ($yangcocok==1)
                                      {
                                        $_SESSION['admin']=$ambil->fetch_assoc();
                                        echo "<div class=alert alert-info'>login succes</div>";
                                        echo "<meta http-equiv='refresh' content=1;url='index.php'>";
                                      }
                                      else
                                      {
                                        echo "<div class=alert alert-danger'>login failed</div>";
                                        echo "<meta http-equiv='refresh' content=1;url='login.php'>";
                                      }
                                     }
                                     ?>
                                   
                            </div>
                           
                        </div>
                    </div>
                
                
        </div>
    </div>

   
</body>
</html>

<!--This page is contained Registration and Login form, After login, user can use dashboard here. -->

<!-- here this php code for check user is already login or not, means he didn't log out then he should be login-->
<?php
session_start();
include 'config.php';
if(isset($_SESSION['SESS_FIRST_NAME']) && isset($_SESSION['SESS_LAST_NAME']))
{
    
    $username = $_SESSION['SESS_FIRST_NAME'];
    $password = $_SESSION['SESS_LAST_NAME'];
    $query = "SELECT * FROM users WHERE usename = '$username' AND password = '$password'";
    $result = mysqli_query($con, $query);
    if(mysqli_num_rows($result) > 0)
    {
        $member = mysqli_fetch_assoc($result);
        $_SESSION['SESS_USER_ID'] = $member['user_id'];
        $_SESSION['SESS_FIRST_NAME'] = $member['usename'];
        $_SESSION['SESS_LAST_NAME'] = $member['password'];
        // Set the session 'loggedin' to 1 and forward the user to the admin page
        header('Location: dash.php');
        exit();
    }
}
?>

<!-- here this php code for check stored cookie for remember me-->
<?php
session_start();
include 'config.php';
if(isset($_COOKIE['avneshCookUser']) && isset($_COOKIE['avneshCookPass']))
{
    
    $username = $_COOKIE['avneshCookUser'];
    // Select the username from the cookie
    $password = $_COOKIE['avneshCookPass'];
    // Select the password from the cookie
}
?>

<?php $mszz = $_GET['msz']; ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="/dashboard/assets/ico/favicon.png">
        <link href="/dashboard/dist/css/sticky-footer-navbar.css" rel="stylesheet">
        
        <title>Avnesh-Dashboard</title>
        <link href="/dashboard/dist/css/bootstrap.css" rel="stylesheet">
        <link href="/dashboard/eternicode-bootstrap/css/datepicker.css" rel="stylesheet">
        <link href="style.css" rel="stylesheet">
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
       
        // Javascript code for validation
        
        <script type=text/javascript>
            function validateForm()
            {
              var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
              var email = document.getElementById('email');
              if( document.myForm.name.value == "" )
              {
                alert( "Please Enter your name!");
                document.myForm.name.focus();
                return false;
              }
              if(/^([a­zA­Z ])+$/.test(document.myForm.name.value))
              {
                alert('Name should be alphanumeric');
                document.myForm.name.focus();
                return false;
              }
              if((document.myForm.name.value).length>20)
              {
                alert("Name should be <=20 character");
                return false;
              }
              if( document.myForm.dob.value == "" )
              {
                alert( "Please Enter your D.O.B.!");
                document.myForm.dob.focus();
                return false;
              }
              if (!filter.test(email.value))
              {
                alert('Please provide a valid email address');
                email.focus;
                return false;
              }
              
              if( document.myForm.userName.value == "" )
              {
                alert( "Please enter your User Name!");
                document.myForm.userName.focus();
                return false;
              }
              if(/^([a­zA­Z0­9])+$/.test(document.myForm.userName.value))
              {
                alert('User Name should be alphanumeric');
                document.myForm.userName.focus();
                return false;
              }
              if((document.myForm.userName.value).length>20)
              {
                alert("User Name should be <=20 character");
                return false;
              }
              if( document.myForm.pasword.value == "" )
              {
                alert( "Please enter your password!");
                document.myForm.pasword.focus();
                return false;
              }
              if( document.myForm.repasword.value == "" )
              {
                alert( "Please re-enter your password!");
                document.myForm.repasword.focus();
                return false;
              }
              if( document.myForm.pasword.value != document.myForm.repasword.value)
              {
                alert( "your passwords do not match");
                document.myForm.pasword.focus();
                return false;
              }
            }
            
            
            function validateSignForm()
            {
              if( document.mySignForm.userName.value == "" )
              {
                alert( "Please enter your User Name!");
                document.mySignForm.userName.focus();
                return false;
              }
              if( document.mySignForm.pasword.value == "" )
              {
                alert( "Please enter your password!");
                document.mySignForm.pasword.focus();
                return false;
              }
            }
        </script>
        
        <style type="text/css">
            .menu12
            {
                border-left: 1px solid red;
            }
            .ulBullet
            {
              list-style-type: none;
              padding:0;
              margin:0;
            }
            
            
             .span2{width: 126px;}
            .glyphicon-calendar{width: 400px; height: 200px;}
            .ulBullet
            {
              list-style-type: none;
              padding:0;
              margin:0;
            }
            .leftcol{ float:left }
            .topMAr{margin-top: 5px;}
            
            #RegistrationForm {
            display:none;
           
        }
        .rightborder {
        
        }
        .vr {
            width: 10px;
            background-color: #000;
           
            top: 0;
            bottom: 0;
            left: 150px;
        }
        .glow {
            text-shadow:-1px 0px 20px #0a008f;
            color:white;
        }
        .dead {
         text-shadow:-1px 0px 20px #575454;
         color:white;
        }
        .btn-primary{background-color:#778554;}
        .btn-primary:hover{background-color: #E6E4D1;}
        .glyphicon-calendar{color: #778554;}
        </style>
        
        
    </head>
    <body>
        <div id="wrap">

      <!-- Fixed navbar -->
      <div class="navbar navbar-default navbar-fixed-top" style="background-color:#444444">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Neev Tech</a>
          </div>
          <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Log Management</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
     
        

          <div class="navbar navbar-default" style="background-color:#E6E4D1; height: 80px;">
            <div class="row">
               
            </div>
        </div>
              
        
        
      <div class="container" style="margin-top:-40px;">
          <div class="row">
              <div class="col-md-4">
              </div>
            <div class="col-md-4" id="RegistrationForm">
                <form class="form-signin" method="POST" action="checkMail.php" name="myForm" onsubmit="return(validateForm());">
                    <h2 class="form-signin-heading glow"  style ="color:#778554;">Create Account:</h2>
                    <input type="text" class="form-control" name="name" placeholder="Full Name" autofocus>
                    
                    
                    
                    <input type="text" class="form-control" id="email" name="email" placeholder="Email address" autofocus>
                
                    <div class="radio-inline">
                      <label>
                        <input type="radio" name="optionsRadios" id="male" value="male" checked>
                        Male
                      </label>
                    </div>
                    
                    <div class="radio-inline">
                      <label>
                        <input type="radio" name="optionsRadios" id="female" value="female">
                        Female
                      </label>
                    </div>
                    <input type="text" class="form-control" name="userName" placeholder="User Name" autofocus>
                    <input type="password" class="form-control" id="pasword" name="pasword" placeholder="Password">
                    <input type="password" class="form-control" id="repasword" name="repasword" placeholder="Re-enter Password">
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Register Me</button>
                </form>
            </div>
            
            
            <div class="col-md-4" id="SignIn">
                <form  class="form-signin" method="POST" action="signProcess.php" name="mySignForm" onsubmit="return(validateSignForm());">
                    <h2 class="form-signin-heading glow" style ="color:#778554;">Please sign in</h2>
                    <input type="text" class="form-control" name="userName" placeholder="User Name" autofocus value="<?php echo $username; ?>">
                    <input type="password" class="form-control" name="pasword" placeholder="Password" value="<?php echo $password; ?>">
                    <label class="checkbox">
                      <input type="checkbox" name="remember" value="remember"> Remember me
                    </label>
                    <button id="BtSignIn" class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
                    <a id="NewUser" href="#"><h3 class="glow" style="color:#778554">Are you New User?</h3></a>
                    
                </form>
                <div id="addmsz"><p id='mszz1'><?php echo $mszz; ?></p> </div>
            </div>
              
          </div>
      </div>
      
      
      
        
        </div>  
        
        
        
        
        <div id="footer">
      <div class="container">
        <p class="text-muted credit">Example courtesy <a href="http://martinbean.co.uk">Martin Bean</a> and <a href="http://ryanfait.com/sticky-footer/">Ryan Fait</a>.</p>
      </div>
    </div>
        
       <script type="text/javascript">
            $(document).ready(function () {
            $("#NewUser").click(function () {
               

                $("#RegistrationForm").show("slow", function () {
                    $("#SignIn input").attr("disabled", true);
<!--                    $("#SignIn #Label5").removeClass("glow").addClass("dead");-->
                    $("#SignIn #BtSignIn").removeClass("btn-success").addClass("btn-active");
                    $("#NewUser").unbind('click');

                });
                $("#SignIn").hide('slow');
                
                
            });


            
        });

            setTimeout(function(){
              $('#mszz1').remove();
            }, 5000);

        </script> 
        
        <script type="text/javascript" src="/dashboard/angular.min.js"></script>
        <script type="text/javascript" src="/dashboard/assets/js/jquery.js"></script>
        <script type="text/javascript" src="/dashboard/dist/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="/dashboard/assets/js/holder.js"></script>
        <script type="text/javascript" src="/dashboard/eternicode-bootstrap/js/bootstrap-datepicker.js"></script>
    </body>
</html>

<?php
define('DOC_ROOT',dirname(__FILE__)); // To properly get the config.php file
$username = $_POST['username']; //Set UserName
$password = $_POST['password']; //Set Password

$msg ='';
if(isset($username, $password)) {
    ob_start();
    include(DOC_ROOT.'/config.php'); //Initiate the MySQL connection
    // To protect MySQL injection (more detail about MySQL injection)
    $myusername = stripslashes($username);
    $mypassword = stripslashes($password);
    $myusername = mysqli_real_escape_string($dbC, $myusername);
    $mypassword = mysqli_real_escape_string($dbC, $mypassword);

    $sql="SELECT * FROM admin WHERE username ='$myusername' and password =('$mypassword')";
    $result=mysqli_query($dbC, $sql);
    
    // Mysql_num_row is counting table row
    $count=mysqli_num_rows($result);
    
    // If result matched $myusername and $mypassword, table row must be 1 row
    if($count==1){
        
        // Register $myusername, $mypassword and redirect to file "admin.php"
        session_start();
        $_SESSION['admin'] = $myusername;
        $_SESSION['password'] = $mypassword;
       // print_r("1234");
    //exit;
       // header("location:");
       $_SESSION['name']= $myusername;// header("Location: http://localhost/data lekage detaction/admin/admin.php");
        header("location:admin/admin.php");
    }
    else {
        $msg = "Wrong Username or Password.";

        header("location:index.php?msg=$msg");
    }
    ob_end_flush();
}
else {
    header("location:index.php?msg=Please enter some username and password");
}
?>
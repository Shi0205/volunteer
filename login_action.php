<?php 
session_start();
include_once 'database.php';


if(isset($_POST['login'])){

    $email = $_POST['emaill'];
    $pswd = $_POST['pswd'];

    if(empty($email) || empty($pswd)){
        $_SESSION['error'] = "Please fill the blanks";
        echo "blank1";
       
    }else{
       try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt1 = $conn->prepare("SELECT * FROM tbl_users WHERE fld_user_email=:email LIMIT 1");

        $stmt1->bindParam(':email', $email, PDO::PARAM_STR);
        
        $stmt1->execute();
        $result = $stmt1->fetch(PDO::FETCH_ASSOC);

        if (isset($result['fld_user_email'])) {
            if($result['fld_user_password']== $pswd){
                $_SESSION['login'] = true;
                $_SESSION['id'] = $result['fld_user_id'];
                
                if($result['fld_user_role'] == "admin"){
                     $_SESSION['admin'] = true;
                }else{
                    $_SESSION['admin'] = false;
                }
               
                
                if($_SESSION['admin'] == false){
                    $stmt2 = $conn->prepare("SELECT * FROM tbl_volunteers where fld_volunteer_email=:email LIMIT 1");
                    $stmt2->bindParam('email', $email, PDO::PARAM_STR);
                    $stmt2->execute();
                    $result2 = $stmt2->fetch(PDO::FETCH_ASSOC);
                    $_SESSION['name']=$result2['fld_volunteer_fname']. ' '. $result2['fld_volunteer_lname'];
                }
                
                if($_SESSION['admin'] == true){
                    $stmt2 = $conn->prepare("SELECT * FROM tbl_admins where fld_admin_email=:email LIMIT 1");
                    $stmt2->bindParam('email', $email, PDO::PARAM_STR);
                    $stmt2->execute();
                    $result2 = $stmt2->fetch(PDO::FETCH_ASSOC);
                    $_SESSION['name']=$result2['fld_admin_fname']. ' '. $result2['fld_admin_lname'];
                }
                
               
                header("Location:index.php");
                exit();
                
            }else{
                $_SESSION['errorM'] = "Invalid password. Please try again.";
            }
        }else{
            $_SESSION['errorM'] = "Invalid username. Please try again.";
        }

        header("Location: login.php");
        exit();

    }catch (PDOException $e) {
     $_SESSION['errorM'] = "problem";
    }
 $conn = null;
}



}else{
   echo "Error: You have execute a wrong PHP. Please contact the web adminstrator.";
   die();
}

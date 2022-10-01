<?php 
include_once 'database.php';
session_start();



if(isset($_SESSION['login'])){

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        // Create
    if (isset($_POST['create'])) {
        try { 
            $conn->beginTransaction();

            $stmt1 = $conn->prepare("INSERT INTO tbl_admins(fld_admin_id, fld_admin_fname, fld_admin_lname, fld_admin_email, fld_admin_gender, fld_admin_phone, fld_admin_address) VALUES (:aid, :fname, :lname, :email, :gender, :phone, :address)");

            $stmt1->bindParam(':aid', $aid, PDO::PARAM_STR);
            $stmt1->bindParam(':fname', $fname, PDO::PARAM_STR);
            $stmt1->bindParam(':lname', $lname, PDO::PARAM_STR);
            $stmt1->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt1->bindParam(':gender', $gender, PDO::PARAM_STR);
            $stmt1->bindParam(':phone', $phone, PDO::PARAM_STR);
            $stmt1->bindParam(':address', $address, PDO::PARAM_STR);


            $aid = uniqid('a', true);
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $email = $_POST['email'];
            $pswd = $_POST['passwordd'];
            $gender = $_POST['gender'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];

            $stmt1->execute();

            $stmt2 = $conn->prepare("INSERT INTO tbl_users(fld_user_id, fld_user_email, fld_user_password, fld_user_role ) VALUES (:uid,:email, :pswd, :role)");
            $stmt2->bindParam(":uid", $aid, PDO::PARAM_STR);
            $stmt2->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt2->bindParam(":pswd", $pswd, PDO::PARAM_STR);
            $stmt2->bindParam("role", $role, PDO::PARAM_STR);

            $role = "admin";
            $stmt2->execute();

            $conn->commit();

        } catch (PDOException $e) {
            $conn->rollback();
            echo "Error: " . $e->getMessage();
            
        }
    } // NOTE: End create
    
    // Update
    if (isset($_POST['update'])) {
        if($_SESSION['admin']==true){
            try{
                  $conn->beginTransaction();
                  
                  $stmt1 = $conn->prepare("UPDATE tbl_admins SET fld_admin_fname=:fname, fld_admin_lname=:lname, fld_admin_email=:email, fld_admin_gender=:gender, fld_admin_phone=:phone, fld_admin_address=:address  WHERE fld_admin_id=:oldaid");
                  
                  $stmt1->bindParam(':oldaid', $oldaid, PDO::PARAM_STR);
                  $stmt1->bindParam(':fname', $fname, PDO::PARAM_STR);
                  $stmt1->bindParam(':lname', $lname, PDO::PARAM_STR);
                  $stmt1->bindParam(':email', $email, PDO::PARAM_STR);
                  $stmt1->bindParam(':gender', $gender, PDO::PARAM_STR);
                  $stmt1->bindParam(':phone', $phone, PDO::PARAM_STR);
                  $stmt1->bindParam(':address', $address, PDO::PARAM_STR);
                  
                  $oldaid = $_POST['oldaid'];
                  $fname = $_POST['fname'];
                  $lname = $_POST['lname'];
                  $email = $_POST['email'];
                  $pswd = $_POST['passwordd'];
                  $gender = $_POST['gender'];
                  $phone = $_POST['phone'];
                  $address = $_POST['address'];
                  
                  $stmt1->execute();
                  
                  $stmt2 = $conn->prepare("UPDATE INTO tbl_users(fld_user_email=:email, fld_user_password =:pswd WHERE fld_user_id=:olduid");
                  
                  $stmt2->bindParam(":olduid", $oldaid, PDO::PARAM_STR);
                  $stmt2->bindParam(":email", $email, PDO::PARAM_STR);
                  $stmt2->bindParam(":pswd", $pswd, PDO::PARAM_STR);
                  $stmt2->execute();
                  $conn->commit();
                  
                  
            }catch(PDOException $e){
                $conn->rollback();
                echo "Error: " . $e->getMessage();
            }
        }
    } // End of Update
    
      // Delete
    if (isset($_GET['delete'])) {
        if($_SESSION['admin'] == true){
            try {
                $conn->beginTransaction();
                
                $stmt1 = $conn->prepare("DELETE FROM tbl_admins WHERE fld_admin_id = :aid");
                $stmt1->bindParam(':aid', $aid, PDO::PARAM_STR);
                
                $aid = $_GET['delete'];
                $stmt1->execute();
                
                $stmt2 = $conn->prepare("DELETE FROM tbl_users WHERE fld_user_id = :uid");
                $stmt1->bindParam(':uid', aid, PDO::PARAM_STR);
                
                $stmt2->execute();
                
                $conn->commit();
                
                header("Location: admins.php");
                
            } catch (PDOException $e) {
                $conn->rollback();
                echo "Error: ".$e->getMessage();
            } 
            
          
        }
        
    }
    
    // Edit
    if(isset($_GET['edit'])){
        if($_SESSION['admin'] == true){
            try{
                 $stmt = $conn->prepare("SELECT * FROM tbl_admins INNER JOIN tbl_users ON tbl_admins.fld_admin_id=tbl_users.fld_user_id WHERE fld_admin_id=:aid");
                 
                 $stmt->bindParam(':aid', aid, PDO::PARAM_STR);
                 
                 $aid = $_GET['edit'];
                 
                 $stmt->execute();
                 $editrow = $stmt->fetch(PDO::FETCH_ASSOC);
                
            }catch(PDOException $e){
                echo "Error: ". $e->getMessage();
            }
        }
    }//  End of Edit
    
    $conn = null;
    

}else{
    header("Location: login.php");
}


?>

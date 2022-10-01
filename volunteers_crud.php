<?php
include_once 'database.php';
session_start();

if (isset($_SESSION['login'])) {

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create
    if (isset($_POST['create'])) {
        try {
            $conn->beginTransaction();

            $stmt1 = $conn->prepare("INSERT INTO tbl_volunteers(fld_volunteer_id, fld_volunteer_fname, fld_volunteer_lname, fld_volunteer_email, fld_volunteer_gender, fld_volunteer_phone, fld_volunteer_address) VALUES (:vid, :fname, :lname, :email, :gender, :phone, :address)");

            $stmt1->bindParam(':vid', $vid, PDO::PARAM_STR);
            $stmt1->bindParam(':fname', $fname, PDO::PARAM_STR);
            $stmt1->bindParam(':lname', $lname, PDO::PARAM_STR);
            $stmt1->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt1->bindParam(':gender', $gender, PDO::PARAM_STR);
            $stmt1->bindParam(':phone', $phone, PDO::PARAM_STR);
            $stmt1->bindParam(':address', $address, PDO::PARAM_STR);


            $vid = uniqid('v', true);
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $email = $_POST['email'];
            $pswd = $_POST['passwordd'];
            $gender = $_POST['gender'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];

            $stmt1->execute();

            $stmt2 = $conn->prepare("INSERT INTO tbl_users(fld_user_id,fld_user_email, fld_user_password, fld_user_role ) VALUES (:uid,:email, :pswd, :role)");
            $stmt2->bindParam(":uid", $vid, PDO::PARAM_STR);
            $stmt2->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt2->bindParam(":pswd", $pswd, PDO::PARAM_STR);
            $stmt2->bindParam("role", $role, PDO::PARAM_STR);

            $role = "volunteer";
            $stmt2->execute();

            $conn->commit();
        } catch (PDOException $e) {
            $conn->rollback();
            echo "Error: " . $e->getMessage();
        }
    } // NOTE: End create

    // Delete
    if (isset($_GET['delete'])) {
        if ($_SESSION['admin'] == true) {
            try {
                $conn->beginTransaction();

                $stmt1 = $conn->prepare("DELETE FROM tbl_volunteers WHERE fld_volunteer_id = :vid");
                $stmt1->bindParam(':vid', $vid, PDO::PARAM_STR);

                $vid = $_GET['delete'];
                $stmt1->execute();

                $stmt2 = $conn->prepare("DELETE FROM tbl_users WHERE fld_user_id = :uid");
                $stmt1->bindParam(':uid', $vid, PDO::PARAM_STR);

                $stmt2->execute();

                $conn->commit();

                header("Location: volunteers.php");
            } catch (PDOException $e) {
                $conn->rollback();
                echo "Error: " . $e->getMessage();
            }
        }
    } else {
        header("Location:volunteers.php");
    } // End delete

    $conn = null;
} else {
    header("Location: login.php");
}

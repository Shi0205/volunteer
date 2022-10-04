<?php
include_once 'database.php';
session_start();
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_POST['submit'])) {
    try {
        $id = uniqid();
        $title = $_POST['title'];
        $description = $_POST['description'];
        $location = $_POST['location'];
        $noofvolunteer = $_POST['noofvolunteer'];
        $eventdate = $_POST['eventdate'];


        $stmt = $conn->prepare("INSERT INTO post (id, title, description, location, noofvolunteer, eventdate) VALUES (:id, :title, :description, :location, :noofvolunteer, :eventdate)");
        $stmt->bindParam(":id", $id, PDO::PARAM_STR);
        $stmt->bindParam(":title", $title, PDO::PARAM_STR);
        $stmt->bindParam(":description", $description, PDO::PARAM_STR);
        $stmt->bindParam(":location", $location, PDO::PARAM_STR);
        $stmt->bindParam(":noofvolunteer", $noofvolunteer, PDO::PARAM_INT);
        $stmt->bindParam(":eventdate", $eventdate, PDO::PARAM_STR);

        $stmt->execute();
        header("Location:post.php?success=added");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        header("Location:post.php?msg=" . $e->getMessage());
    }
    $conn = null;
}

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
        $latitude = $_POST['latitude'];
        $longitude = $_POST['longitude'];
        $noofvolunteer = $_POST['noofvolunteer'];

        $stmt = $conn->prepare("INSERT INTO post (id, title, description, location, noofvolunteer) VALUES (:id, :title, :description, :location, :noofvolunteer)");
        $stmt->bindParam(":id", $id, PDO::PARAM_STR);
        $stmt->bindParam(":title", $title, PDO::PARAM_STR);
        $stmt->bindParam(":description", $description, PDO::PARAM_STR);
        $stmt->bindParam(":location", $location, PDO::PARAM_STR);
        $stmt->bindParam(":noofvolunteer", $noofvolunteer, PDO::PARAM_INT);

        $stmt->execute();
        header("Location:post.php?success=true");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        header("Location:post.php?msg=" . $e->getMessage());
    }
    $conn = null;
}

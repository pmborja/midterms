<?php

$conn = new mysqli("localhost", "root", "", "db") OR die("Error: ".mysqli_error($conn));

session_start();

if(isset($_POST['save'])){
    if(!empty($_POST['product_name']) && !empty($_POST['price'])){
        $product_name = $_POST['product_name'];
        
        $price = $_POST['price'];

        $iQuery = "INSERT INTO data(product_name, price) values(?, ?)";

        $stmt = $conn->prepare($iQuery);
        $stmt->bind_param("ss", $product_name, $price);
        if($stmt->execute()){
            $_SESSION['msg'] = "Successfully Updated!";
            $_SESSION['alert'] = "alert alert-success";
        }
        $stmt->close();
        $conn->close();
    }
    else{
        $_SESSION['msg'] = "Empty!";
        $_SESSION['alert'] = "alert alert-warning";
    }
    header("location: BrowseMenu.php");
}

if(isset($_POST['delete'])){
    $id = $_POST['delete'];

    $dQuery = "DELETE FROM data WHERE id = ?";
    $stmt = $conn->prepare($dQuery);
    $stmt->bind_param('i', $id);
    if($stmt->execute()){
        $_SESSION['msg'] = "Successfully Deleted.";
        $_SESSION['alert'] = "alert alert-danger";
    }
    $stmt->close();
    $conn->close();
    header("location: BrowseMenu.php");
}

if(isset($_POST['edit'])){
    if(!empty($_POST['product_name']) && !empty($_POST['price'])){
        $product_name = $_POST['product_name'];
        $price = $_POST['price'];
        $id = $_POST['edit'];

        $uQuery = "UPDATE data SET product_name = ?, price = ? WHERE id = ?";
        $stmt = $conn->prepare($uQuery);
        $stmt->bind_param('ssi', $product_name, $price, $id);

        if($stmt->execute()){
            $_SESSION['msg'] = "Successfully Updated!";
            $_SESSION['alert'] = "alert alert-success";
        }
        $stmt->close();
        $conn->close();
    }
    else{
        $_SESSION['msg'] = "Empty!";
        $_SESSION['alert'] = "alert alert-warning";
    }
    header("location: BrowseMenu.php");
}

?>
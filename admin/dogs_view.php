 <?php 
include( "../settings/core.php" );
bounce();
 ?> 
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="../css/dog_view.css">
<title>Dogs</title>
<style>
  /* CSS styles for the form */
  #form-container {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #fff;
    padding: 20px;
    border: 2px solid #ccc;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    z-index: 1000;
    width: 305px;
    border-radius: 10px;
  }

  #form-container label {
    display: block;
    margin-bottom: 5px;
  }

  #form-container input[type="text"],
  #form-container input[type="number"],
  #form-container textarea {
    width: 80%;
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 10px;
    align-items: center;
    margin-left: 5%;
  }

  #form-container input[type="submit"] {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 10px 15px;
    border-radius: 3px;
    cursor: pointer;
  }

  #form-container input[type="submit"]:hover {
    background-color: #0056b3;
  }

  #form-container textarea {
    resize: vertical;
  }


  #form-container select{
    width: 80%;
    padding: 10px;
    margin-bottom: 15px;
    border: 2px solid #ccc;
    border-radius: 10px;
    align-items: center;
    margin-left: 5%;
    background-color: #fff;
    color: #333;
  }
</style>
</head>
<body>

<header>
    <div class="headie">
        <a href="../views/dashboard.php" class="header-link">Home</a>
        <a href="../admin/products_view.php" class="header-link">Products</a>
    </div>
    <div class="title"><b>Dogs For Sale</b></div>
    <div class="logout">
        <a href="../login/logout.php" class="header-link">Log Out</a>
    </div>
</header>

<div class="gallery">
 
        <?php
        include("../functions/get_dogs_fxn.php");
        ?>
    </div>


<script>
    function toggleForm() {
    var formContainer = document.getElementById("form-container");
    formContainer.style.display = (formContainer.style.display === "none" || formContainer.style.display === "") ? "block" : "none";
}
</script>
<div style="flex-basis: calc(25% - 20px); text-align:center;">
</body>
</html>

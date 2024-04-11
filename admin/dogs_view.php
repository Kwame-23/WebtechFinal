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
    <!-- <div class="image-container"> -->
            <!-- <img src="https://cdn.britannica.com/79/232779-050-6B0411D7/German-Shepherd-dog-Alsatian.jpg" alt="German Shepherd">
            <p>German Shepherd</p>
        </div>
        <div class="image-container">
            <img src="https://www.southernliving.com/thmb/Rz-dYEhwq_82C5_Y9GLH2ZlEoYw=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/gettyimages-837898820-1-4deae142d4d0403dbb6cb542bfc56934.jpg" alt="Golden Retriever">
            <p>Golden Retriever</p>
        </div>
        <div class="image-container">
            <img src="https://media-cldnry.s-nbcnews.com/image/upload/t_nbcnews-fp-1024-512,f_auto,q_auto:best/rockcms/2022-08/220805-border-collie-play-mn-1100-82d2f1.jpg" alt="Border Collie">
            <p>Border Collie</p>
        </div>
        <div class="image-container">
            <img src="https://b1157417.smushcdn.com/1157417/wp-content/uploads/2023/06/happy-samoyed-dog-outdoors-in-summer-field-825x550.jpg?lossy=1&strip=1&webp=0" alt="Samoyed">
            <p>Samoyed</p>
        </div> -->
        <?php

        include("../functions/get_dogs_fxn.php");

        ?>
    </div>


    <button id="open-form-button" onclick="toggleForm()">Add a Dog</button>

  <div id="form-container">
    <form id="dog-form" action="../actions/add_dog_action.php" method="post" enctype="multipart/form-data">
      <label for="name">Name:</label><br>
      <input type="text" id="name" name="name" required><br>
     
      
      <label for="breed">Breed:</label><br>
      <input type="text" id="breed" name="breed" required><br>
      <label for="description">Description:</label><br>
      <textarea id="description" name="description" required></textarea><br>
      <label for="price">Price:</label><br>
      <input type="number" id="price" name="price" min="0" step="0.01" required><br><br>

      <label for="image">Image:</label>
      <input type="file" id="image" name="image" required><br><br>
      <input type="submit" name="submit" value="Submit">
    </form>
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

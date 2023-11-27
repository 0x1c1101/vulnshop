<?php

if(empty($_POST['name']) || empty($_POST['price']) || empty($_POST['category']) || empty($_FILES['the_file']))
{
  die('Please dont leave blank inputs.');
}

ob_start();
require_once '../../@/config.php';
require_once '../../@/init.php';
if(!$user->isloggedin() || !$user->isadmin($odb)) die("Unauthorized");

$fileName = $_FILES['the_file']['name'];
$fileSize = $_FILES['the_file']['size'];
$fileTmpName  = $_FILES['the_file']['tmp_name'];
$fileType = $_FILES['the_file']['type'];

$currentDirectory = getcwd();
$uploadDirectory = "/../../img/";
$errors = []; 



if (isset($_POST['submit'])) {
      
      if ($fileSize > 4000000) {
        $errors[] = "File exceeds maximum size (4MB)";
      }

      if (strpos($fileName, ".jpg") === false && strpos($fileName, ".png") === false) {
          $errors[] = "Dosya JPG/PNG formatinda olmalidir.";
      }

      if (empty($errors)) {
        $uploadPath = $currentDirectory . $uploadDirectory . basename($fileName); 
        $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

        if ($didUpload) {

          $sql = "INSERT INTO products (name, price, image, category) VALUES (:name, :price, :image, :category)";
          $stmt = $odb->prepare($sql);

          // Bind parameters
          $imageName = "img/" . $fileName;
          $stmt->bindParam(':name', $_POST['name']);
          $stmt->bindParam(':price', $_POST['price']);
          $stmt->bindParam(':image', $imageName);
          $stmt->bindParam(':category', $_POST['category']);

          // Execute the query
          if ($stmt->execute()) {
              header('Location: /admin/products.php');
          } else {
              echo "Error adding product: " . $stmt->errorInfo()[2];
          }

          
        } else {
          echo "An error occurred.";
        }
      } 
      else {
        foreach ($errors as $error) {
          echo "Errors:<br>". $error . "<br>";
        }
      }


}

?>
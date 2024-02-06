<?php 
  session_start();
  require('../db/config.php');
  if(isset($_POST['email'])){
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $hashedPassword = hash('sha256', $password);
    
    print_r($_POST);
    $query = "SELECT parentID, parentPassword FROM parents WHERE parentEmailAdd = ?";
     $stmt = mysqli_prepare($conn, $query);
    $stmt->bind_param("s", $email);
    
    if($stmt->execute()){
      $stmt->store_result();
      
      if ($stmt->num_rows > 0) {
        $stmt->bind_result($parentID, $fromDbPassword);
        $stmt->fetch();
        echo "<br>";
        echo "From database: ".$fromDbPassword;
        echo "<br>";
        echo "Hashed Password from input: ".$hashedPassword;
        if($hashedPassword == $fromDbPassword){
          $_SESSION['statusCustomer'] = "Successfully login!";
          $_SESSION['statusCustomer_code'] = "success";
          echo "same";
          $_SESSION['parentID'] = $parentID;


          header('location: parent.php');
        } else {
            //echo "magkaiba";
        }
      } else {
        $_SESSION['statusCustomer'] = "User does not exist";
        $_SESSION['statusCustomer_code'] = "info";
        header('location: ../login.php');
      }
    } else {
      echo "Error executing the query: " . $stmt->error;
    }
    
    $stmt->close();
    mysqli_close($conn);
  }

  
?>
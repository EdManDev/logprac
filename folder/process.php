<?php
session_start();

if (isset($_POST['submit'])) {
  // storing username coming from into $username variable

  //with validation 
  $username = trim(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING));
  $password = trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));



    // if username is empty
    if (empty($username)) {
      $errors['username_err'] = 'please, enter username';
    }
    
    // if password is empty
    if (empty($password)) {
      $errors['password_err'] = 'please, enter password';
    }
  
    // counting the errors if they are zero than succes otherwise errors to users
    if (count($errors)==0) {
      $_SESSION['msg_success'] = 'you data has been stored';
      header('Location:index.php');
    } else {
      $_SESSION['msg_err'] = 'please, check the errors';
      // storing errors array with errors in session
      $_SESSION['errors'] = $errors;
    }


  // password hashing
  $password = password_hash($password, PASSWORD_DEFAULT);

  // // simple validation
  // if (empty($username) && empty($password)) {
  //   $_SESSION['msg_err'] = 'Please, enter username & password';
  // } else {
  //   $_SESSION['msg_success'] = "you entered: '$username' as your username and: '$password' as password";
  // }

  // redirecting
  header("Location:index.php");
  
}
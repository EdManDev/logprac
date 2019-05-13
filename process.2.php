<?php
session_start();

if (isset($_POST['submit'])) {
  // storing username coming from into $username variable

  // an array to store all errors
  $errors = array();

  //with validation 
  $username = trim(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING));
  $password = trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));


  // if username is empty and you have pattern ex: abc123
  $reg_username = '/^[a-z0-9]+$/i';
  if (!preg_match($reg_username, $username)) {
    $errors['username_err'] = 'invalide or empty username.';
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

  // count the errors if they are zero than success otherwise errors to users
  if (count($errors)==0) {
    
    // // Database credentials
    // define('DB_HOST','localhost');
    // define('DB_USER','root');
    // define('DB_PASS','');
    // define('DB_NAME','authcoursetwo');


    define( 'DB_NAME', 'authcoursetwo' );
    /** MySQL database username */
    define( 'DB_USER', 'root' );
    /** MySQL database password */
    define( 'DB_PASSWORD', '' );
    /** MySQL hostname */
    define( 'DB_HOST', 'localhost' );
    /** Database Charset to use in creating database tables. */
    define( 'DB_CHARSET', 'utf8' );
    /** The Database Collate type. Don't change this if in doubt. */
    define( 'DB_COLLATE', '' );

    // object of mysql
    $objDB= new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    // prepare sql query template for database step 1
    $stmt = $objDB ->prepare(
      'INSERT INTO users(username, $password) VALUES(?,?)'
    );

    // bind the parameters to prevent sql injection step 2
    $stmt -> bind_param('ss', $username, $password);

    // exuecute the statement
    $stmt -> exuecute();

    $_SESSION['msg_success'] = 'you data has been stored';
    header('Location:index.php');
  }else {
    $_SESSION['msg_err'] = 'please, check the errors';
    // storing errors array with errors in session
    $_SESSION['errors'] = $errors;
  }    


  // redirecting
  header("Location:index.php");
  
}
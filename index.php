<?php
  session_start();

  //displaying the error
  if (isset($_SESSION['msg_err'])) {
    echo($_SESSION['msg_err']);
    unset($_SESSION['msg_err']);
  }

  //dispplay success message
  if (isset($_SESSION['msg_success'])) {
    echo($_SESSION['msg_success']);
    unset($_SESSION['msg_success']);
  }

  //check if the errors happens than store those errors array into variable array
  if (isset($_SESSION['errors'])) {
    $errors = $_SESSION['errors'];
    unset($_SESSION['errors']);
  }

?>

<br /><br />
<!-- form handling data -->
<form action="process.2.php" method="POST">
  <div>
    <input type="text" name="username" placeholder="enter username" />
    <span style=" color: red; font-size: 14px;  ">
      <?php echo(isset($errors['username_err']) ? $errors['username_err']: '') ?>
    </span>
  </div>

  <div>
    <input type="password" name="password" placeholder="enter password" />
    <span style=" color: red; font-size: 14px;  ">
      <?php echo(isset($errors['password_err']) ? $errors['password_err']: '') ?>
    </span>
  </div>
  <div>
    <button type="submit" value="Submit" name="submit" style=" cursor: pointer; font-size: 24px;  ">
      submit
    </button>
    <!-- <span style=" padding: 20px; marging: 20px; ">
      <input type="submit" value="Submit" name="submit" />
    </span> -->
  </div>
</form>
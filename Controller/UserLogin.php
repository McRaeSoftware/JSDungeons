<?php
//Login User
function UserLogin()
{
  if ($_COOKIE['cookiebar'] == "CookieAllowed") // User Has Accepted Cookie policy
  {
    Require 'connection.php';

    if (isset($_POST["userLoginSubmit"]))
    {
      $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
      $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

      $sql = "SELECT * FROM User WHERE Username = :username";

      $stmt = $connection->prepare($sql);
      $success = $stmt->execute(['username' => $username]);

      if($success && $stmt->rowCount() > 0)
      {
        $result = $stmt->fetch();

        if ($result && password_verify($password, $result['Password']))
        {
          $_SESSION['userid'] = $result['User_ID'];
          $_SESSION['username'] = $result['Username'];
          header('location: ../View/index.php');
        }
        else
        {
          // invalid password
          $invalidError = "Invalid Credentials";
          header('location: ../View/userLogin.php?error='.$invalidError);
        }
      }
      else
      {
        // no records found
        $invalidError = "Invalid Credentials";
        header('location: ../View/userLogin.php?error='.$invalidError);
      }
    }
  }
  else // User has NOT accepted cookie policy
  {
    // redirect user to the register page with an error
    $errorString = ":You Must Accept the Cookie policy to login to an account.";
    header('Location: ../View/userLogin.php?error='.$errorString);
  }
}
?>

<?php




header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Connection: close");
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = $username;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;

                            // Redirect user to welcome page
                            header("location: app_list.php");
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username or password.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }


    // Close connection
    mysqli_close($link);
}
?>
<html>
<head>

<link rel="stylesheet" type="text/css" href="style.css?anything=goeshere" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;400&display=swap" rel="stylesheet">
<title>2FA Tracking System</title>
</head>
<body class="body">
  <table class="table">
    <tr>
      <td class="td_l">
        <p class="h1">UBS</p>
        <p class="h2">2FA Tracking System</p>
      </td>
      <td class="td_s">
        <form class="textarea" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <table>
          <tr>
            <td>
              <p class="label_2">Login</p>
            </td>
          </tr>
          <tr>
            <td>
              <p class="label_p">Please fill in your credentials to login.</p>

              <?php
                if(!empty($login_err)){
                echo '<div class="alert alert-danger">' . $login_err . '</div>';
                }
                ?>
              </td>
            </tr>
            <tr>



              <td>
                <div class="login_textbox_label">Username</div><br>
                <input type="text" placeholder="Enter Your Username" name="username" class="textbox <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>"><br>
                <span class="textbox_err_mss"><?php echo $username_err; ?></span>
              </td>
            </tr>
            <tr>
              <td>
                <div class="login_textbox_label">Password</div><br>
                <input type="password" placeholder="Enter Your Password "name="password" class="textbox <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>"><br>
                <span class="textbox_err_mss"><?php echo $password_err; ?></span>
              </td>
            </tr>
          <tr>
              <td class="td_button">
                <input type="submit" class="button" value="Login">
              </td>
          </tr>
          <tr>
              <td>
                <p class="label_p">If you have account, please use your credential to login. If you do not have account please contact with your administrator or manager to create a new account.</p>
              </td>
            </tr>
          </table>



        </form>
      </td>
    </tr>
  </table>
</body>
</html>

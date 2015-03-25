<!--

    James Reid Cooper
    SE-611
    3/25/15

    Week 8 of PHP

    1. Forgotten Password
    2. log_out.php
    3. created db log
    4. log_in function for index4.php

-->

<html>

<head>

    <title>Online Registration</title>
    <style>

        body {
            background-color: grey
        }
        #container {
            width: 800px;
            margin: 0 auto;
        }

        #header {
            background-color: rgb(0,46,106);
            height: 60px;
            text-align: center;
            color: white;
            padding: 2px;
        }

        #main {
            background-color: white;
            height: 400px;
        }

        #footer {
            background-color: rgb(0,46,106);
            height: 50px;
            text-align: center;
            color: white;
            padding: 2px;
        }

        #register {
            padding: 50px;
        }

        #login {
            padding: 145px;
        }

    </style>

</head>

<body>

    <div id="container">
        <div id="header">
            <h1>Online Registration System</h1>
        </div>

        <div id="main">

            <div style ="color: red">

                <?php

                // Generate Random Password String
                function generateRandomString($length = 8) {
                    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $charactersLength = strlen($characters);
                    $randomString = '';
                    for ($i = 0; $i < $length; $i++) {
                        $randomString .= $characters[rand(0, $charactersLength - 1)];
                    }
                    return $randomString;
                }

                function send_email($new_password, $user_email, $username){
                    // the message
                    $msg = "Hi '$username',\n\nYou have reset your password. Please refer to the information below for your new temporary password. Use this password to login with your account and then use the Change Password tab to change your account password. Your current password is listed below.\n\nNew Password:\n'$new_password'\n\nThank you for your understanding. We hope to see you soon!\n\n- Monmouth University Online Registration System";

                    // use wordwrap() if lines are longer than 70 characters
                    $msg = wordwrap($msg,100);

                    // send email
                    mail($user_email,"Your Password Has Been Reset - Monmouth University Online Registration System",$msg);
                }

                session_start();
                $_SESSION = array();
                session_destroy();

                setcookie('uname');
                setcookie('fname');

                // If gives you a warning about not having a time zone set or not relying on server time
                date_default_timezone_set("America/New_York");

                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                    if($_POST['button'] == "Reset") {

                        $uname = $_POST['uname'];

                        // Define an array of error
                        $error = array();

                        if (empty($uname)){
                            $error[] = "You forgot to enter username.";

                        }

                        // Check to see if anything in $error.
                        if (empty($error)){
                            //Includes database connection file for authorization
                            include("includes/db_connection.php");

                            $q = "SELECT * FROM users WHERE uname = '$uname'";

                            $r = mysqli_query($dbc, $q);

                            if (mysqli_num_rows($r) == 1){
                                $row = mysqli_fetch_array($r);

                                $email = $row['email'];
                                $uname = $row['uname'];

                                // default is 8 characters
                                $random_password = generateRandomString();

                                // define a query
                                $b = "UPDATE users SET psword=SHA1('$random_password') WHERE uname = '$uname'";

                                // execute the query
                                $r = mysqli_query($dbc, $b);
                                if ($r){
                                    send_email($random_password, $email, $uname);
                                    header('LOCATION: index4.php');
                                }
                                else {
                                    echo "Sorry, failed connection";
                                }
                            } else {
                                echo "Wrong Username";
                            }
                        }  else {
                            foreach ($error as $msg) {
                                echo $msg;
                            }
                        }
                    }
                }
                ?>

            </div>

            <div id="login" align="center">
                <form action="" method="POST">
                    <table>
                        <tr>
                            Enter your username to reset your password then click Reset to submit your request.
                        </tr>
                        <tr>
                            <td>Username:</td>
                            <td><input type="text" name="uname" value= <?php if(isset($_POST['uname'])) echo $_POST['uname']; ?> ></td>
                        </tr>
                    </table>
                    <input type="submit" name="button" value="Reset"/>
                </form>
            </div>

            <?php include("includes/footer.html"); ?>
        </div>
    </div>

</body>

</html>
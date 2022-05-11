<?php

include 'includes/library.php';

if(!isset($_GET["code"]))
{
    exit("Error! No code was sent");
    die();
}

$code = $_GET["code"];

$errors = array(); //declare empty array to add errors too
$passwordnew = $_POST['passwordnew'] ?? null;

if (isset($_POST['submit']))
{
    if(!isset($passwordnew) || strlen($passwordnew) === 0) //make sure a password was given
    {
        $errors['password'] = true;
    }
    else{
        $pdo = connectDB(); //connect to the database
        $result = $pdo->prepare('SELECT email FROM resetPassword WHERE code=?');
        $result->execute([$code]); //execute the prepared query
        $row = $result->fetch(); //fetch the next row,

        if($row)
        {
            $query = 'UPDATE Users SET password=? WHERE email=?';
            $updateUser = $pdo->prepare($query);
            $updateUser->execute([password_hash($passwordnew, PASSWORD_BCRYPT) , $row['email']]);

            $delete = $pdo->prepare('DELETE FROM resetPassword WHERE code=?');
            $delete->execute([$code]); //execute the prepared query

            header("Location: forgotpassword_success.php");
        }
        else{
            exit("Error! This link was already used");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Forgot Password&colon; UniInfo</title>
        <link rel="stylesheet" href="styles/project_master.css">
    </head>
    <body>
       <main>
       <h2>Reset Password</h2>
            <p>Please enter your new password.</p>
            <form id="passwordnew" name="passwordnew" method="post" enctype="multipart/form-data">
                <div>
                    <label for="passwordnew">New Password:</label>
                    <input type="password" id="passwordnew" name="passwordnew" required>
                    <span class="error <?=!isset($errors['password']) ? 'hidden' : "";?>">Please enter a password</span>
                </div>
                <div>
                    <button type="submit" name="submit">Submit</button>
                </div>
            </form>

       </main>

<?php include "includes/footer.php";?>

</body>
</html>
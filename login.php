<?php  

$user = $_POST['username'] ?? null;
$password = $_POST['password'] ?? null;
$remember = $_POST['remember']?? null;

$errors = array();

if (isset($_POST['submit'])) 
{

    include 'includes/library.php';
    $pdo = connectDB(); //connect to database
        
    $query = "SELECT * FROM Users WHERE username =?"; //select the row of the table with the given username
    $checkCredentials = $pdo->prepare($query); //prepare that query
    $checkCredentials->execute([$user]); //execute
    $row = $checkCredentials->fetch(); //fetch the next row, there should only be one as usernames are unique

        
    if($row === false) //if row is false then no row with that username exists and user is invalid
    { 
        $errors['login'] = true;
    }
    else //if the row was valid
    {
        if(password_verify($password, $row['password'])) //verify that the password is correct
        {
            session_start(); //start the session
            $_SESSION['user'] = $row['username']; //load session credentials
            $_SESSION['id'] = $row['userId'];

            if(!empty($_POST["remember"])) // if remeber was checked
            {
                setcookie ("userrem",$user,time()+ (10 * 365 * 24 * 60 * 60));
            }
            else
            {
                if(isset($_COOKIE["userrem"])) {
                    setcookie ("userem","");
                }
            }

            header("Location: index.php"); //redirect to the homepage
        }
        else
        {
            $errors['login'] = true;    //incorrect password
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Stars4Uni&colon; Login </title>
        <link rel="stylesheet" href="styles/website_master.css" />
    </head>
    <body>
        <main>
            <h2>LOGIN</h2>
             <form id="login" method="post" action="<?php echo $_SERVER['PHP_SELF']?>" >
                <div>
                     <label for="username">Username:</label> 
                     <input type="text" id="username" name="username" size="40" autocomplete="new-password" placeholder="Enter your username here" value="<?php if(isset($_COOKIE["userrem"])) { echo $_COOKIE["userrem"]; }?>"/>
                </div>
                <div>
                    <label for="password">Password</label> 
                    <input type="password" id="password" name="password" autocomplete="new-password"  placeholder="Enter your password here" size="40"/>
                </div>
                <div>
                    <a href="forgot_password.php">Forgot Password?</a>
                </div>
                <div>
                    <span class="error <?=!isset($errors['login']) ? 'hidden' : "";?>"> Your username or password was invalid</span>
                </div>
                <div>
                    <label for="remember">Remember me</label>
                    <input type="checkbox" name="remember" id="remember" value="checked" />
                </div>

                <div id="buttons">    
                    <button type="submit" name="submit">Login</button>
                </div>
             </form>
        </main>
    </body>
</html>

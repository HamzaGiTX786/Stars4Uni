<?php
include 'includes/library.php';

$errors = array(); //declare empty array to add errors too

//get name from post or set to NULL if doesn't exist
$fname = $_POST['fname'] ?? null;
$lname = $_POST['lname'] ?? null;
$email = $_POST['email'] ?? null;
$password = $_POST['password'] ?? null;
$passwordre = $_POST['passwordre'] ?? null;
$agree = $_POST['agree'] ?? null;
$username = $_POST['username'] ?? null;
$university = $_POST['university'] ?? null;
$major = $_POST['major'] ?? null;
$date_start =$_POST['date_start']??null;
$date_end = $_POST['date_end']?? null; 

if (isset($_POST['submit'])) 
{ //only do this code if the form has been submitted
    
    //validate user has entered a first name
    if (!isset($fname) || strlen($fname) === 0) 
    {
        $errors['fname'] = true;
    }
    
    //validate user has entered a last name
    if (!isset($lname) || strlen($lname) === 0) 
    {
        $errors['lname'] = true;
    }
    
    //validate and sanitize email
    if(!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        $errors['email'] = true;
    }

    if (!isset($university)|| strlen($university)===0)
    {
        $errors['university'] = true;
    }

    if (!isset($major) || strlen($major) === 0)
    {
        $errors['major'] = true;
    }

    if (!isset($date_start) || strlen($date_start) === 0)
    {
        $errors['date_start'] = true;
    }

    if (!isset($date_end) || strlen($date_end) === 0)
    {
        $errors['date_end'] = true;
    }

    //validate user has checked the terms and conditions
    if(empty($agree)){
        $errors['agree'] = true;
    }
    
    if (!isset($username) || strlen($username) === 0) // make sure a username was entered
    {
        $errors['username'] = true;
    }
    
    if(!isset($password) || strlen($password) === 0) //make sure a password was given
    {
        $errors['password'] = true;
    }
    
    if(!isset($passwordre) || strlen($passwordre) === 0 || $password !== $passwordre) //make sure password was re-entered and is the same as the original
    {
        $errors['passwordre'] = true;
    }
    
    if(count($errors)===0) //if no errors are encountered
    {
        $pdo = connectDB();
        $accounts = $pdo->prepare('SELECT * FROM Users;'); //grab all the currently existing usernames
        $accounts->execute();
        foreach($accounts as $row) //check through all existing accounts
        {
            if ($username == $row['username']) //if the given username is the same as one already in the database
            {
                $errors['uniqueUser'] = true; //username is already in use
            }
            if ($email == $row['email'])
            {
                $errors['uniqueEmail'] = true; //email is already in use
            }
        }

        if(count($errors)===0) //check if there are still no errors
        {
            $createAccount = $pdo->prepare('INSERT INTO Users values (NULL, ?, ?, ?, ?, ?,?,?,?,?);'); //prepare to create the account
            $createAccount->execute([$username, password_hash($password, PASSWORD_BCRYPT) , $email, $fname, $lname,$university,$major,$date_start,$date_end]); //execute the account creation query
            header("Location: login.php");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Create Account&colon; UniInfo</title>
        <link rel="stylesheet" href="styles/project_master.css" />
    </head>
    <body>
        <main>
            <h2> Create Account </h2>
                <form id="create" name="create" method="post" novalidate>
                    <div>
                        <label for="fname">First Name</label>
                        <input type="text" name="fname" id="fname" placeholder="Enter your first name here" value="" required />
                         <span class="error <?=!isset($errors['fname']) ? 'hidden' : "";?>">Please enter your First name</span>
                    </div>
                    <div>
                        <label for="lname">Last Name</label>
                        <input type="text" name="lname" id="lname" placeholder="Enter your last name here" value="" required />
                        <span class="error <?=!isset($errors['lname']) ? 'hidden' : "";?>">Please enter your Last name</span>
                    </div>
                    <div>
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" placeholder="someone@something.com" value="" required />
                        <span class="error">Please enter a correct email</span>
                        <span class="error <?=!isset($errors['email']) ? 'hidden' : "";?>">Email already in use</span>
                    </div>

                    <div>
                        <label for="university">University/School</label>
                        <input type="text" name="university" id="university" placeholder="Enter your current University/Schools name here" value="" required />
                        <span class="error <?=!isset($errors['university']) ? 'hidden' : "";?>">Please enter your current university/school name</span>
                    </div>
                    <div>
                        <label for="major">Major</label>
                        <input type="text" name="major" id="major" placeholder="Enter your major here" value="" required />
                        <span class="error <?=!isset($errors['major']) ? 'hidden' : "";?>">Please enter a major</span>
                    </div>

                    <div>
                        <label for="start_date">Date of Starting School</label>
                        <input type="date" name="date_start" id="date_start" placeholder="Enter your date of beginning university/school here" value="" required />
                        <span class="error <?=!isset($errors['date_start']) ? 'hidden' : "";?>">Please enter a date of starting school</span>
                    </div>

                    <div> 
                        <label for="date_graduation">Date of Graduation/Expected Date of Graduation</label>
                        <input type="date" name="date_end" id="date_end" placeholder="Enter your date of  ending university/school here" value="" required />
                        <span class="error <?=!isset($errors['date_end']) ? 'hidden' : "";?>">Please enter a date of graduation or expected for graduation</span>
                    </div>

                    <div>
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" placeholder="Enter your username here" value="" required />
                        <span class="error <?=!isset($errors['username']) ? 'hidden' : "";?>">Enter your username here</span>
                        <span class="error <?=!isset($errors['uniqueEmail']) ? 'hidden' : "";?>">Username already taken</span>
                    </div>
                    <!-- Password input -->
                    <div>
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" placeholder="Enter your password here" value="" required />
                        <span class="error <?=!isset($errors['password']) ? 'hidden' : "";?>">Please enter a password</span>
                    </div>
 
                    <!-- Re-entering Password -->
                    <div>
                    <label for="passwordre">Re-enter Password</label>
                    <input type="password" name="passwordre" id="passwordre" placeholder="Re-enter password here" value="" required />
                    <span class="error <?=!isset($errors['passowrdre']) ? 'hidden' : "";?>">Passwords do not match!</span>
                    </div>



                    <!-- Confirming Terms and Conditions -->
                    <div id="checkbox">
                    <input type="checkbox" name="agree" id="agree" value="Y" required />
                    <label for="agree">I have read and accepted the <a href="termsandconditions.html">Terms and Conditions</a>
                    </label>
                    <span class="error <?=!isset($errors['agree']) ? 'hidden' : "";?>">You must agree to the terms</span>
                    </div>

                    <div id="buttons">    
                    <button type="submit" name="submit">Create Account</button>
                    </div>
                    </form>
        </main>
    </body>
</html>

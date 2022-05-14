<?php

$pdo = connectDB();

$query = "SELECT * FROM University"; //select the row of the table with the given username
$getuni = $pdo->prepare($query); //prepare that query

$queryrank = "SELECT * FROM University Order By rank LIMIT 10"; //select the row of the table with the given username
$unirank = $pdo->prepare($query); //prepare that query

$university = $_POST['uni'] ?? null;

if(isset($_POST['submit']))
{
    if(isset($university) || strlen($university) != 0)
    {

        $querys = "SELECT name FROM University WHERE code =?"; //select the row of the table with the given username
        $getuniname = $pdo->prepare($querys); //prepare that query
        $getuniname->execute([$university]); //execute
        $uniname = $getuni->fetch();

        header("Location: $uniname.php"); //redirect to the homepage

    }
}


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Login&colon; UniInfo </title>
        <link rel="stylesheet" href="styles/website_master.css" />
    </head>
    <body>
        <main>
            <p> Welcome to UniInfo! Here you can find all the information regrading all 22 Universities across Ontario. 
            <div>
                <p>The top 10 universities according to students based on their ranking are:</p>
                <ul>
                    <?php foreach($unirank as $unis): ?>
                    <li><a href = "<?php $unis['name']?>.php"><?=$unis['name']?></a><?= "Location:$unis['Location'] "; ?> <a href=<?php $unis['maps']?>>See on google maps</a> <?php echo "Rank: $unis['rank']";?><li>
                    <?php endforeach; ?>
                </ul>

            </div>
            <form name="universityoption" method ="post" action="">
            <select name="uni" id="uni">
                <option value=""> Select a university</option>
                <?php 
                foreach($getuni as $uni):?>
                <option value = <?php $uni['code'] ?>> <?= $uni['name']; ?> </option>
                <?php endforeach ?>
            </select>
        </main>
    </body>
</html>

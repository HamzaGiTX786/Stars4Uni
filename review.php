<?php

$pdo = connectDB();

$query = "SELECT * FROM University"; //select the row of the table with the given username
$getuni = $pdo->prepare($query); //prepare that query

?> 

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Stars4Uni&colon; Leave a Review</title>
        <link rel="stylesheet" href="styles/master.css" />
        <script src="https://kit.fontawesome.com/aed2d98647.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <main>
            <h2> Leave a Review for your school </h2>
                <form id="create" name="create" method="post" novalidate>
                    <div>
                        <label for="university">University/School</label>
                        <select name="uni" id="uni">
                        <option value=""> Select a university</option>
                        <?php 
                            foreach($getuni as $uni):?>
                            <option value = <?php $uni['code'] ?>> <?= $uni['name']; ?> </option>
                            <?php endforeach ?>
                        </select>
                    </div> 

                    <div>
                        <label for="Overall">How do you rate the University on an Overall basis?</label>
                        <input type="radio" name="overall" id="overall" value="1"/>
                        <input type="radio" name="overall" id="overall" value="2"/>
                        <input type="radio" name="overall" id="overall" value="3"/>
                        <input type="radio" name="overall" id="overall" value="4"/>
                        <input type="radio" name="overall" id="overall" value="5"/>
                        <span class="error <?=!isset($errors['overall']) ? 'hidden' : "";?>">Please enter an Overall rating</span> 
                    </div>

                    <div>
                        <label for="Academic">How do you rate the University on an Academic basis?</label>
                        <input type="radio" name="academic" id="academic" value="1"/>
                        <input type="radio" name="academic" id="academic" value="2"/>
                        <input type="radio" name="academic" id="academic" value="3"/>
                        <input type="radio" name="academic" id="academic" value="4"/>'
                        <input type="radio" name="academic" id="academic" value="5"/>'
                        <span class="error <?=!isset($errors['academic']) ? 'hidden' : "";?>">Please enter an rating based on the university academics</span>
                    </div>

                    <div>
                    <label for="Faculty">How do you rate the University on a Faculty basis?</label>
                        <input type="radio" name="faculty" id="faculty" value="1"/>
                        <input type="radio" name="faculty" id="faculty" value="2"/>
                        <input type="radio" name="faculty" id="faculty" value="3"/>
                        <input type="radio" name="faculty" id="faculty" value="4"/>'
                        <input type="radio" name="faculty" id="faculty" value="5"/>'
                        <span class="error <?=!isset($errors['faculty']) ? 'hidden' : "";?>">Please enter an rating based on the university Faculty</span>
                    </div>

                    <div>
                    <label for="cost">How do you rate the University on how costly the school is?</label>
                        <input type="radio" name="cost" id="cost" value="1"/>
                        <input type="radio" name="cost" id="cost" value="2"/>
                        <input type="radio" name="cost" id="cost" value="3"/>
                        <input type="radio" name="cost" id="cost" value="4"/>'
                        <input type="radio" name="cost" id="cost" value="5"/>'
                        <span class="error <?=!isset($errors['cost']) ? 'hidden' : "";?>">Please enter an rating based on the university Cost</span>
                    </div>

                    <div>
                    <label for="Rez">How do you rate the University on its Residence and Housing Situation?</label>
                        <input type="radio" name="Rez" id="Rez" value="1"/>
                        <input type="radio" name="Rez" id="Rez" value="2"/>
                        <input type="radio" name="Rez" id="Rez" value="3"/>
                        <input type="radio" name="Rez" id="Rez" value="4"/>'
                        <input type="radio" name="Rez" id="Rez" value="5"/>'
                        <span class="error <?=!isset($errors['Rez']) ? 'hidden' : "";?>">Please enter an rating based on the university Residence and Housing</span>
                    </div>

                    <div>
                    <label for="supportAca">How do you rate the University on its Support Academically?</label>
                        <input type="radio" name="supportAca" id="supportAca" value="1"/>
                        <input type="radio" name="supportAca" id="supportAca" value="2"/>
                        <input type="radio" name="supportAca" id="supportAca" value="3"/>
                        <input type="radio" name="supportAca" id="supportAca" value="4"/>'
                        <input type="radio" name="supportAca" id="supportAca" value="5"/>'
                        <span class="error <?=!isset($errors['supportAca']) ? 'hidden' : "";?>">Please enter an rating based on the university's Support Academically</span>
                    </div>

                    <div>
                    <label for="supportmen">How do you rate the University on its Rebound/Mental health Support?</label>
                        <input type="radio" name="supportmen" id="supportmen" value="1"/>
                        <input type="radio" name="supportmen" id="supportmen" value="2"/>
                        <input type="radio" name="supportmen" id="supportmen" value="3"/>
                        <input type="radio" name="supportmen" id="supportmen" value="4"/>'
                        <input type="radio" name="supportmen" id="supportmen" value="5"/>'
                        <span class="error <?=!isset($errors['supportmen']) ? 'hidden' : "";?>">Please enter an rating based on the university's Rebound/Mental health Support</span>
                    </div>

                    <div>
                    <label for="dining">How do you rate the University on its Dining Plans, Cafes, and off-campus dining experience?</label>
                        <input type="radio" name="dining" id="dining" value="1"/>
                        <input type="radio" name="dining" id="dining" value="2"/>
                        <input type="radio" name="dining" id="dining" value="3"/>
                        <input type="radio" name="dining" id="dining" value="4"/>'
                        <input type="radio" name="dining" id="dining" value="5"/>'
                        <span class="error <?=!isset($errors['dining']) ? 'hidden' : "";?>">Please enter an rating based on the university's Dining Plans and Cafes</span>
                    </div>

                    <div>
                    <label for="club">How do you rate the University on its Clubs and Extra-curriculars?</label>
                        <input type="radio" name="club" id="club" value="1"/>
                        <input type="radio" name="club" id="club" value="2"/>
                        <input type="radio" name="club" id="club" value="3"/>
                        <input type="radio" name="club" id="club" value="4"/>'
                        <input type="radio" name="club" id="club" value="5"/>'
                        <span class="error <?=!isset($errors['club']) ? 'hidden' : "";?>">Please enter an rating based on the university's Clubs and Extra-curriculars</span>
                    </div>

                    <div>
                    <label for="city">How do you rate the city or town University?</label>
                        <input type="radio" name="city" id="city" value="1"/>
                        <input type="radio" name="city" id="city" value="2"/>
                        <input type="radio" name="city" id="city" value="3"/>
                        <input type="radio" name="city" id="city" value="4"/>'
                        <input type="radio" name="city" id="city" value="5"/>'
                        <span class="error <?=!isset($errors['city']) ? 'hidden' : "";?>">Please enter an rating based on where the university's is located</span>
                    </div>

                    <div>
                    <label for="party">How do you rate the University's Social/Party Life?</label>
                        <input type="radio" name="party" id="party" value="1"/>
                        <input type="radio" name="party" id="party" value="2"/>
                        <input type="radio" name="party" id="party" value="3"/>
                        <input type="radio" name="party" id="party" value="4"/>'
                        <input type="radio" name="party" id="party" value="5"/>'
                        <span class="error <?=!isset($errors['party']) ? 'hidden' : "";?>">Please enter an rating based on the university's Socail/Party life</span>
                    </div>

                    <div id="buttons">    
                    <button type="submit" name="submit">Submit Review</button>
                    </div>
                    </form>
        </main>
    </body>
</html>
<?php

echo "<p>GET:</p>";
var_dump($_GET);

echo "<p>POST:</p>";
var_dump($_POST);

?>
<!DOCTYPE html>
<html>
<head>
	<title>My First HTML Form</title>
</head>
<body>
    <h1>This site shows form examples<hr></h1>
    <h2>User Login</h2>
	<form method="POST" action="">
        <p>
            <label for="username">Username</label>
            <input id="username" name="username" type="text" placeholder="Enter Username">
        </p>
        <p>
            <label for="password">Password</label>
            <input id="password" name="password" type="password" placeholder="Enter Password">
        </p>
        <p>
            <button type="submit">Login</button>
        </p>
    </form>
    <h2>Compose E-mail</h2>
    <form method="POST" action="">
        <p>
            <label for="emailto">To</label>
            <input id="emailto" name="emailto" type="text" placeholder="Enter Recievers E-mail">
        </p>
        <p>
            <label for="usremail">From</label>
            <input id="usremail" name="usremail" type="text" placeholder="Enter E-mail">
        </p>
        <p>
            <label for="subject">Subject</label>
            <textarea id="subject" name="subject" rows="1" cols="30" placeholder="Enter Subject here"></textarea>

        </p> 
        <p>
            <label for="body">E-mail Body</label>
            <textarea id="body" name="body" rows="15" cols="100" placeholder="Enter E-mail Body here"></textarea>

        </p>   
        <p>
            <label for="retsent">
                <input type="checkbox" id="retsent" name="retsent" checked="checked">Send e-mail to self
            </label>
        <p>
            <button type="submit">Send</button>
        </p>
    </form>
    <h2>Multiple Choice Test</h2>
    <form method="POST" action="">
        <p>Question 1: What are the Stark's Words?</p>
            <label for="q1a">
                <input type="radio" id="q1a" name="q1" value="A Lannister always pays his debts.">A Lannister always pays his debts.
            </label>
            <label for="q1b">
                <input type="radio" id="q1b" name="q1" value="Ours is the fury.">Ours is the fury.
            </label>
            <label for="q1c">
                <input type="radio" id="q1c" name="q1" value="Winter is coming.">Winter is coming.
            </label>
            <label for="q1d">
                <input type="radio" id="q1d" name="q1" value="Growing strong.">Growing strong.
            </label>
        <p>Question 2: Whose nickname is "The Spider"?</p>
            <label for="q2a">
                <input type="radio" id="q2a" name="q2" value="Joffrey Baratheon">Joffrey Baratheon
            </label>
            <label for="q2b">
                <input type="radio" id="q2b" name="q2" value="Daenerys Targaryen">Daenerys Targaryen
            </label>
            <label for="q2c">
                <input type="radio" id="q2c" name="q2" value="Petyr Baelish">Petyr Baelish
            </label>
            <label for="q2d">
                <input type="radio" id="q2d" name="q2" value="Varys">Varys
            </label>
        <p>Question 3: Who is(are) the best player(s) of the Game of Thrones</p>
            <label for="q3a">
                <input type="checkbox" id="q3a" name="q3[]" value="Jon Snow">Jon Snow
            </label>
            <label for="q3b">
                <input type="checkbox" id="q3b" name="q3[]" value="Daenerys Targaryen">Daenerys Targaryen
            </label>
            <label for="q3c">
                <input type="checkbox" id="q3c" name="q3[]" value="Petyr Baelish">Petyr Baelish
            </label>
            <label for="q3d">
                <input type="checkbox" id="q3d" name="q3[]" value="Varys">Varys
            </label>
        <p>Question 4: Which character(s) would you most like to see killed off</p>
            <label for="q4">
                <select id="q4" name="q4[]" multiple>
                    <option value="Joffrey Baratheon">Joffrey Baratheon</option>
                    <option value="Daenerys Targaryen">Daenerys Targaryen</option>
                    <option value="Stannis Baratheon">Stannis Baratheon</option>
                    <option value="The Hound">The Hound</option>
                </select>
        <p>    
            <input type="submit">   
        </p>
        </form>
    <h2>Select Testing</h2>
    <form method="GET" action="">
        <p>Do you <strong>LOVE</strong> Game of Thrones?</p>
            <label for="yesno">well... do you?</label>
            <select id="yesno" name="yesno"> 
                <option value="0">no.</option>
                <option selected value="1">YES!</option>
            </select>
        <p>    
            <input type="submit">
        </p>
    </form>
</body>
</html>
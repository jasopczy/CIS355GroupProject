<?php

session_start();
include "/home/mjwalker/public_html/CRUDNewQuizReview.php";
include "/home/mjwalker/public_html/Functions.php";

$hostname = "localhost";
$username = "CIS355jldevin1";
$password = "Spirius666";
$dbname = "CIS355jldevin1";
$usertable = "lessons";

$mysqli = new mysqli($hostname, $username, $password, $dbname);
checkConnect($mysqli); // program dies if no connection
// ---------- if successful connection...
if ($mysqli) {
    // ---------- c. create table, if necessary -------------------------------
    //createTable($mysqli); 
    // ---------- d. initialize userSelection and $_POST variables ------------
    $userSelection = 0;
    $firstCall = 1; // first time program is called
    $EnteringReview = 2; // after user clicked InsertALesson button on list 
    $UpdatingReview = 3;
    $DeleteReview = 4;
    
    $userSelection = $firstCall; // assumes first call unless button was clicked
    if (isset($_POST['EnteringReview'])) { $userSelection = $EnteringReview; }
    if (isset($_POST['UpdatingReview'])) { $userSelection = $UpdatingReview; }
    if (isset($_POST['DeleteReview'])) { $userSelection = $DeleteReview; }
    
    switch ($userSelection):
        case $firstCall:
            $Quiz = $_SESSION['QuizID'];
            displayHTMLHead();
            if ($_SESSION['LoggedIn'] == TRUE) {
            showReview($mysqli, $Quiz);
            } else { echo "Please Login!"; }
            break;
        case $EnteringReview:
            displayHTMLHead();
            insertQuizReview($mysqli);
            header("Location: http://csis.svsu.edu/~mjwalker/Quizzes.php");
            break;
        case $UpdatingReview:
            displayHTMLHead();
            updateLessonReview($mysqli);
            header("Location: http://csis.svsu.edu/~mjwalker/Quizzes.php");
            break;
        case $DeleteReview:
            echo "Deleteeee";
            displayHTMLHead();
            DeletequizReview($mysqli);
            header("Location: http://csis.svsu.edu/~mjwalker/Quizzes.php");
            break;
    endswitch;
} // ---------- end if ---------- end main processing ---------- 
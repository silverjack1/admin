<?php
if ($_POST['submit']) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $phone = $_POST['phone'];
    if ($name == '' || $age == '' || $phone == '') {
        echo '<h2>Please fill all * mandatory fields.</h2>';
    }

    if ($q1 == '' || $q2 == '' || $q3 == '')
        $q1 = $_POST['q1'];
    $q2 = $_POST['q2'];
    $q3 = $_POST['q3'];


    if ($q1 == '' || $q2 == '' || $q3 == '') {
        echo '<h2>Please answer all questions.</h2>';
    } else {
        $score = 0;
        if ($q1 == 1) { // 1st option is correct
            $score++;
        }
        if ($q2 == 3) { // 3rd option is correct
            $score++;
        }
        if ($q3 == 2) { // 2nd option is correct
            $score++;
        }
        $score = $score    / 3 * 100;

        if ($score < 50) {
            echo '<h2>You need to score at least 50% to pass the exam.</h2>';
        } else {
            echo '<h2>You have passed the exam and scored ' . $score . '%.</h2>';
        }
    }
}

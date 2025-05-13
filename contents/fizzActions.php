<?php

$firstName = '';
$middleInitial = '';
$lastName = '';
$defaultWord = 'Fizz';
$countLimit = 111;
$word1 = 'Live';
$word2 = 'Blue';
$word3 = 'Orchid';
$num1 = 3;
$num2 = 5;
$num3 = 7;
$fizzOutput = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $firstName = $_POST['first-name'] ?? '';
    $middleInitial = $_POST['middle-initial'] ?? '';
    $lastName = $_POST['last-name'] ?? '';
    $defaultWord = $_POST['default-word'] ?? 'Fizz';
    $countLimit = $_POST['count'] ?? 111;
    $word1 = $_POST['word1'] ?? 'Fly';
    $word2 = $_POST['word2'] ?? 'Brave';
    $word3 = $_POST['word3'] ?? 'BANG';
    $num1 = $_POST['num1'] ?? 3;
    $num2 = $_POST['num2'] ?? 5;
    $num3 = $_POST['num3'] ?? 7;

    $fizzOutput = '';
    for ($i = 1; $i <= $countLimit; $i++) {
        $result = '';

        if ($i % $num1 === 0) $result .= $word1 . ' ';
        if ($i % $num2 === 0) $result .= $word2 . ' ';
        if ($i % $num3 === 0) $result .= $word3 . ' ';
        
        if (empty(trim($result))) {
            $result = $defaultWord;
        }

        $fizzOutput .= "<p>$i. " . trim($result) . "</p>";
    }
}

?>




<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="images/blueorchid.png?">
    <link rel="stylesheet" href="styles/default.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://lint.page/kit/880bd5.js" crossorigin="anonymous"></script>
    <title>
        <?php
            $page = $_GET['page'] ?? 'home';
            $pageTitle = [
                'home' => 'Home',
                'introduction' => 'Introduction',
                'contract' => 'Contract',
                'fizzbuzz' => 'FizzBuzz',
                'introductionForm' => 'Introduction Form',
                'budget' => 'BudgetApp',
                'login' => 'Login',
                'logout' => "Logout"
            ];

            $defaultTitle = "Brenda Oliveira's Blue Orchid « WEB250 »";

            echo $defaultTitle;
            if (array_key_exists($page, $pageTitle)) {
                echo " " . $pageTitle[$page];
            }
            ?>
    </title>
</head>
    
<body>
    <?php include 'components/header.php'; ?>
    <main>
        <?php
        $pageComponents = ['home', 'introduction', 'contract', 'fizzbuzz', 'introductionForm', 'budget', 'login','logout'];
        $page = $_GET['page'] ?? 'home';
        $protectedPages = ['budget'];

        if (in_array($page, $protectedPages) && !isset($_SESSION['user'])) {
            $page = 'login';
        }
        if (in_array($page, $pageComponents)) {
            include "contents/{$page}.php";
        } else {
            echo "<h2>Page not found</h2>";
        }
        ?>
    </main>
    
    <?php include 'components/footer.php'; ?>
</body>
</html>


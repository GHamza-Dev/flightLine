<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<?php

dump($data);
echo '</pre>';
?>
<body>
    <form action="<?= URLROOT.'user/login' ?>" method="post">
    <input type="email" name="email">
    <input type="password" name="passwd">
    <button>submit</button>
    </form>
</body>
</html>
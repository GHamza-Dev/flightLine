<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <h1>Welcome Home</h1>
    <form action="<?= URLROOT.'home'.DS.'testpost' ?>" method="post">
        <input type="text" name="test4">
        <input type="text" name="test3">
        <input type="text" name="test2">
        <input type="text" name="test1">
        <button>Submit</button>
    </form>
</body>
</html>
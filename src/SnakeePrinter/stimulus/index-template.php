<?php
$graphs ??= [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Snakee graphs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="application.ts" type="module"></script>
</head>
<body>
<div data-controller="snakee">
    <span data-snakee-target="name"></span>
    <div data-snakee-target="graph"><?= count($graphs) ?></div>
</div>
</body>
</html>


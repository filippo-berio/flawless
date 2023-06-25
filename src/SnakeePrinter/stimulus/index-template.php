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
<script>
</script>

<div>
    <div>You got <?= count($graphs) ?> graphs</div>
    <?php foreach ($graphs as $i => $graph) { ?>
<!--        <div data-controller="reveal graph"-->
        <?= 'Graph ' . $i + 1 ?>
        <hr>
        <div data-controller="graph"
             data-graph-graph-value="<?= htmlentities($graph) ?>"
        >
<!--            <button type="button" data-action="reveal#toggle">Graph --><?php //= $i + 1 ?><!--</button>-->
<!--            <div hidden data-reveal>-->
            <div data-graph-target="container"></div>
            <hr>
        </div>
    <?php } ?>
</div>
</body>
</html>

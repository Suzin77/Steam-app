<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PHP MVC skeleton</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- css -->
    <!-- Bootstrap-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <!--own css-->
    <link href="<?php echo URL; ?>public/css/style.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
    
    <!-- our JavaScript -->
    <script src="<?php echo URL; ?>public/js/application.js"></script>
</head>
<body>
<!-- header -->
<div class="container">
    <!-- Info -->
    <div class="where-are-we-box">        
        The green line is added via JavaScript (to show how to integrate JavaScript).
    </div>
    <h1></h1>
    <!-- demo image -->
    <h3>Demo image, to show usage of public/img folder</h3>
    <div>
        <img src="<?php echo URL; ?>public/img/demo-image.png" />
    </div>
    <!-- navigation -->
    <h3>Demo Navigation</h3>
    <div class="nav navigation">
        <ul>
            <!-- same like "home" or "home/index" -->
            <li class = "btn"><a href="<?php echo URL; ?>">home</a></li>
            <li class = "btn"><a href="<?php echo URL; ?>home/exampleone">exampleone</a></li>
            <li class = "btn"><a href="<?php echo URL; ?>home/exampletwo">exampletwo</a></li>
            <!-- "songs" and "songs/index" are the same -->
            <li class = "btn"><a href="<?php echo URL; ?>songs/">songs/index</a></li>
            <li class = "btn"><a href ="<?php echo URL; ?>steamusers/">steamusers/index</a></li>
            <li class = "btn"><a href ="<?php echo URL; ?>steamusers/search">steamusers/search</a></li>
        </ul>
    </div>
    <!-- simple div for javascript output, just to show how to integrate js into this MVC construct -->
    <h3>Demo JavaScript</h3>
    <div id="javascript-header-demo-box">
    </div>
</div>

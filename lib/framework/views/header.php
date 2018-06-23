<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $this->data['page_title']; ?></title>
    <!-- favicon 192x192 -->
    <link href="favicon.png" rel="icon" type="image/png" />
    <!-- meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo $this->data['description']; ?>" />
    <meta name="keywords" content="<?php echo $this->data['keywords']; ?>" />
    <meta name="robots" content="index, follow" />
    <!-- fonts: http://www.google.com/fonts -->
    <link href="//fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet" />
    <!-- javascript / analytics -->
    <script></script>
    <!-- stylesheets -->

    <!-- Bootstrap -->
    <link rel="stylesheet" href="bootstrap/bootstrap-material-design.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <!-- Other-->
    <link rel="stylesheet" href="css/styles.css" />
    <?php if (file_exists("css/$view.css")) echo "<link rel=\"stylesheet\" href=\"css/$view.css\" />"?>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand mb-0 h1" href="#">University</a>
    <ul class="navbar-nav flex-row ml-md-auto d-none d-md-flex">
        <?php if (isset($_SESSION['user'])) { ?>
            <li class="nav-item dropdown">
                <a class="nav-item nav-link dropdown-toggle mr-md-2" href="#" id="bd-versions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="text-info"><?php echo ucfirst($_SESSION['type']); ?></span>
                    <?php echo $_SESSION['user']; ?>
                    <div class="ripple-container"></div>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="bd-versions">
                    <a class="dropdown-item" href="logout">SIGN OUT</a>
                </div>
            </li>
        <?php } ?>
    </ul>
</nav>
<div class="container">


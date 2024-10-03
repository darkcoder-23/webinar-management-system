<?php
    session_start();
    if(!isset($_SESSION['name'])) {
        header("Location: ".$_SERVER['HTTP_ORIGIN']."/index.php");
    }
?>
<!doctype html>
<html lang="en">

<head>
    <title>Webinar Project<?php echo $page_name; ?></title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css?<?php echo date("l jS \of F Y h:i:s A"); ?>">
    <script type="text/javascript">
    var action = '';
    </script>
</head>
<body>
<header>
<?php if ( "Login Page" !== $page_name) { ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarExample01"
                aria-controls="navbarExample01" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarExample01">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="admin_list.php"><strong>User</strong></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="subscriber_list.php"><strong>Subscriber</strong></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="webinar_list.php"><strong>Webinar</strong></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="broadcast_list.php"><strong>Broadcast</strong></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="presenter_list.php"><strong>Presenter</strong></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="tags.php"><strong>Tags</strong></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="category_list.php"><strong>Category</strong></a>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" onclick="window.location.href = 'admin_profile.php';" style="margin-left : 1000px"><strong>Welcome<br><?php echo $_SESSION['name']?></strong></button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" onclick="window.location.href = 'logout.php';" style="margin-left : 30px"><strong>Logout</strong></button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<?php } ?>
    <div class="p-5 text-center bg-light">
        <h1 class="mb-3"> Webinar Admin Panel</h1>
        <h4 class="mb-3"><?php echo $page_name; ?></h4>
    </div>
</header>


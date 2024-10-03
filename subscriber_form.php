
<?php
    if(isset($_GET['call'])) {
        echo $_GET['call'];
    } 
    $page_name = 'Subscriber Form';
    include_once( 'templates/header.php' );
?>

<body>
    <div id ="display_response"></div>
    <div class="container">
        <div class="col-md-12">
            <form id="" name="" action="" method="">
                <div class="form-group">
                    <label class="required" for="en_name">
                        Subscriber Name
                    </label>
                    <input type="text" class="form-control" name="name" id="name">
                </div>
                <br>
                <div class="form-group">
                    <label class="required" for="en_slug">
                        Email
                    </label>
                    <input type="email" class="form-control" name="email" id="email">
                </div>
                <br>
                <div class="form-group">
                    <label for="required">
                        Username
                    </label>
                    <input type="text" class="form-control" name="username" id="username">
                </div>
                <br>
                <div class="form-group">
                    <label for="required">
                        Password
                    </label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                <br>
                <div style="text-align:center;">
                    <label class="form-group"></label>&emsp;
                        <input type="submit" name="submit" value="submit" >

                <div>
                
                <br>
            </form>
        </div>
    </div>
    <br>
    <br>
</body>

</script>

<?php 
include_once( 'templates/footer.php' );
?>
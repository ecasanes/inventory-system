<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"> <!--<![endif]-->
<head>
<meta charset="utf-8">
<meta name="author" content="ThemeFuse">
<meta name="keywords" content="">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Inventory System</title>

<?php include('includes/header-styles.php'); ?>
<?php include('includes/header-scripts.php'); ?>

<style>

    body{
        background:#393939 !important;
    }

    #login-form{
        border:5px solid #000;
        background-color:#f7f7f7;
        padding:10px 30px;
        margin-top:10%;
    }

    #login-form label{
        font-weight:bold;
        color:#000;
        font-size:16px;
    }

    #login-form .row{
        padding:10px 0;
    }

    #login-form h1{
        font-size:21px;
        color:#478fca!important;
        font-weight:normal;
        font-style:normal;
        text-align:center;
        border-bottom:1px solid #d5e3ef;
        margin-bottom:0px;
        padding-bottom:10px;
    }

    #login-form input[type="text"], #login-form input[type="password"]{
        background-color:#fff;
        border:1px solid rgb(181, 181, 181);

    }

    #login-form input[type="text"]:hover, #login-form input[type="password"]:hover{
        border:1px solid rgb(224, 57, 57);
    }

    #login-form input[type="submit"]{
        background-color: #3bbec0;
        font-size:28px;
        padding:5px 15px;
        border:1px solid #3bbec0;
        width:100%;
        color:#fff;
    }

</style>

</head>

    <body>

    <?php include('includes/views-config.php'); ?>

        <div class="body_wrap">
            <div class="container">

                <!-- content -->
                <div class="content " role="main">


                    <!-- row -->
                    <div class="row">
                        <div class="col-sm-5 col-xs-12 col-sm-offset-3">
                            <div id="login-form" class="boxed boxed-black">

                            <div class="row">
                                <div class="col-xs-12">
                                    <h1>Please Enter your Information</h1>
                                </div>
                            </div>

                                <form name='login_form' action='<?php echo $login; ?>' method='POST'>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <label for="username">Username:</label>
                                            <input type="text" name="username" value="" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <label for="password">Password:</label>
                                            <input type="password" name="password" value="" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <input type="submit" name="login" value="Login" />
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </body>

</html>
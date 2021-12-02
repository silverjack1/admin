<!DOCTYPE html>
<html>
    <head>
        <title>Selamat Datang</title>
        <meta charset="UTF-8">
		<meta name="ROBOTS" content="NOINDEX,NOFOLLOW,NOARCHIVE,NOODP,NOYDIR,NOSNIPPET">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="shortcut icon" href="<?php echo base_url("assets/images/favicon.ico"); ?>" type="image/x-icon">
        <link rel="stylesheet" href="<?php echo base_url("assets/login/css/uikit.min.css"); ?>" />
		<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
		<link rel="stylesheet" href="<?php echo base_url("assets/login/css/styles.css"); ?>" />
        <link rel="stylesheet" href="<?php echo base_url("assets/login/css/notyf.min.css"); ?>" />
        <script src="<?php echo base_url("assets/login/js/jquery.min.js"); ?>"></script>
        <script src="<?php echo base_url("assets/login/js/uikit.min.js"); ?>"></script>
		<script src="<?php echo base_url("assets/login/js/uikit-icons.min.js"); ?>"></script>
    </head>
    <body>
        <div uk-sticky="media: 960" class="uk-navbar-container tm-navbar-container uk-sticky uk-active" style="position: fixed; top: 0px; width: 1903px;">
            <div class="uk-container uk-container-expand">
                <nav uk-navbar>
                    <div class="uk-navbar-left">
                        <a href="<?php echo site_url('auth') ?>" class="uk-navbar-item uk-logo">
                            EDUKASI ONLINE
                        </a>
                    </div>
                </nav>
            </div>
        </div>
		
        <div class="content-background">
            <div class="uk-section-large">
                <div class="uk-container uk-container-large">
                    <div uk-grid class="uk-child-width-1-1@s uk-child-width-2-3@l">
                        <div class="uk-width-1-1@s uk-width-1-5@l uk-width-1-3@xl"></div>
                        <div class="uk-width-1-1@s uk-width-3-5@l uk-width-1-3@xl">
                            <div class="uk-card uk-card-default">
                                <div class="uk-card-header">
                                    LOGIN ADMIN
                                </div>
                                <div class="uk-card-body">
									<center>
                                        <img src="<?php echo base_url("assets/images/logo-admin.png"); ?>" width="100"><br><br>
                                    </center>
                                    <form action="<?php echo site_url("adm/validate_credential"); ?>" method="POST">
                                        <fieldset class="uk-fieldset">

                                            <div class="uk-margin">
                                                <div class="uk-position-relative">
                                                    <span class="uk-form-icon ion-android-person"></span>
                                                    <input type="text" name="txt_user_name" placeholder="Username" class="uk-input" autofocus="autofocus" required/>
                                                </div>
                                            </div>

                                            <div class="uk-margin">
                                                <div class="uk-position-relative">
                                                    <span class="uk-form-icon ion-locked"></span>
													<input type="password" class="uk-input" name="txt_user_password" placeholder="Password" required/>
                                                </div>
                                            </div>

                                            <div class="uk-margin">
												<input type="hidden" name="btn_login" value="btn_login">
                                                <button name="tombol_login" value="tombol_login" type="submit" class="uk-button uk-button-danger">Login</button>
                                            </div>

                                        </fieldset>
                                    </form>
									
                                </div>
                            </div>
                        </div>
                        <div class="uk-width-1-1@s uk-width-1-5@l uk-width-1-3@xl"></div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6 lt8"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7 lt8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8 lt8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> 
<html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="UTF-8" />
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->
        <title><?php echo $header;?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="author" content="Codrops" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url("application/views/css/main.css");?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url("application/views/css/demo.css");?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url("application/views/css/style.css");?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("application/views/css/animate-custom.css");?>" />
    </head>
    <body>
        <div class="container">
            
            <section>				
                <div id="container_demo" >
                    <div id="navigation2">
                        <div id="menulg"><?php require_once('/application/views/menu.php'); ?></div>
                    </div>
                    <a class="hiddenanchor" id="toregister"></a>
                    <a class="hiddenanchor" id="tologin"></a>
                    <div id="wrapper">
                        <div id="login" class="animate form">
                            <form  action="<?php echo base_url('login/send'); ?>" method="post" autocomplete="on"> 
                                <h1><?php echo lang("log_in"); ?></h1>
                                <h2><?php echo $baddata; ?></h2>
                                <p> 
                                    <label for="username" class="uname" data-icon="u" > <?php echo lang("loglogin"); ?> </label>
                                    <input id="username" name="username" required="required" type="text" placeholder="yourusername"/>
                                </p>
                                <p> 
                                    <label for="password" class="youpasswd" data-icon="p"> <?php echo lang("password"); ?> </label>
                                    <input id="password" name="password" required="required" type="password" placeholder="somepassword" /> 
                                </p>
                                <p class="login button"> 
                                    <input type="submit" value="<?php echo lang("login"); ?>" /> 
								</p>
                                <p class="change_link">
                                    <?php echo lang("nohave_acc"); ?>
                                    <a href="#toregister" class="to_register"><?php echo lang("createacc"); ?></a>
				</p>
                            </form>
                        </div>

                        <div id="register" class="animate form">
                            <form  action="mysuperscript.php" method="post" autocomplete="on"> 
                                <h1> <?php echo lang("r_register"); ?> </h1> 
                                <p> 
                                    <label for="usernamesignup" class="uname" data-icon="u"><?php echo lang("username"); ?></label>
                                    <input id="usernamesignup" name="usernamesignup" required="required" type="text" placeholder="yourusername" />
                                </p>
                                <p> 
                                    <label for="emailsignup" class="youmail" data-icon="e" ><?php echo lang("email"); ?></label>
                                    <input id="emailsignup" name="emailsignup" required="required" type="email" placeholder="yourmail@email.com"/> 
                                </p>
                                <p> 
                                    <label for="passwordsignup" class="youpasswd" data-icon="p"><?php echo lang("password"); ?></label>
                                    <input id="passwordsignup" name="passwordsignup" required="required" type="password" placeholder="password"/>
                                </p>
                                <p> 
                                    <label for="passwordsignup_confirm" class="youpasswd" data-icon="p"><?php echo lang("repassword"); ?></label>
                                    <input id="passwordsignup_confirm" name="passwordsignup_confirm" required="required" type="password" placeholder="password"/>
                                </p>
                                <p class="signin button"> 
                                        <input type="submit" value="<?php echo lang("register"); ?>"/> 
                                </p>
                                <p class="change_link">  
                                        <?php echo lang("have_acc"); ?>
                                        <a href="#tologin" class="to_register"> <?php echo lang("login"); ?> </a>
                                </p>
                            </form>
                        </div>
						
                    </div>
                </div>  
            </section>
        </div>
    </body>
</html>
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
        <link rel="stylesheet" type="text/css" href="<?php echo base_url("application/views/css/menu.css");?>" />
        <script src="<?php echo base_url("application/views/js/jquery-1.5.2.min.js");?>" type="text/javascript"></script>
        <script src="<?php echo base_url("application/views/js/iframesize.js");?>" type="text/javascript"></script>
        <script src="<?php echo base_url("application/views/js/hideshow.js");?>" type="text/javascript"></script>
     </head>
    <body>
        <div id="wrapper2">
            <section id="head">
                <header id="main"></header><nav id="main"><?php require_once('/application/views/menu.php'); ?></nav>
            </section>
                <section id="contentbg">
                    <article id="main">
                        <?php
                            if($accemails==false){
                                echo "<h4 class='alert_warning'>".lang('noaccemails').'</h4>';
                            }
                            else{
                                foreach ($accemails as $email){
                                            echo'<div class="toggleLinkDiv">'.$email->memail.'<a href="#" class="toggleLink"><br />'.lang('edit').'</a></div>
                                                <table class="droptable"><form action="demo_form.asp">
                                                        <tr><td>'.lang('email').':</td><td><input type="email" name="memail" required="required" value="'.$email->memail.'"/></td></tr>
                                                        <tr><td>'.lang('password').':</td><td><input type="password" name="mpassword" /></td></tr>
                                                        <tr><td>'.lang('repassword').':</td><td><input type="password" name="rempassword" /></td></tr>
                                                        <tr><td>'.lang('imapserv').':</td><td><input type="text" name="imapserv" required="required" value="'.$email->imapserv.'" /></td></tr>
                                                        <tr><td>'.lang('portimap').':</td><td><input type="number" name="portimap" min="0" max="65535" pattern="[0-9]{1,5}" required="required" value="'.$email->portimap.'" /></td></tr>
                                                        <tr><td>'.lang('smtpserv').':</td><td><input type="text" name="smtpserv" required="required" value="'.$email->smtpserv.'" /></td></tr>
                                                        <tr><td>'.lang('portsmtp').':</td><td><input type="number" name="portsmtp" min="0" max="65535" pattern="[0-9]{1,5}" required="required" value="'.$email->portsmtp.'" /></td></tr>
                                                        <tr><td><input class="button-link" type="submit" value="'.lang('delete').'"/><input class="button-link" type="submit" value="'.lang('edit').'"/></td><td><input type="hidden" value="'.$email->idemail.'"/></td></tr>
                                                        </form>
                                                </table>
                                                ';
                                    echo"<br />";
                                }
                            }
                            ?>
                     
                    </article>
                    <aside id="main">
                        <?php require_once('/application/views/menu_mail.php'); ?>
                    </aside>
                    <footer id="main"><?php echo lang("global_footer") ?></footer>
                </section>
            
        </div>
    </body>
</html>
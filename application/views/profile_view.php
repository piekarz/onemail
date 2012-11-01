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
        <link rel="stylesheet" type="text/css" href="<?php echo base_url("application/views/css/main.css");?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url("application/views/css/demo.css");?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url("application/views/css/style.css");?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url("application/views/css/menu.css");?>" />
        <script src="<?php echo base_url("application/views/js/jquery.js");?>" type="text/javascript"></script>
        <script src="<?php echo base_url("application/views/js/jquery-main.js");?>" type="text/javascript"></script>
     </head>
    <body>
        <div id="wrapper2">
            <section id="head">
                <header id="main"></header><nav id="main"><?php require_once('application/views/menu.php');                 ?>
                
                </nav>
            </section>
                <section id="contentbg">
                    <article id="main">
                        <?php
                        if($msg!==''){
                            echo '<h4 class="alert_warning">'.$msg.'</h4>';
                        }
                        if($success!==''){
                            echo '<h4 class="alert_success">'.$success.'</h4>';
                        }
                        ?>
                           <form method="post" action="<?php echo base_url('profile');?>">
                               <table class="addtable">
                                   <tr><th class="headth"><?php echo lang('profile'); ?></th><th></th></tr>
                                   <tr><td><?php echo lang('username'); ?></td><td><input type="text" value="<?php echo $user->login;?>" disabled="disabled" /></td></tr>
                                   <tr><td><?php echo lang('password'); ?></td><td><input type="password" name="password" required="required" /></td></tr>
                                   <tr><td><?php echo lang('repassword'); ?></td><td><input type="password" name="repassword" required="required" /></td></tr>
                                   <tr><td><?php echo lang('email'); ?></td><td><input type="email" name="email" required="required" value="<?php echo $user->email;?>"/></td></tr>
                                   <tr><td><?php echo lang('lang'); ?></td><td><select name="lang">
                                               <?php foreach($langlist as $lang){?>
                                               <option <?php if($lang==$this->session->userdata('lang'))echo'selected="selected"'; ?> > <?php echo$lang; ?></option>
                                               <?php } ?>
                                           <?php?>
                                               
                                   </select></td></tr>
                                   <tr><td><?php echo lang('regdate'); ?></td><td><input type="timestamp" disabled="disabled" value="<?php echo $user->regdate;?>"/></td></tr>
                                   <tr><td><input class="button-link" type="submit" name="edit" value="<?php echo lang('edit'); ?>"/></td><td></td></tr>
                               </table>
                           </form>
                        
                                                
                                                
                     
                    </article>
                    <aside id="main">
                        <?php require_once('application/views/menu_mail.php'); ?>
                    </aside>
                    <footer id="main"><?php echo lang("global_footer") ?></footer>
                </section>
            
        </div>
    </body>
</html>
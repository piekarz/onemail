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
        <script src="<?php echo base_url("application/views/js/jquery.textareaexpander.js");?>" type="text/javascript"></script>
    </head>
    <body>
        <div id="wrapper2">
            <section id="head">
                <header id="main"></header><nav id="main"><?php require_once('/application/views/menu.php'); ?></nav>
            </section>
                <section id="contentbg">
                    <article id="main">
                        <?php if(!isset($result)){
                                if(true==$selectedemail){ ?>
                            <form method="post" action="<?php echo base_url('write/send'); ?>">
                                <table class="write">
                                    <tr><td><?php echo lang('from'); ?>:</td><td><?php echo $email->memail;  ?></td></tr>
                                    <tr><td><?php echo lang('signature');?>:</td><td><input class="inputwrite" type="text" name="signature"/></td></tr>
                                    <tr><td><?php echo lang('recipment');?>:</td><td><input class="inputwrite" type="text" name="recipment"/></td></tr>
                                    <tr><td><?php echo lang('subject');?>:</td><td><input class="inputwrite" type="text" name="subject"/></td></tr>
                                    <tr><td colspan="2" >bbcode</td></tr>
                                    <tr><td colspan="2"><textarea type="text" class="writebody" name="body"></textarea></td></tr>
                                    <tr><td><input class="button-link" type="submit" name="send" value="<?php echo lang('send')?>"/></td><td></td></tr>
                                </table>
                            </form>
                        <? }else echo '<h4 class="alert_warning">'.lang('nochoose').'</h4>'; }
                        else{ 
                            if(1==$result)echo '<h4 class="alert_success">'.lang('emailsent').'</h4>';
                            else echo '<h4 class="alert_warning">'.lang('emailnotsent').'</h4>';
                        }?>
                        
                    </article>
                    <aside id="main">
                        <?php require_once('/application/views/menu_mail.php'); ?>
                    </aside>
                    <footer id="main"><?php echo lang("global_footer") ?></footer>
                </section>
            
        </div>
    </body>
</html>
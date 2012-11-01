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
        <script src="<?php echo base_url("application/views/js/iframesize.js");?>" type="text/javascript"></script>
        <script src="<?php echo base_url("application/views/js/jquery-main.js");?>" type="text/javascript"></script>
        <script src="<?php echo base_url("application/views/js/jquery.textareaexpander.js");?>" type="text/javascript"></script>
    </head>
    <body>
        <div id="wrapper2">
            <section id="head">
                <header id="main"></header><nav id="main"><?php require_once('application/views/menu.php'); ?></nav>
            </section>
                <section id="contentbg">
                    <article id="main">
                        <?php
                            if($email==null or $email==false){
                                echo '<h4 class="alert_error">'.lang('badmailid').'</h4>';
                            }else{ 

                                echo'<div class="emailshow">
                                    <input class="button-link-left" type="submit" value="'.lang('reply').'" />
                                    <input class="button-link-left" type="submit" value="'.lang('delete').'" /><br />    
                                
                                        <form method="post" action="'.base_url('write/send').'">
                                            <table class="reply">
                                                <tr><td>'.lang('from').':</td><td><input type="hidden" name="from" value="'.$this->session->userdata("selectedemail").'"/>'.$this->session->userdata("selectedemail").'</td></tr>
                                                <tr><td>'.lang('signature').':</td><td><input class="inputwrite" type="text" name="signature"/></td></tr>
                                                <tr><td>'.lang('recipment').':</td><td><input class="inputwrite" type="text" name="recipment" value="'.$email['sender'].'" /></td></tr>
                                                <tr><td>'.lang('subject').':</td><td><input class="inputwrite" type="text" name="subject" value="RE: '.$email['subject'].'" /></td></tr>
                                                <tr><td colspan="2" >bbcode</td></tr>
                                                <tr><td colspan="2"><textarea type="text" class="replybody" name="body"></textarea></td></tr>
                                                <tr><td><input class="button-link" type="submit" name="send" value="'.lang('send').'"/></td><td></td></tr>
                                            </table>
                                        </form>

                                <h4 class="subject"><span class="bold">'.lang("subject").': </span>'.$email['subject']."<br />".
                                '<span class="bold">'.lang('from').': </span>'.$email['sender']."<br />".
                                '<span class="bold">'.lang("recipment").': </span>'.$email['recipient']."<br />". 
                                '<span class="bold">'.lang("date").': </span>'.date('d-m-Y G:i',$email['date'])."<br />".
                                '</h4><br/><br />';
                                
                                
                                //Creating a file with email view:
                                $username=$this->session->userdata('username');
                                if ( ! write_file('./application/cache/'.$username.'.php', $email['body']))
                                    {
                                         echo 'Unable to write the file<br />';
                                    }
                                    else
                                    {
                                         echo'<iframe id="myframe" scrolling="no" marginwidth="0" marginheight="0" frameborder="0" vspace="0" hspace="0" style="overflow:visible; width:100%; display:none" src="'.base_url().'application/cache/'.$username.'.php'.'"></iframe>';
                                    }
                                    
                            //}
                                
                                echo'<h4 class="subject"><span class="bold">'.lang("attachments").': </span>';
                                if($email['attachments']!=null){
                                    foreach ($email['attachments'] as $attachments)
                                        echo$attachments.", ";                           
                                        }else echo lang('noattachments');
                                echo'</h4><br />
                                <input class="button-link-left" type="submit" value="'.lang('reply').'" />
                                <input class="button-link-left" type="submit" value="'.lang('delete').'" /> 
                                </div>';
                            }

                            ?>
                     
                    </article>
                    <aside id="main">
                        <?php require_once('application/views/menu_mail.php'); ?>
                    </aside>
                    <footer id="main"><?php echo lang("global_footer") ?></footer>
                </section>
            
        </div>
    </body>
</html>
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
    </head>
    <body>
        <div class="container">
            
            <section>				
                <div id="container_demo" >
                    <div id="navigation2">
                        <div id="menulg2"><?php require_once('/application/views/menu.php'); ?></div>
                    </div>
                    <div id="wrapper2">
			 <div id="rightcolumn">
                              overview!
                                <div class="clear"></div>

                         </div>
                         <div id=footer2>

                               <?php echo lang("global_footer") ?>		

                         </div>
                    </div>
                </div>  
            </section>
        </div>
    </body>
</html>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?php echo $header;?></title>
        <link rel="stylesheet" type="text/css" href="/mgr/application/views/main.css" />
    </head>

    <body>

       <!-- Begin Wrapper -->
       <div id="wrapper">

             <!-- Begin header -->
             <div id=header>


                     </div>
                     <!-- end header -->

                     <!-- Begin Navigation -->
             <div id="navigation">
                    <?php require_once('/application/views/menu.php'); ?>

               </div>
            <!-- end navigation -->

             <!-- Begin faux columns -->
                     <div id=faux>

                           <!-- Begin right column -->
                           <div id="rightcolumn">
                               <?php echo $baddata; ?>
                               <Br />
                               <taBle><tr><td><?php echo lang("loginn"); ?><td>
                               <?php echo form_open('login/send'); 
                               $data = array(
                                  'name'        => 'login',
                                  'id'          => 'login',
                                  'maxlength'   => '45',
                                  'size'        => '25',
                                  'style'       => 'width:150px',
                                );
                               echo form_input($data); ?></td>
                               <tr><td><?php echo lang("password"); ?>  <td>
                               <?php
                               $data = array(
                                  'name'        => 'password',
                                  'id'          => 'password',
                                  'maxlength'   => '100',
                                  'size'        => '25',
                                  'style'       => 'width:150px',
                                );
                               echo form_password($data);
                               ?>
                                   </td></tr></table><br />
                               <?php
                               echo form_submit('submit',lang("login"));
                               echo form_close();
                               ?>
            <div claSs="clear"></div>

                           </div>
                           <!-- end right column -->

             </div>	   
             <!-- end faux columns --> 

             <!-- Begin footer -->
             <div id="footer">

                   <?php echo lang("global_footer") ?>		

             </div>
                     <!-- end footer -->

       </div>
       <!-- end Wrapper -->
    </body>

</html>
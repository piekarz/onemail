<!DOCTYpE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?php echo $header;?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url("application/views/css/main.css");?>" />
    </head>


    <body>
       <!-- Begin Wrapper -->
       <div id=wrapper1>

             <!-- Begin header -->
             <div id=header>


                     </div>
                     <!-- End header -->

                     <!-- Begin Navigation -->
             <div id="navigation">
                    <?php require_once('/application/views/menu.php'); ?>

               </div>
            <!-- End navigation -->

             <!-- Begin Faux Columns -->
                     <div id="faux">

                           <!-- Begin Right Column -->
                           <div id="rightcolumn">
                               <?php echo lang("hello") ?>
                                <div class="clear"></div>

                           </div>
                           <!-- End Right Column -->

             </div>	   
             <!-- End Faux Columns --> 

             <!-- Begin Footer -->
             <div id=footer>

                   <?php echo lang("global_footer") ?>		

             </div>
                     <!-- End Footer -->

       </div>
       <!-- End Wrapper -->
    </body>
</html>

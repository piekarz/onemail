<!DOCTYpE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?php echo $header;?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url("application/views/css/main.css");?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url("application/views/css/menu.css");?>" />
    </head>


    <body>
       <!-- Begin Wrapper -->
       <div id=wrapper1>

             <!-- Begin header -->
             <header id="welcome">


                     </header>
                     <!-- End header -->

                     <!-- Begin Navigation -->
             <nav id="welcome">
                    <?php require_once('/application/views/menu.php'); ?>

               </nav>
            <!-- End navigation -->

    
            <div class="articletop"></div>
                           <!-- Begin Right Column -->
<article id="welcome">


<div class="col">
<img src="<?php echo base_url("application/views/images/graph.png");?>" width="61" height="40" alt="graph" class="imgright">
<h2>See the results</h2>
<p>Lorem ipsum dolor sit amet, 
consectetur adipiscing elit. 
Integer egestas purus bibendum 
neque aliquam ut posuere elit semper. Fusce sagittis pharetra eros, sit amet consequat sem mollis vitae. Mauris elit sapien, ultricies ac congue at, facilisis at metus. Maecenas imperdiet justo vel dolor eleifend id vulputate erat feugiat.  <a href="#">Read More</a></p>
</div>
<div class="col">
<img src="<?php echo base_url("application/views/images/flowchart.png");?>" width="62" height="39" alt="graph" class="imgright">
<h2>Easy to manage</h2>
<p>Lorem ipsum dolor sit amet, 
consectetur adipiscing elit. 
Integer egestas purus bibendum 
neque aliquam ut posuere elit semper. Fusce sagittis pharetra eros, sit amet consequat sem mollis vitae. Mauris elit sapien, ultricies ac congue at, facilisis at metus. Maecenas imperdiet justo vel dolor eleifend id vulputate erat feugiat.  <a href="#">Read More</a></p>

</div>
<div class="col">
<img src="<?php echo base_url("application/views/images/ok.png");?>" width="37" height="40" alt="graph" class="imgright">
<h2>Customer Support</h2>
<p>Lorem ipsum dolor sit amet, 
consectetur adipiscing elit. 
Integer egestas purus bibendum 
neque aliquam ut posuere elit semper. Fusce sagittis pharetra eros, sit amet consequat sem mollis vitae.  Mauris elit sapien, ultricies ac congue at, facilisis at metus. Maecenas imperdiet justo vel dolor eleifend id vulputate erat feugiat.  <a href="#">Read More</a></p>

</div>
<div class="clear"></div>

<div class="clear"></div>
</article>

             <!-- Begin Footer -->

                     <!-- End Footer -->

                      <footer id="welcome">

                   <?php echo lang("global_footer") ?>		

       </footer>
       </div>
      
       <!-- End Wrapper -->
    </body>
</html>

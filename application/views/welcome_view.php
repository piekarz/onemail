<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $header; $ajax = ajax();?></title>
<link rel="stylesheet" type="text/css" href="/mgr/application/views/main.css" />
</head>

<body>

   <!-- Begin Wrapper -->
   <div id="wrapper">
   
         <!-- Begin Header -->
         <div id="header">
		 		 
			   
		 </div>
		 <!-- End Header -->
		 
		 <!-- Begin Navigation -->
         <div id="navigation">
                <?php require_once('/application/views/menu.php'); ?>
			   
           </div>
        <!-- End navigation -->
		 
         <!-- Begin Faux Columns -->
		 <div id="faux">
		
		 
		       <!-- Begin Right Column -->
		       <div id="rightcolumn">
                           

	<div class="clear"></div>
				
		       </div>
		       <!-- End Right Column -->
			   
         </div>	   
         <!-- End Faux Columns --> 

         <!-- Begin Footer -->
         <div id="footer">
		       
               <?php echo lang("global_footer") ?>		

         </div>
		 <!-- End Footer -->
		 
   </div>
   <!-- End Wrapper -->
</body>
</html>

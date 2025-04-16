<?php
require 'config.php';
include("session2.php");
?>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
	
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">

    <script src="https://kit.fontawesome.com/6b20b1c14d.js" crossorigin="anonymous"></script>
	

	<title>MKCE Connect</title>
	
	<style>

        .header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background: linear-gradient(90deg, rgba(111,177,127,1) 0%, rgba(154,173,89,1) 100%);
            color: white;
            text-align: center;
            z-index: 999; /* To ensure it's above other content */
        }



	.footer {
   position: fixed;
   left: 0;
   bottom: 0;
   width: 100%;
   	background: linear-gradient(90deg, rgba(111,177,127,1) 0%, rgba(154,173,89,1) 100%);
   color: white;
   text-align: center;
}



	</style>
</head>
<body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
	<div class="container">
		<!--  SEARCH FORM -->
		<header class="header">
			
			<form class="search-bar">
				<input type="search-name" class="contact-search" id="search" name="search-area" placeholder="Search Name or Department" autocomplete="off">
			</form>
					<a href="logout2.php">	<i class="fas fa-power-off"></i></a>
		</header>
		<!--  CONTACT LIST -->
		<section class="contacts-library">
		<div>
<br><br><br><br><br>
</div>
<div class="diss" id="dis"></div>
			 <script type="text/javascript">
		
			 $(document).ready(function(){
				var input="none";
					$.ajax({
						 url : "search.php",
						 method:"POST",
						 data:{input:input},
						 success:function(data){
							 $("#dis").html(data);
						 } 
							  
					 });
				
				 $("#search").keyup(function(){
					 var input=$(this).val();
					 //alert(input);
					 $.ajax({
						 url : "search.php",
						 method:"POST",
						 data:{input:input},
						 success:function(data){
							 $("#dis").html(data);
						 } 
							  
					 });
					 						 
				 });
			 });
			 </script>
		</section>
<div>
<br><br><br><br>
</div>
	</div>






</body>

		<div class="footer">
			<p><b>Developed by K.Kalaiarasan - Head / TIH</b></p>
			<p><b>Maintained by TIH - MKCE</b></p>
		</div>
</html>

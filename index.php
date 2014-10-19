<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>Product-category-management</title>
<!–[if IE]> 
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script> 
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<![endif]–>
<script src="js/jsTool.js"></script>
<link rel="stylesheet" type="text/css" href="css/main.css" />
<?Php
include("ORM/orm.class.php"); 
include("ORM/product.class.php"); 
include("ORM/category.class.php"); 
?>
</head>
<body>
<?php
include "include/header.include.php";
?>
<?php 
	$iProduct = new Product();
?>
<div id="main">
	<aside id="left">
    <ul>
        <li><a  href="#" id="product" class="mg">Product Management</a></li>	
    	<li><a  href="#" id="category" class="mg">Category Management</a></li>
    </ul>   
    </aside>
	<section id="right">
    	<div class="right-top">
         <!--   <form action="_self" class="search">
                <input  type="text" name="name" />
                <button  type="submit">Find</button>
            </form> -->
            <span class="add-new"><a href="add.php" >Add new item</a></span>
         </div>
		 <div id="results"></div>
        <!-- <div class="pagination-bar">Here is the pagination:<?php// echo $iProduct->getPaginationBar(5,2,4);?></div>-->
		 <div id="test1">index test1</div>
    </section>
	
</div>
<footer>
<p>Return to top of page </p>
</footer>


</body>
</html>

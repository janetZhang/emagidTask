<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>Add items</title>
<?php 
	include "/ORM/orm.class.php";
	include "/ORM/product.class.php";
	include "/ORM/category.class.php";

?>
<!–[if IE]> 
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script> 
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<![endif]–>
<script src="js/jsTool.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.2.15/angular.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/main.css" />
</head>

<body>
<?php
include "include/header.include.php";
?>

<?php 
	$product;
	$category;
	$productName=$description=$price=$catgId='';
	if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Add new item
		echo $_POST['productName'].$_POST['price'];
		if(!empty($_POST['productName'])&& !is_null($_POST['price'])&& is_numeric($_POST['price'])){
			if(!empty($_POST['productId'])){
				$product = new Product($_POST['productId']);
			}
			else{
				$product = new Product();
			}
			
			$product->setProductName($_POST['productName']);
			$product->setDescription($_POST['description']);
			$product->setPrice($_POST['price']);
			$product->setCatgId($_POST['CategoryId']);	
			$product->save();	
			
		}else{
			echo ('ProductName or price parameter is null.');
		}
		if(!empty($_POST['categoryName'])){
			if(!empty($_POST['categoryId'])){
				$category = new Category($_POST['categoryId']);
			}
			else{
				$category = new Category();
			}
			$category->setCategoryName($_POST['categoryName']);
			$category->save();	
		}else{
			echo ('Category name is null.');
		}		
	}
	
	if ($_SERVER['REQUEST_METHOD'] == 'GET') {	//Edit 	item
		echo ("Get method");
		if(!empty($_GET['productId'])){
			$product= new Product($_GET['productId']);
			$productName = $product->getProductName();
			$description = $product->getDescription();
			$price = $product->getPrice();
			$catgId = $product->getCatgId();
			echo ("Edit product");			
		}
		if(!empty($_GET['categoryId'])){
			$category = new Category($_GET['categoryId']);
			$categoryName = $category->getCategoryName();
		}
	}
		
?>
<div id="main">
	<aside id="left">
    <ul>
        <li><a  href="index.php" id="product" class="a-mg">Product Management</a></li>	
    	<li><a  href="index.php" id="category" class="a-mg">Category Management</a></li>
    </ul>  
    </aside>
	<section id="right" >
        <div class="tabs"><span id="p-form">Product</span><span id="c-form"> Category </span></div>
         <div id="tab1" class="table-cont">
			<h1>Product form</h1>
			<form id="add-prodt" ng-app=""  ng-controller="validateCtrl1" name="pf1" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" novalidate>
				<input type="hidden" id="productId" value="">
			  Category:
			   <select name="CategoryId" >
					<option value="1">Bag</option>
					<option value="2" selected>Clothes</option>
					<option value="3" >Furniture</option>
				</select> <br>
			  Product name:
			  <span style="color:red">* </span><input type="text" name="productName" ng-model="productName" value="<?php echo $productName;?>" placeholder="Input product name" required> 
								<span style="color:red" ng-show="pf1.productName.$dirty && pf1.productName.$invalid">
								<span ng-show="pf1.productName.$error.required">Product name is required.</span>
								</span>          
			  <br>
			  <p>Description:</p> 
			  <textarea rows="4" cols="50" name="description" class="txt"><?php echo $description;?> </textarea><br>
			  Price: <span style="color:red">* </span><input type="number" name="price" ng-model="price" ng-maxlength="11" value="<?php echo $price;?>" required>
								<span style="color:red" ng-show="pf1.price.$dirty && pf1.price.$invalid">
								<span ng-show="pf1.price.$error.required">Price should be numeric.</span>
								</span>   
			  <br>
			  <input class="save-btn" type="submit" value="Save"  id="s1" ng-disabled="!pf1.$valid">
			</form>
         </div>
         
         
        <div id="tab2">
			<h1>Category form</h1>
			<form id="add-catg" ng-app="" ng-controller="validateCtrl2" name="cf2" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" novalidate>
			<input type="hidden" id="categoryId" value="">
			  Category name: <input type="text" name="categoryName" ng-model="categoryName" placeholder="Input category name" required>
								<span style="color:red" ng-show="cf2.categoryName.$dirty && cf2.categoryName.$invalid">
								<span ng-show="cf2.categoryName.$error.required">Category name is required.</span>
								</span>            
			  <input class="save-btn" type="submit" value="Save" id="s2" ng-disabled="!cf2.$valid">
			</form>
         </div>

        <script>
        function validateCtrl1($scope) {
		//$scope.productName = <?php echo $productName;?>;
		//$scope.price = <?php echo $price; ?>;
        }

        </script>         
    </section>
</div>
<footer>
<p>Return to top of page </p>
</footer>


</body>
</html>
s

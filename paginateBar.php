<script src="js/jsTool.js"></script>
<?php
include("ORM/orm.class.php"); 
include("ORM/product.class.php"); 
include("ORM/category.class.php");

$instance; 
$b = true;
$barWidth = 3;
$item_per_page = 2; 

if(!empty($_POST["id"])){
	$id = $_POST["id"];
	if($id=="mg-product"){
		$instance = new Product();
		$b = true;
		echo 'product id';
	}
	if($id=="mg-category"){
		$instance = new Category();
		echo 'category id';
		$b = false;
	}
}else{
		$instance = new Product();
		$b = true;
}
if(!empty($_GET['productId'])){
		$instance = new Product($_GET['productId']);
		$instance->__destory();
		$b = true;
}
if(!empty($_GET['categoryId'])){
		$instance = new Product($_GET['categoryId']);
		$instance->__destory();
		$b = false;
}
//sanitize post value
$page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
//validate page number is really numaric
if(!is_numeric($page_number)){die('Invalid page number!');}

//get current starting point of records
$position = ($page_number * $item_per_page);
//echo $position;

//output product results by ids
//print_r($instance->getPageIdResults($position,$item_per_page));
$idList = $instance->getPageIdResults($position,$item_per_page);

?>
Here is the pagination:<?php //echo $instance->getPaginationBar1($item_per_page);?>
<div id="test">it is a test div  in pagination</div>
<div class="pagination-bar">Here is the pagination:<?php echo $instance->getPaginationBar(5,2,$page_number);?></div>

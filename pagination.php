<script src="js/bar.js"></script>
<?php
include("ORM/orm.class.php"); 
include("ORM/product.class.php"); 
include("ORM/category.class.php");

$instance;
$type ="product"; 
$barWidth = 3;
$item_per_page = 2; 

if(!empty($_POST["type"])){
	$type = $_POST["type"];
	if($type=="product"){
		if(!empty($_POST["id"])){
			$instanceDel = new Product($_POST["id"]);
			if($instanceDel->__destory())
				;
			//echo "delete id :".$_POST["id"];
		}
		$instance = new Product();//Product::getInstance();
	}
	if($type=="category"){
		if(!empty($_POST["id"])){
			$instanceDel = new Category($_POST["id"]);
			$instanceDel->__destory();
		}		
		$instance = Category::getInstance();
	}
}else{
	$instance = new Product();//Product::getInstance();
}
//sanitize post value
$page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
//validate page number is really numaric
if(!is_numeric($page_number)){die('Invalid page number!');}

	//get current starting point of records
	$position = ($page_number * $item_per_page);
	echo "pageNumer ".$page_number." position". $position;
	
	//output product results by ids
	$idList = $instance->getPageIdResults($position,$item_per_page);

	echo '<table id="result" >';

if($type=="product"){
	echo '<caption>Products list</caption>
			<tr >
				<th width="5%"><input type="checkbox"  name="all" id="all"></th>
				<th width="20%">Name</th>
				<th width="40%">Description</th>
				<th width="15%">Price</th>				
				<th width="10%">Edit</th>  
				<th width="10%">Delete</th>              
			</tr>';
	$trs;
	if(isset($idList)){
		foreach($idList as $key => $value){		
			$instance = new Product($value);
			  $trs='<tr class="product">
					<td ><input type="checkbox" value="'.$value.'"></td>
					<td >'.$instance->getProductId().'</td>
					<td >'.$instance->getDescription().'</td>
					<td >'.$instance->getPrice().'</td>
					<td ><a href="add.php?productId='.$instance->getProductId().'" >Edit</a></td>
					<td ><a href="#" class="delete" id="product-'.$instance->getProductId().'-'.($page_number+1).'" >delect</a></td>
				</tr>';
			echo $trs;
		}
	}			
}else{
	echo '<caption>Categories list</caption>
			<tr >
				<th width="5%"><input type="checkbox"  name="all" id="all"></th>
				<th width="20%">Name</th>				
				<th width="10%">Edit</th>  
				<th width="10%">Delete</th>              
			</tr>';
	$trs;
	if(isset($idList)){
		foreach($idList as $key => $value){		
			$instance = new Category($value);
			  $trs='<tr class="product">
					<td ><input type="checkbox" value="'.$value.'"></td>
					<td >'.$instance->getCategoryName().'</td>
					<td ><a href="#" >Edit</a></td>
					<td ><a href="#" class="delete" id="category-'.$instance->getCategoryId().'-'.($page_number+1).'" >delect</a></td>
				</tr>';
			echo $trs;
		}
	}
//($barWidth,$item_per_page,$page_number)
}
echo     '</table>';


?>
<div id="test">it is a test div  in pagination</div>
<div class="pagination-bar">Here is the pagination:<?php echo $instance->getPaginationBar(5,2,$page_number+1,$type);?></div>


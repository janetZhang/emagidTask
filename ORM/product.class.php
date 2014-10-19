<?php
class Product extends Model{
	protected $productId;
	protected $productName;
	protected $description;
/*	protected $picture;	
	protected $createDate;*/
	protected $price;	
	protected $catgId;
	
	private $tableName ='products';
	private $pkName ='productId';
	private $relationMap;
	public $instance ;
	
	public static function getInstanceById($id){
		$instance = new Product($id);
		return $instance;
	}
	public static function getInstance(){
		$instance = new Product();
		return $instance;
	}
	
	public function getProductId(){
		return $this->getMember('productId');
	 }
	Public function setProductId($id){
		$this->productId = $id;
		$this->setMember('productId',$id);
	 }
	public function getProductName(){
		return $this->getMember('productName');
	 }
	Public function setProductName($name){
		$this->productName = $name;
		$this->setMember('productName',$name);
	 }
	public function getDescription(){
		return $this->getMember('description');
	 }
	Public function setDescription($description){
		$this->description= $description;
		$this->setMember('description',$description);
	 }
	 /*
	public function getPicture(){
		return $this->getMember('picture');
	 }
	Public function setPicture($picture){
		$this->picture = $picture;
		$this->setMember('picture',$picture);
	 }		  
	public function getCreateTime(){
		return $this->getMember('createTime');
	 }
	Public function setCreateTime($time){
		$this->createTime = $time;
		$this->setMember('createTime',$time);
	 }*/
	public function getPrice(){
		return $this->getMember('price');
	 }
	Public function setPrice($price){
		$this->price = $price;
		$this->setMember('price',$price);
	 }		 
	public function getCatgId(){
		return $this->getMember('catgId');
	 }
	Public function setCatgId($catgId){
		$this->catgId = $catgId;
		$this->setMember('catgId',$catgId);
	 }
	 
    protected  function getTableName(){
        return $this->tableName;
    }
	protected  function getPkName(){
        return $this->pkName;
    }
    protected function getRelationMap(){
        return array( 
                      'productId' => $this->productId,
                      'productName'=> $this->productName,
 /*                   'picture'=> $this->picture,	
                      'createTime' => $this->createTime,
                      */
					  'description' => $this->description,					  
                      'price'=> $this->price,
                      'catgId'=> $this->catgId					  
                    );
    }

}

/*	$product = new Product();
//	$product = Product::getInstanceById(20);
	$product->setProductName("productName1");
	$product->setDescription("setDescription1");
	$product->setPrice(123);
	$product->setCatgId(21);
//	$product->getPrice();
//	$product->getDescription();
//	$product->__destory();
//	$product->prepareModel();
/*	if($product->save()){
		echo ('Save done');
		}else{
		echo ('Save fail');
		}*/
	//echo ($product->getCategoryId());
	//print_r($product);

?>

<?php


class Category extends Model{
	protected $categoryId;
	protected $categoryName;
	protected $tableName ='categories';
	protected $pkName ='categoryId';
	protected $relationMap;
	public $instance ;
	
	public static function getInstanceById($id){
		$instance = new Category($id);
		return $instance;
	}
	public static function getInstance(){
		$instance = new Category();
		return $instance;
	}
	
	public function getCategoryId(){
		return $this->getMember('categoryId');
	 }
	Public function setCategoryId($id){
		$this->categoryId = $id;
		$this->setMember('categoryId',$this->categoryId);
	 }
	public function getCategoryName(){
		return $this->getMember('categoryName');
	 }
	Public function setCategoryName($name){
		$this->categoryName = $name;
		$this->setMember('categoryName',$this->categoryName);
	 }
	
    protected  function getTableName(){
        return $this->tableName;
    }
	protected  function getPkName(){
        return $this->pkName;
    }
    protected function getRelationMap(){
        return array( 
                      'categoryId' => $this->categoryId,
                      'categoryName'=> $this->categoryName
                    );
    }
	public function __destory(){
		if(parent::__destory()){
			echo ('Deleting is done');
			return true;
		}else{
			echo ('This category already contains products, it can not be deleted');
			return false;
			}	
	}

}

	//$catg = new Category();
//	$catg = Category::getInstanceById(20);
	//$catg->setCategoryId('');
//	$catg->setCategoryName("test9->22");
//	$catg->getCategoryName();
//	$catg->__destory();
//	$catg->prepareModel();
//	$catg->save();
/*
	if($catg->__destory()){
		echo ('Deleting is done');
	}else{
		echo ('This category already contains products, it can not be deleted');
		}
*/
	//echo ($catg->getCategoryId());
	//print_r($catg);

?>

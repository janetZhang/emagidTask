<?php
abstract class Model{
   private $pk = null;
   private $_ID = null; 
   private $_tableName;
   private $_arRelationMap;
   private $_modifyMap;
   private $is_load = false;
   private $_DB;
   private $instance;

   public function __construct($id = null){
       $this->_DB = new PDO("mysql:host=localhost;dbname=emagid_task", "root", "123");
		if(!$this->_DB){
		die("Can't connect to database");
		}
       $this->_tableName = $this->getTableName();  
	   $this->pk = $this->getPkName();	   
	   $this->_arRelationMap = $this->getRelationMap();	   
       if(isset($id))$this->_ID = $id;
   }
   abstract protected function getTableName();
   abstract protected function getPkName();
   abstract protected function getRelationMap();
	

   public function Load(){
       if(isset($this->_ID)){
           $sql = "SELECT ";
		   $sql2 = '';
           foreach($this->_arRelationMap as $k => $v){
               $sql2 .= "`".$k."`,";
           }
		   $sql .= $sql2;
           $sql = substr($sql,0,strlen($sql)-1);
           $sql .= " FROM ".$this->_tableName." WHERE ".$this->pk." = ".$this->_ID;
		 //  echo ("---".$sql);
           $result =$this->_DB->query($sql);
		   // gets rows one at a time
		   while ($row = $result->fetch()) {
				//print_r($row);
			   foreach($row as $k1 => $v1){
			   //   $member = $this->_arRelationMap[$key];
				  if(property_exists($this,$k1)){
					 if(is_numeric($k1)){
						 eval('$this->'.$k1.' = '.$v1.';');
					 }else{
						 eval('$this->'.$k1.' = "'.$v1.'";');
					 }
				  }
			   }
		   }
		   
       }
       $this->is_load = true;
   }
      public function getPaginationBar1($item_per_page){
		$sql = "select count(*) from ".$this->getTableName();
		$result =$this->_DB->query($sql);
		while ($row = $result->fetch()) {
			foreach($row as $k1 => $totalRows){
				echo "total number".$totalRows;
			}
		}
		//break total records into pages
		$pages = ceil($totalRows/$item_per_page);   
		echo "total pages".$pages;
		$pagination = '';
		if($pages > 0)
		{
			$pagination .= '<ul>';	
			
			for($i = 1; $i<=$pages; $i++)
			{
				$pagination .= '<li><a href="#" class="paginate_click" id="'.$i.'-page">'.$i.'</a></li>';
			}
			
			$pagination .= '</ul>';
		}		
		return $pagination;
   }
   public function getPaginationBar($width,$item_per_page,$cur_page_number,$type){
		$sql = "select count(*) from ".$this->getTableName();
		$result =$this->_DB->query($sql);
		if(empty($type)){
			$type = "product";
		}
		if($width<=0){
			$width=1;
		}
		while ($row = $result->fetch()) {
			foreach($row as $k1 => $totalRows){
				echo "total number".$totalRows;
			}
			echo 'Have got total number';
		}
		//break total records into pages
		$pages = ceil($totalRows/$item_per_page);   
		$halfWidth = ceil($width/2)-1;
		echo "total pages".$pages." half pages".$halfWidth;
		$pagination = '';
		if($pages > 0)
		{
			$pagination .= '<ul>';
			$head = 1;
			$end = $pages;			
			
			if($pages>$width && $cur_page_number>$halfWidth){
				//$pages= $pages - $width;
				$head = $cur_page_number -$halfWidth;
				$tempEnd = $cur_page_number +$halfWidth;
			//	echo "cur page".$cur_page_number;
				if($tempEnd<$pages){
					$end = $tempEnd;
				}else{
					$end = $pages;
				}
				if($cur_page_number >$halfWidth&&$head>1){
				$pagination .= '<li><a href="#" class="paginate_click" id="'.($cur_page_number-1).'-'.$type.'-page">Previous</a></li>';
				}
			}else{
				if($pages<$width){
					$end = $pages;
				}else{
					$end = $width;
				}
			}
			
			for($i = $head; $i<=$end; ++$i)
			{
				$pagination .= '<li><a href="#" class="paginate_click" id="'.$i.'-'.$type.'-page">'.$i.'</a></li>';
			}
			if($pages>$width){
				$tempEnd = $cur_page_number +$halfWidth;
				if($tempEnd<$pages){
				$pagination .= '<li><a href="#" class="paginate_click" id="'.($cur_page_number+1).'-'.$type.'-page">Next</a></li>';
				}
			}			
			$pagination .= '</ul>';
		}		
		return $pagination;
   }
   public function  getPageResults($position,$item_per_page){
		$sql = "SELECT * FROM ".$this->getTableName()." ORDER BY ".$this->getPkName()." DESC LIMIT ".$item_per_page." OFFSET ".$position;
		$result =$this->_DB->query($sql);
		echo '<ul class="page_result">';
		while ($row = $result->fetch()) {
			echo '<li id="item_'.$row[$this->getPkName()].'">';
			foreach($row as $key=>$value){
			if(is_numeric($key)) continue;
			echo  '<span >'.$value.'</span>';
			}
			echo '</li>';		
		}
		echo '</ul>';
	}
   public function  getPageIdResults($position,$item_per_page){
		//echo 'getpageidResults'.$this->getTableName();
		$sql = "SELECT ".$this->getPkName()." FROM ".$this->getTableName()." ORDER BY ".$this->getPkName()." DESC LIMIT ".$item_per_page." OFFSET ".$position;
		$result =$this->_DB->query($sql);
		$idList = null;//=  new array();
		$i = 0;
		if(!empty($result)){
		while ($row = $result->fetch()) {
			foreach($row as $key=>$value){
			if(!is_numeric($key)) continue;
			 $idList[$i++]=$value;
			 echo $key;
			}	
		}
		}
		return $idList;
	}	
   public function setMember($key,$val){
		  $this->_arRelationMap[$key]=$val;
          $this->_modifyMap[$key] = 1;
   }
   
   public function getMember($key){
       if(!$this->is_load){
          $this->Load();
       }
     //  if(property_exists($this,$key)){
     //     eval('$res = $this->'.$key.';' );
		//	echo ("Get the member value ".$key.":".$this->$key);
          return $this->$key;
     ///  }
   }
/************************************************
****	If not specify id it will insert new object, or it will update the specific one.
************************************************/
   public function save(){
		  $sql_update = '';
		  $field='';
		  $values='';
		  $val ='';
		  $ptName;
		  $i = 0;

      if(isset($this->_ID)){
          $sql = "UPDATE ".$this->_tableName." SET ";
		  if($this->_modifyMap==null){
		    echo ('There is no change for the object to be done. ');
			return false;
		  }
          foreach($this->_arRelationMap as $k2 => $v2){
              if(array_key_exists( $k2, $this->_modifyMap)){
               //   eval( '$val = $this->'.$v2.';');
                  $sql_update .=  $k2." = '".$v2."' ";
              }
          }
          $sql .= substr($sql_update,0,strlen($sql_update));
          $sql .= " WHERE ".$this->pk." = ".$this->_ID;		
		  return  $this->_DB->query($sql);
      }else{
          $sql = "INSERT INTO ".$this->_tableName." (";
          foreach($this->_arRelationMap as $key => $value){
			$ptName[$i++]= $value;
			$field .= "`".$key."`,";
			$values .="?," ;		
          }
          $fields = substr($field,0,strlen($field)-1);
          $vals   = substr($values,0,strlen($values)-1);
          $sql .= $fields." ) VALUES (".$vals.")";
		   echo $sql;
		  return $this->_DB->prepare($sql)->execute($ptName);
      }
   }
   public function __destory(){
      if(isset($this->_ID)){
         $sql = "DELETE FROM ".$this->_tableName." WHERE ".$this->pk." = ".$this->_ID;
		 echo $sql;
         return $this->_DB->query($sql);
      }else{
		 return false;
	  }
   }
}

?>

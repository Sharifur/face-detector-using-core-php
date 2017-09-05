<?php
class Database{
	protected $DB;
	public $base64;
	public $Id;
	public function __Construct(){
		$this->DB = new mysqli("localhost","root","","facedetector"); // connect to database
		/*
		/// this is only for testing the database connection
		if(mysqli_connect_errno()){
			echo "connection Failed";
		}else{
			echo "Connection Success..";
		}
		*/
	}
	protected final function Filter($data){
		//filter for unwanted charecter
		return strip_tags(trim(mysqli_real_escape_string($this->DB, $data)));
	}

	public function Edit($id){
		$sql = "Select * from data where id='".$this->Filter($id)."'";
		$qdata =  $this->DB->query($sql);
		while($rdata = mysqli_fetch_object($qdata) ){
			$path = 'lib/img/photo-'.$id.'.'.$rdata->picture;
			$type = pathinfo($path, PATHINFO_EXTENSION);
			$data = file_get_contents($path);
			$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

			$result = array(
				'path' =>$path,
				'base64' =>$base64
				);
			return $result;
		}
	}
	public function Insert($table, $data){
		//for insert data into database
		$c=0;
		$sql="Insert into {$table} set ";
		foreach($data as $key=>$value){
			if($c>0){
				$sql .= ", ";
			}	
		$sql .= "{$key} ='". $this->Filter($value) ."' ";
		$c=1;
		}if($this->DB->query($sql)){
			$this->Id = $this->DB->insert_id;
			// $path = 'lib/img/photo-'.$id.'.'.$data->picture;
			// $type = pathinfo($path, PATHINFO_EXTENSION);
			// $data = file_get_contents($path);
			// $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
			echo "Insert Successful";
		}else{
			$this->DB->error;
		}
	}
	


}


?>
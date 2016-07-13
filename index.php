<?php
	include_once 'Classes/SiteController.php';
	
	$request = new Request();
	
	$app = new SiteController();
	$app->route($request);
	exit;
	
	?>
	/* EXAMPLE Ad-Hoc Model use */
	
	include_once("Classes/Model.php");
	
	$table    = "Users";
	$id       = "uID";
	
	$databaseModel = new Model($table, $id);

	
	//Create
	$createId  = $databaseModel->create(["data_field"=>"Some Value","data_field_2"=>1]);
	
	//Read
	$where    = ["data_field"=>"Some Value"];
	$entries  = $databaseModel->read($where);
	
	foreach($entries as $entry)
	{
		foreach($entry as $field -> $value)
		{
			echo "$field: $value";
		}
	}
	
	//Update
	$update     = ["data_field_2"=>"3"]; //update data_field_2 to 3
	$where      = ["id_field"=>$createId]; //where the id_field is $createId
	$databaseModel->update($update, $where);
	
	
	//Delete
	$databaseModel($where);
	
	//Count
	$count      = $databaseModel->count($where);
	





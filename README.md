# Barebones-MVC
A barebones MVC Framework

#Requirements
PHP 5.4
mysql, mySQLi, mysqlnd

#Setup

Coming Soon

#Description
This is a simple boilerplate MVC. Included are examples of a simple API and a simple login. Neither are full featured and are merely intended to demonstrate the framework.

#Using Models
Below is a brief introduction through examples of the datalayer. Ideally you would derive a custom model class instead like we did with the UserModel. Here you can perform custom queries outside of the usual CRUD operations in the ModelInterface.

Model classes will streamline data operations by making use of automatic prepared query generation. This has the added benefit of free sanitization, leaving just validation to the application developer.

Instead here, for the example, we create an ad-hoc Model as so:
```php
	include_once("Classes/Model.php");
	
	$table    = "Users";
	$id       = "uID";
	
	$databaseModel = new Model($table, $id);
```

Creating entries is easy. Simply pass in an array of key value pairs where each key is a field name and each pair is a value.
```php	
	//Create
	$createId  = $databaseModel->create(["data_field"=>"Some Value","data_field_2"=>1]);
```

Read them back is equally easy. Here we pass in a where clause checking for a data field to equal a particular value
```php
	//Read
	$entries  = $databaseModel->read(["data_field"=>"Some Value"]);
	
	foreach($entries as $entry)
	{
		foreach($entry as $field -> $value)
		{
			echo "$field: $value";
		}
	}
```

Update is slightly more complex requiring two key-value arrays, one for the values to update and one for the where clause.
```php
	//Update
	$update     = ["data_field_2"=>"3"]; //update data_field_2 to 3
	$where      = ["id_field"=>$createId]; //where the id_field is $createId
	$databaseModel->update($update, $where);
```

And delete, again, just a key-value array for the where clause.
```php
	//Delete
	$databaseModel($where);
	
	//Count
	$count      = $databaseModel->count($where);
```

Additionally, 'normal' prepared queries are able to be implemented within Models using $this->db>preparedQuery(...) and plain queries with $this->db->query($query). This allows for more fine grained detail on data operations while still encapsulating the SQL and data logic within the Model. It does risk coupling your application to SQL though, which is not the case when using the CRUD and ModelInterface functions.



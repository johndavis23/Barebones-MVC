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

<div class="info-box-body">
			<a name="method_detail"></a>

<a name="method__construct" id="__construct"><!-- --></a>
<div class="evenrow">
	
	<div class="method-header">
		<span class="method-title">Constructor __construct</span> (line <span class="line-number">44</span>)
	</div> 
	
	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Inserts a database entry using an array of values (ex: create(["account_id"=&gt;1, "name"=&gt;"John", "city"=&gt;"Knoxville"])).</p>
	
	<div class="method-signature">
		<span class="method-result">void</span>
		<span class="method-name">
			__construct
		</span>
					(<span class="var-type">$table</span>&nbsp;<span class="var-name">$table</span>, <span class="var-type">$id</span>&nbsp;<span class="var-name">$idField</span>, [<span class="var-type">$database</span>&nbsp;<span class="var-name">$database</span> = <span class="var-default">"default"</span>])
			</div>
	
			<ul class="parameters">
					<li>
				<span class="var-type">$table</span>
				<span class="var-name">$table</span><span class="var-description">: The name of your table</span>			</li>
					<li>
				<span class="var-type">$id</span>
				<span class="var-name">$idField</span><span class="var-description">: The name of your id field (usually your primary key)</span>			</li>
					<li>
				<span class="var-type">$database</span>
				<span class="var-name">$database</span><span class="var-description">: (optional) the name of the database in your config file</span>			</li>
				</ul>
		
			
	</div>
<a name="methodcount" id="count"><!-- --></a>
<div class="oddrow">
	
	<div class="method-header">
		<span class="method-title">count</span> (line <span class="line-number">179</span>)
	</div> 
	
	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Counts the entries satisfying the where conditions (ex: count(["Name"=&gt;"John"])).</p>
	<ul class="tags">
				<li><span class="field">access:</span> public</li>
			</ul>
	
	<div class="method-signature">
		<span class="method-result">int</span>
		<span class="method-name">
			count
		</span>
					(<span class="var-type">array</span>&nbsp;<span class="var-name">$where</span>)
			</div>
	
			<ul class="parameters">
					<li>
				<span class="var-type">$where</span>
				<span class="var-name">$where</span><span class="var-description">: an array containing the fields and values [$fieldName =&gt; $value, ...] Each entry represents " fieldName = value"</span>			</li>
				</ul>
		
			
	</div>
<a name="methodcreate" id="create"><!-- --></a>
<div class="evenrow">
	
	<div class="method-header">
		<span class="method-title">create</span> (line <span class="line-number">65</span>)
	</div> 
	
	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Inserts a database entry using an array of values (ex: create(["id"=&gt;1, "name"=&gt;"John", "city"=&gt;"Knoxville"])).</p>
	<ul class="tags">
				<li><span class="field">access:</span> public</li>
			</ul>
	
	<div class="method-signature">
		<span class="method-result">void</span>
		<span class="method-name">
			create
		</span>
					(<span class="var-type">array</span>&nbsp;<span class="var-name">$fieldValuePairs</span>)
			</div>
	
			<ul class="parameters">
					<li>
				<span class="var-type">$fieldValuePairs</span>
				<span class="var-name">$fieldValuePairs</span><span class="var-description">: an array containing the fields and values like this [$fieldName =&gt; $value, ...]</span>			</li>
				</ul>
		
			
	</div>
<a name="methoddelete" id="delete"><!-- --></a>
<div class="oddrow">
	
	<div class="method-header">
		<span class="method-title">delete</span> (line <span class="line-number">129</span>)
	</div> 
	
	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Deletes all database entries satisfying the where clause (ex: delete(["id"=&gt;1])).</p>
	<ul class="tags">
				<li><span class="field">access:</span> public</li>
			</ul>
	
	<div class="method-signature">
		<span class="method-result">void</span>
		<span class="method-name">
			delete
		</span>
					(<span class="var-type">array</span>&nbsp;<span class="var-name">$where</span>, [<span class="var-type">$limit</span>&nbsp;<span class="var-name">$limit</span> = <span class="var-default">null</span>])
			</div>
	
			<ul class="parameters">
					<li>
				<span class="var-type">$where</span>
				<span class="var-name">$where</span><span class="var-description">: an array containing the fields and values [$fieldName =&gt; $value, ...] Each entry represents " fieldName = value"</span>			</li>
					<li>
				<span class="var-type">$limit</span>
				<span class="var-name">$limit</span><span class="var-description">: (optional) if set, the max number of results to delete</span>			</li>
				</ul>
		
			
	</div>
<a name="methodexists" id="exists"><!-- --></a>
<div class="evenrow">
	
	<div class="method-header">
		<span class="method-title">exists</span> (line <span class="line-number">156</span>)
	</div> 
	
	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Checks if an entry exists using an array of name value pairs where each name is a field name and each value is (ex: exists(["id"=&gt;1])).</p>
	<ul class="tags">
				<li><span class="field">access:</span> public</li>
			</ul>
	
	<div class="method-signature">
		<span class="method-result">bool</span>
		<span class="method-name">
			exists
		</span>
					(<span class="var-type">array</span>&nbsp;<span class="var-name">$where</span>)
			</div>
	
			<ul class="parameters">
					<li>
				<span class="var-type">$where</span>
				<span class="var-name">$where</span><span class="var-description">: an array containing the fields and values [$fieldName =&gt; $value, ...] Each entry represents " fieldName = value"</span>			</li>
				</ul>
		
			
	</div>
<a name="methodgetIdField" id="getIdField"><!-- --></a>
<div class="oddrow">
	
	<div class="method-header">
		<span class="method-title">getIdField</span> (line <span class="line-number">275</span>)
	</div> 
	
	<!-- ========== Info from phpDoc block ========= -->
	<ul class="tags">
				<li><span class="field">access:</span> public</li>
			</ul>
	
	<div class="method-signature">
		<span class="method-result">void</span>
		<span class="method-name">
			getIdField
		</span>
				()
			</div>
	
		
			
	</div>
<a name="methodread" id="read"><!-- --></a>
<div class="evenrow">
	
	<div class="method-header">
		<span class="method-title">read</span> (line <span class="line-number">85</span>)
	</div> 
	
	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Returns all database entries that match the where clause (ex: read(["id"=&gt;1])). See also: readOffset</p>
	<ul class="tags">
				<li><span class="field">access:</span> public</li>
			</ul>
	
	<div class="method-signature">
		<span class="method-result">Array()</span>
		<span class="method-name">
			read
		</span>
					(<span class="var-type">array</span>&nbsp;<span class="var-name">$where</span>)
			</div>
	
			<ul class="parameters">
					<li>
				<span class="var-type">$where</span>
				<span class="var-name">$where</span><span class="var-description">: an array containing the fields and values [$fieldName =&gt; $value, ...] Each entry represents " fieldName = value"</span>			</li>
				</ul>
		
			
	</div>
<a name="methodreadAll" id="readAll"><!-- --></a>
<div class="oddrow">
	
	<div class="method-header">
		<span class="method-title">readAll</span> (line <span class="line-number">255</span>)
	</div> 
	
	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Returns all entries. Be careful, this could take a while!</p>
	<ul class="tags">
				<li><span class="field">access:</span> public</li>
			</ul>
	
	<div class="method-signature">
		<span class="method-result">array</span>
		<span class="method-name">
			readAll
		</span>
				()
			</div>
	
		
			
	</div>
<a name="methodreadAllIds" id="readAllIds"><!-- --></a>
<div class="evenrow">
	
	<div class="method-header">
		<span class="method-title">readAllIds</span> (line <span class="line-number">268</span>)
	</div> 
	
	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Returns all the ids for all entries.</p>
	<ul class="tags">
				<li><span class="field">access:</span> public</li>
			</ul>
	
	<div class="method-signature">
		<span class="method-result">array</span>
		<span class="method-name">
			readAllIds
		</span>
				()
			</div>
	
		
			
	</div>
<a name="methodreadOffset" id="readOffset"><!-- --></a>
<div class="oddrow">
	
	<div class="method-header">
		<span class="method-title">readOffset</span> (line <span class="line-number">199</span>)
	</div> 
	
	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Returns the entries using an offset and limit satisfying $where conditions  (ex: readOffset(["Name"=&gt;"John"], $pageSize, $currentPage * $pageSize) or readOffset(["Name"=&gt;"John", "City"=&gt;"Knoxville"]))</p>
	<ul class="tags">
				<li><span class="field">access:</span> public</li>
			</ul>
	
	<div class="method-signature">
		<span class="method-result">int</span>
		<span class="method-name">
			readOffset
		</span>
					(<span class="var-type">array</span>&nbsp;<span class="var-name">$where</span>, [<span class="var-type">$offset</span>&nbsp;<span class="var-name">$limit</span> = <span class="var-default">null</span>], [<span class="var-type">$limit</span>&nbsp;<span class="var-name">$offset</span> = <span class="var-default">null</span>])
			</div>
	
			<ul class="parameters">
					<li>
				<span class="var-type">$where</span>
				<span class="var-name">$where</span><span class="var-description">: an array containing the fields and values [$fieldName =&gt; $value, ...] Each entry represents " fieldName = value"</span>			</li>
					<li>
				<span class="var-type">$offset</span>
				<span class="var-name">$limit</span><span class="var-description">: (optional) an integer representing how many records to skip</span>			</li>
					<li>
				<span class="var-type">$limit</span>
				<span class="var-name">$offset</span><span class="var-description">: (optional) an integer representing the max number of results to return</span>			</li>
				</ul>
		
			
	</div>
<a name="methodreadWithID" id="readWithID"><!-- --></a>
<div class="evenrow">
	
	<div class="method-header">
		<span class="method-title">readWithID</span> (line <span class="line-number">244</span>)
	</div> 
	
	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Returns the entries that have matching ids.</p>
	<ul class="tags">
				<li><span class="field">access:</span> public</li>
			</ul>
	
	<div class="method-signature">
		<span class="method-result">array</span>
		<span class="method-name">
			readWithID
		</span>
					(<span class="var-type"></span>&nbsp;<span class="var-name">$id</span>)
			</div>
	
			<ul class="parameters">
					<li>
				<span class="var-type"></span>
				<span class="var-name">$id</span>			</li>
				</ul>
		
			
	</div>
<a name="methodupdate" id="update"><!-- --></a>
<div class="oddrow">
	
	<div class="method-header">
		<span class="method-title">update</span> (line <span class="line-number">105</span>)
	</div> 
	
	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Updates database entries that match the where clause with name value pairs (ex: update(["name"=&gt;"John","city"=&gt;"Knoxville"],["id"=&gt;1])).</p>
	<ul class="tags">
				<li><span class="field">access:</span> public</li>
			</ul>
	
	<div class="method-signature">
		<span class="method-result">void</span>
		<span class="method-name">
			update
		</span>
					(<span class="var-type">array</span>&nbsp;<span class="var-name">$update</span>, <span class="var-type">array</span>&nbsp;<span class="var-name">$where</span>)
			</div>
	
			<ul class="parameters">
					<li>
				<span class="var-type">$update</span>
				<span class="var-name">$update</span><span class="var-description">: an array containing the values and fields to set [$fieldName =&gt; $value, ...]</span>			</li>
					<li>
				<span class="var-type">$where</span>
				<span class="var-name">$where</span><span class="var-description">: an array containing the fields and values [$fieldName =&gt; $value, ...] Each entry represents " fieldName = value"</span>			</li>
				</ul>
		
			
	</div>
						
		</div>

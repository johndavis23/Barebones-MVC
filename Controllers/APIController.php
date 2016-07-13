<?php
/* A bare bones api controller.
 * Access like: index.php/API/User/ or index.php/API/User/5 
 * To add new models, simply add them to the 'validActions' field.
 * Supports PUT(create) GET(list or entry) POST(update) DELETE(delete)
 * 
 */

include_once "Classes/Controller.php";
include_once("Classes/Login.php");
include_once("Interfaces/Model.php");

class APIException extends Exception{};
class APIController extends Controller
{
	protected $validActions = ["User"]; //in our case the valid model names
	
	function __construct()
	{
		
		if (session_status() === PHP_SESSION_NONE)
		{
			session_start();
		}
		$this->login    = new Login();
	}
	
	function run(Request $request)
	{
		$this->serveAPICall($request);
		
	}
	

	function serveAPICall(Request $request) 
	{
		$model = $request->popNextParameter();
		if(!in_array($model, $this->validActions)) throw new APIException("Not A Valid Model To Select");
		
		//load our model dynamically based on the parameter, now that we know its whitelisted
		$model .= "Model";
		$model = new $model();
		
		if( ! ($model instanceof ModelInterface))
			throw new APIException("Invalid Model: Does not implement ModelInterface");
		
		
		$response;
		switch ($request->method) 
		{
		    case 'PUT': //create
		    
		        parse_str(file_get_contents("php://input"),$PUT);
		        $response = $model->create($PUT);
		        //no response from PUT
		        exit;
		        break;
		    
		    case 'GET'://read
				
				$id = $request->popNextParameter();
				
				if($id)
				{
		       	 	$response = $model->readWithId($id);
				}
				else 
				{
					$response = $model->readAllIds();
				}
				
		        break;
		    
		    case 'POST'://update
		        $response = $model->update([$model->getIdField() => $request->popNextParameter()], $_POST);
		        break;
		    
		    case 'DELETE'://delete
		        $response = $model->delete([$model->getIdField() => $request->popNextParameter()]);
		        break; 
		    
		    
		    default:
				throw new APIException("Invalid Method");
		        return;
		        break;
		}
		echo json_encode($response); 
	}
}

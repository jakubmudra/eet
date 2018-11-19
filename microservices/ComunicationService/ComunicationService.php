<?php
/**
 * Created by PhpStorm.
 * User: jakub2
 * Date: 19/11/2018
 * Time: 00:12
 */
require_once("AutoLoader.php");

class ComunicationService {

	public $Request;
	public $Response;
	public $TimeLimit;

	public function Process(array $request)
	{
		$this->Request = $request;

		$target = $this->Request["Target"];


		$methodsArray = get_class_methods($target);

		if(in_array($request["Body"]["function"], $methodsArray))
		{

			$this->Response = call_user_func([$target,$request["Body"]["function"]], $request["Body"]["data"]);
		}



		return $this->Response;
	}

}

if(!empty($_REQUEST["target"]) && !empty($_REQUEST["function"]) && !empty($_REQUEST["data"]) )
{
	$rq = [
		"ID" => uniqid(),
		"Author" => "",
		"Target" => $_REQUEST["target"],
		"Body" => [
			"function" => $_REQUEST["function"],
			"data" => [ "uuid" =>  $_REQUEST["uuid"] ],
		]
	];

	$d = new ComunicationService();
	echo "<html><pre>";
	print($d->Process($rq));
}else echo "Access Denied";

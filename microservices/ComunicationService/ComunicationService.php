<?php
/**
 * Created by PhpStorm.
 * User: jakub2
 * Date: 19/11/2018
 * Time: 00:12
 */

class ComunicationService {

	public $Request;
	public $Response;
	public $TimeLimit;

	public function Process(array $request)
	{
		$this->Request = $request;

		$target = $this->Request["Target"];

		switch ($target){
			case "ReceiptService":
				include "../ReceiptService/ReceiptAPI.php";
					$this->Response = ReceiptAPI::Process($request["Body"]);
				break;
			case "UUIDService":
				include "../UUIDService/UUIDAPI.php";
				$this->Response = UUIDAPI::Process($request["Body"]);
				break;
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
			"data" => [$_REQUEST["data"]],
		]
	];

	$d = new ComunicationService();
	echo "<html><pre>";
	print($d->Process($rq));
}else echo "Access Denied";

<?php
/**
 * Created by PhpStorm.
 * User: jakub2
 * Date: 19/11/2018
 * Time: 00:03
 */
include "ReceiptService.php";

class ReceiptAPI {

	public $Request;

	public static function Process(array $request) {

		$return = "";

		switch ($request["function"]){
			case "GetByID":
				$return = ReceiptService::GetByUUID($request["data"][0]);
				break;
			case "GetCount":
				$return = ReceiptService::GetCount();
				break;
			case "CreateReceipt":
				$return = ReceiptService::CreateReceipt();
				break;
		}

		return $return;
	}

}


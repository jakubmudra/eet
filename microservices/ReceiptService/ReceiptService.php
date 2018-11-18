<?php
/**
 * Created by PhpStorm.
 * User: jakub2
 * Date: 18/11/2018
 * Time: 23:44
 */
require "Receipt.php";

class ReceiptService {

	public function  __construct() {
		return true;
	}

	public static function GetByUUID(string $uuid)
	{
		try{
			self::validateUUID($uuid);
		}catch (Exception $e)
		{
			echo $e->getMessage();
		}

		return "Im Receipt";
	}

	public static function GetCount()
	{
		return 20;
	}

	public static function CreateReceipt()
	{
		$receipt = new Receipt();
		$cs = new ComunicationService();
		$request = ["ID" => uniqid(),"Author" => "ReceiptService", "Target" => "UUIDService", "Body" => [ "function" => "v4", "data" => [], ] ];
		$receipt->uuid_zpravy = $cs->Process($request);
		$receipt->celk_trzba = 320.20;
		$receipt->dat_trzby = new DateTime();
		return json_encode($receipt,JSON_PRETTY_PRINT);

	}

	private static function validateUUID(string $uuid)
	{
		if(!$uuid){
			throw new Exception("Invalid UUID");
		}else return true;

	}

}
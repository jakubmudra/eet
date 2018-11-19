<?php
/**
 * Created by PhpStorm.
 * User: jakub2
 * Date: 18/11/2018
 * Time: 23:44
 */
require "Receipt.php";

class ReceiptService {

	public function  __construct($input) {
		return true;
	}

	public static function GetByUUID($input)
	{
		$uuid = $input["uuid"];

		try{
			self::validateUUID($uuid);
		}catch (Exception $e)
		{
			echo $e->getMessage();
		}

		return self::parseToJson("Jsem tvoje Uctenka");
	}

	public static function GetCount($input)
	{
		return self::parseToJson("20");
	}

	public static function CreateReceipt($input)
	{
		$receipt = new Receipt();
		$cs = new ComunicationService();
		$request = ["ID" => uniqid(),"Author" => "ReceiptService", "Target" => "UUIDService", "Body" => [ "function" => "v4", "data" => [], ] ];
		$receipt->uuid_zpravy = $cs->Process($request);
		$receipt->celk_trzba = 320.20;
		$receipt->dat_trzby = new DateTime();
		return self::parseToJson($receipt);

	}

	private static function validateUUID($input)
	{
		$uuid = $input["uuid"];
		if(!$uuid){
			throw new Exception("Invalid UUID");
		}else return true;
	}

	private static function parseToJson($object)
	{
		return json_encode($object, JSON_PRETTY_PRINT);
	}

}
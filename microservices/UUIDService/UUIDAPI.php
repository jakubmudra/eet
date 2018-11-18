<?php
/**
 * Created by PhpStorm.
 * User: jakub2
 * Date: 19/11/2018
 * Time: 00:03
 */
include "UUIDService.php";

class UUIDAPI {

	public $Request;

	public static function Process(array $request) {

		$return = "";

		switch ($request["function"]){
			case "v4":
				$return = UUIDService::v4();
				break;
		}

		return $return;
	}

}


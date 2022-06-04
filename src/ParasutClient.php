<?php

namespace Scngnr\Parasut;
use Scngnr\Parasut\Helper\Gateway;

Class ParasutClient extends Gateway {

  /**
	 *
	 * @description N11 Api Key
	 * @param string $apiKey
	 *
	 */
	 public $apiKey;

	 public $apiSecret;

	 public function __construct($apiKey,$apiSecret)
	 {

		 		$this->apiKey = $apiKey;
				$this->apiSecret = $apiSecret;
	 }

	 /**
	 *
	 *@param
	 *
	 *
	 *
	 */

	 public function Auth(){

	 }
}

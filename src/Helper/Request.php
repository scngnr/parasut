<?php

namespace Scngnr\Mdent\Binance\Helper;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Scngnr\Mdent\Binance\BinanceClient;
use Scngnr\Mdent\Binance\Helper\Bnexception;

use Illuminate\Support\Facades\Http;
use \Datetime;

Class Request {

        /**
      *
      * Binance Api Url
      * @var string
      *
      */
      public  $baseUrl = "https://fapi.binance.com/fapi/";
      public $apiUrl;

      /**
       *
       * Binance ApiKey
       * @var string
       *
       */
      protected $apiKey;

      /**
       *
       * Binance apiSecret
       * @var string
       *
       */
      protected $apiSecret;

      /**
       *
       * Hazırlanan isteği apiye iletir ve yanıtı json olarak döner.
       *
       * @author Ismail Satilmis <ismaiil_0234@hotmail.com>
       * @param array $query
       * @param array $data
       * @param boolean $authorization
       * @return array
       *
       */
      public function getResponse(array $params , $apiUrl, $method, bool $signature = FALSE)
      {
        $response = Format::signature($params , $this->apiSecret, $signature);
        // dd($response);
        if($signature){
          $url = $this->baseUrl . $apiUrl . '?' . $response['query'] . '&signature=' . $response['params']['signature'];
        }else {
          $url = $this->baseUrl . $apiUrl . '?' . $response['query'];

        }


        $client = new Client();
        try {
          $response = $client->request($method, $url, [
            'headers' => [
                'Content-Type'    => 'application/json',
                'X-MBX-APIKEY'   => 'IUSTUlCe8f74A4F0gmx0OqXlbe3ZKDu7wg0eI6WQNxbzv1EAK8QgV8F4zhr1EpBe',
            ],
              ]);
        } catch (\Exception $e) {

        }

        $body = json_decode($response->getBody()->getContents(),true);
          return $body;
      }
}

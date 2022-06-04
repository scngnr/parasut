<?php

namespace Scngnr\Mdent\Binance\Helper;
use Scngnr\Mdent\Binance\BinanceClient;
use App\Models\Crypto;

Class Format
{
	/**
	 *
	 * UnixTime değerini milisaniye cinsine çevririr.
	 *
	 * @author Sercan güngör Scngnr@gmail.com
	 * @param int Binance Signature Oluştur
	 *
	 */

	public static function signature($params , $apiSecret, bool $signature) {

		$ts = (microtime(true) * 1000) +0;
    $params['timestamp'] = number_format($ts, 0, '.', '');

    $query = http_build_query($params, '', '&'); // rebuilding query
    $query = str_replace([ '%40' ], [ '@' ], $query);//if send data type "e-mail" then binance return: [Signature for this request is not valid.]
    $signature = hash_hmac('sha256', $query, $apiSecret);

		if ($signature) {
			$params['signature'] = $signature; // signature needs to be inside BODY
		}

		$query = http_build_query($params, '', '&'); // rebuilding query
		$response['query'] = $query;
		$response['params'] = $params;
		return $response;
	}

	/**
	*
	*	@param qytCalculate
	*
	*	Bu fonsiyon ile alim yapılacak coinin güncel değeri kontrol edilir
	*	Mevcut para ile ne kadar alınabilir.
	* hesaplanan değer geri döndürülür.
	*
	*/

	public static function qytCalculate($symbol){

		$client = new BinanceClient('IUSTUlCe8f74A4F0gmx0OqXlbe3ZKDu7wg0eI6WQNxbzv1EAK8QgV8F4zhr1EpBe', 'yO2rd9C88FQXaH6L7hbXvmksLwspYKbLrE5ACy2vzEz41v1CySPJ3RpGVjHcCU4I');
		//Cüzdandaki Bakiyemiz
		$wallet = $client->Margin->accountBalance();
		// Bakiyenin Nekadarını kullancağını seç
		$takeCoin = $wallet['availableBalance'] * 0.4;

		//Controlleri çağır
		$crypto = new \App\Http\Controllers\cryptoController();
		//Market Bilgilerini alıp veritabanına kaydet
		$crypto->index();

		//Veritabanından coin fiyatını al
		$cryptoPrice = Crypto::where('symbol', $symbol )->first();

		//Free balance 'i .40 i ile ne kadar alim yapilacağını hesapla
		//str_replace ile . karakerini , e çeviriyoruz.
		//Ceil fonkisyonu ile küsürat yuvarlama işlemi yapıyoruz.
		$alimTutari = str_replace('.',',',ceil($takeCoin / $cryptoPrice->markPrice));

		return $alimTutari;
	}
}

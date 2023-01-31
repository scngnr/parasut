<?php

namespace Scngnr\Mdent\FaturaEnt\Parasut\Http\Controllers;

use App\Models\Urunler;
use Illuminate\Http\Request;
use Automattic\WooCommerce\Client;
use Illuminate\Routing\Controller;
use Scngnr\Mdent\PriceService\Models\priceService;
use Illuminate\Support\Facades\Http;
use Scngnr\Mdent\FaturaEnt\Parasut\Models\Parasut;

class MusteriTedarikci extends Controller
{

  public function __construct(){

    public function __construct(){

      $parasut = Parasut::find(1);
      $this->parasutCompanyId = $parasut->firmaId;
      $this->access_token = $parasut->accessToken;

    }

  // Parasut sisteminde kayıtlı tüm ürünleri döndürür.
  public function index(){

    $endpoind = $this->baseEndPoint;

    $response = Http::withHeaders(
      [
        'Accept' => 'application/json',
        'Authorization' => 'Bearer '.$this->access_token,
      ])->get($endpoind);

      return $response->json();
  }


  public function create($array){

    $endpoind = $this->baseEndPoint;

    $response = Http::withHeaders(
      [
        'Accept' => 'application/json',
        'Authorization' => 'Bearer '.$this->access_token,
      ])->post($endpoind, $array);

      return $response->json();
  }

  public function show($id){

    $endpoind = $this->baseEndPoint . '/'. $id;

    $response = Http::withHeaders(
      [
        'Accept' => 'application/json',
        'Authorization' => 'Bearer '.$this->access_token,
      ])->get($endpoind);

      return $response->json();
  }


  public function edit($id){

    $endpoind = $this->baseEndPoint . '/'. $id;

    $response = Http::withHeaders(
      [
        'Accept' => 'application/json',
        'Authorization' => 'Bearer '.$this->access_token,
      ])->put($endpoind);

      return $response->json();
  }


  public function delete($id){

    $endpoind = $this->baseEndPoint . '/'. $id;

    $response = Http::withHeaders(
      [
        'Accept' => 'application/json',
        'Authorization' => 'Bearer '.$this->access_token,
      ])->delete($endpoind);

      return $response->json();
  }
}

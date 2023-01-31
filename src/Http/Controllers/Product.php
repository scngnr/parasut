<?php

namespace Scngnr\Mdent\FaturaEnt\Parasut\Http\Controllers;

use App\Models\Urunler;
use Illuminate\Http\Request;
use Automattic\WooCommerce\Client;
use Illuminate\Routing\Controller;
use Scngnr\Mdent\PriceService\Models\priceService;
use Illuminate\Support\Facades\Http;
use Scngnr\Mdent\FaturaEnt\Parasut\Models\Parasut;

class Product extends Controller
{

  public function __construct(){

    $parasut = Parasut::find(1);
    $this->parasutCompanyId = $parasut->firmaId;
    $this->access_token = $parasut->accessToken;

    $this->baseEndPoint = "https://api.parasut.com/v4/{$this->parasutCompanyId}/products";

    // $this->access_token = $response['access_token'];


  }

  // Parasut sisteminde kayıtlı tüm ürünleri döndürür.
  public function index(){

    $response = Http::withHeaders(
      [
        'Accept' => 'application/json',
        'Authorization' => 'Bearer '.$this->access_token,
      ])->get($this->baseEndPoint);

      return $response->json();
  }

  //Parasut sistemine yeni ürün kayıt etmek için kullanılacak metod
  public function create($array){

    ini_set('max_execution_time', '-1');
    $endpoind = $this->baseEndPoint;

    $data = [
      'data' => [
        'id'                          => $array['id'],
        'type'                        => $array['type'],
        'attributes' => [
          'code'                      => $array['attributes']['code'],
          'name'                      => $array['attributes']['name'],
          'vat_rate'                  => $array['attributes']['vat_rate'],
          // 'sales_excise_duty'         => $array['attributes']['sales_excise_duty'],
          // 'sales_excise_duty_type'    => $array['attributes']['sales_excise_duty_type'],
          // 'purchase_excise_duty'      => $array['attributes']['purchase_excise_duty'],
          // 'purchase_excise_duty_type' => $array['attributes']['purchase_excise_duty_type'],
          'unit'                      => $array['attributes']['unit'],
          // 'communications_tax_rate'   => $array['attributes']['communications_tax_rate'],
          'archived'                  => $array['attributes']['archived'],
          'list_price'                => $array['attributes']['list_price'],
          'currency'                  => $array['attributes']['currency'],
          // 'buying_price'              => $array['attributes']['buying_price'],
          // 'buying_currency'           => $array['attributes']['buying_currency'],
          'inventory_tracking'        => $array['attributes']['inventory_tracking'],
          'initial_stock_count'       => $array['attributes']['initial_stock_count'],
          // 'gtip'                      => $array['attributes']['gtip'],
          'barcode'                   => $array['attributes']['barcode'],
        ],
        'releationship' => [
          'inventory_levels' => [
            'data' => [
              'id'  => $array['releationship']['id'],
              'type'  => $array['releationship']['type'],
            ]
          ]
        ],
        'category' => [
          'data' => [
            'id'  => $array['category']['id'],
            'type'  => 'item_categories',
          ]
        ]
      ]
    ];

    $response = Http::withHeaders(
      [
        'Accept' => 'application/json',
        'Authorization' => 'Bearer '.$this->access_token,
      ])->post($endpoind, $data);


      //dd($response->json());
      return $response->json();
  }

  //Parasüt sistemindeki ürün idsi ile bilgileri çekme
  public function info($id){

    $endpoind = $this->baseEndPoint . $id;

    $response = Http::withHeaders(
      [
        'Accept' => 'application/json',
        'Authorization' => 'Bearer '.$this->access_token,
      ])->get($endpoind);

      $response->json();
  }

  //Parasut kategori ürün ile kategori düzenle
  public function edit($id){

    ini_set('max_execution_time', '-1');
    $endpoind = $this->baseEndPoint . $id;

    $response = Http::withHeaders(
      [
        'Accept' => 'application/json',
        'Authorization' => 'Bearer '.$this->access_token,
      ])->put($endpoind, $data);
  }

  //Parasut kategori ürün ile kategori sil
  public function delete($id){

        ini_set('max_execution_time', '-1');
    $endpoind = $this->baseEndPoint . '/' . $id;
    $response = Http::withHeaders(
      [
        'Accept' => 'application/json',
        'Authorization' => 'Bearer '.$this->access_token,
      ])->delete($endpoind);

      $response->json();
  }
}

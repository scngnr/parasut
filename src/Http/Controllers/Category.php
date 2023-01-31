<?php

namespace Scngnr\Mdent\FaturaEnt\Parasut\Http\Controllers;

use App\Models\Urunler;
use Illuminate\Http\Request;
use Automattic\WooCommerce\Client;
use Illuminate\Routing\Controller;
use Scngnr\Mdent\PriceService\Models\priceService;
use Illuminate\Support\Facades\Http;
use Scngnr\Mdent\FaturaEnt\Parasut\Models\Parasut;

class Category extends Controller
{
  //public $baseEndPoint = "https://api.parasut.com/v4/348340" ;

  public function __construct(){

    $parasut = Parasut::find(1);
    $this->parasutCompanyId = $parasut->firmaId;
    $this->access_token = $parasut->accessToken;

  }
  // Parasut sisteminde kayıtlı tüm kategorileri döndürür.
  public function index(){

   $endpoind = $this->baseEndPoint . "/item_categories";

   $response = Http::withHeaders(
     [
       'Accept' => 'application/json',
       'Authorization' => 'Bearer '.$this->access_token,
     ])->get($endpoind);

     $response->json();
  }

  //Parasut sistemine yeni kategori kayıt etmek için kullanılacak metod
  /**
  *Parasüt kategori ekleme için gerekli olanlar
  *
  * @param array $array['name'] Kategori adı
  * @param array $array['bg_color'] Category Background Rengi
  * @param array $array['text_color'] Category Yazı rengi
  * @param array $array['category_type'] Category tipi
  * @param array $array['parent_id'] Category Parent Id
  *
  */
  public function create($array){

    $endpoind = $this->baseEndPoint . "/item_categories";


    $data = [
      'data' => [
        'id' => 1,
        'type' => 'item_categories',
        'attributes' => [
          'name' => $array['name'],
          'bg_color' => '', //$array['bg_color'],
          'text_color' => '', //$array['text_color'],
          'category_type' => $array['category_type'],
          'parent_id' => $array['parent_id'],
        ]
      ]
    ];

    $response = Http::withHeaders(
      [
        'Accept' => 'application/json',
        'Authorization' => 'Bearer '.$this->access_token,
      ])->post($endpoind, $data);

      return $response->json();
      //dd($response->json());
  }

  //Parasüt sistemindeki kategori idsi ile bilgileri çekme
  public function info($id){


    $endpoind = $this->baseEndPoint . "/item_categories/" . $id;

    $response = Http::withHeaders(
      [
        'Accept' => 'application/json',
        'Authorization' => 'Bearer '.$this->access_token,
      ])->get($endpoind);

      return $response->json();
  }

  //Parasut kategori id ile kategori düzenle
  public function edit($id){

    $endpoind = $this->baseEndPoint . "/item_categories/" . $id;

    $data = [
      'data' => [
        'type' => 'item_categories',
        'attributes' => [
          'name' => $array['name'],
          'bg_color' => '', //$array['bg_color'],
          'text_color' => '', //$array['text_color'],
          'category_type' => $array['category_type'],
          'parent_id' => $array['parent_id'],
        ]
      ]
    ];

    $response = Http::withHeaders(
      [
        'Accept' => 'application/json',
        'Authorization' => 'Bearer '.$this->access_token,
      ])->put($endpoind, $data);

      return $response->json();
  }

  //Parasut kategori id ile kategori sil
  public function delete($id){

    $endpoind = $this->baseEndPoint . "/item_categories/" . $id;

    $response = Http::withHeaders(
      [
        'Accept' => 'application/json',
        'Authorization' => 'Bearer '.$this->access_token,
      ])->delete($endpoind);

      return $response->json();
  }
}

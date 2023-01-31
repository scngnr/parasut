<?php

namespace Scngnr\Mdent\FaturaEnt\Parasut\Http\Controllers;

use App\Models\Urunler;
use Illuminate\Http\Request;
use Automattic\WooCommerce\Client;
use Illuminate\Routing\Controller;
use Scngnr\Mdent\PriceService\Models\priceService;
use Illuminate\Support\Facades\Http;
use Scngnr\Mdent\FaturaEnt\Parasut\Models\Parasut;

class EFatura extends Controller
{

  public function __construct(){

    $parasut = Parasut::find(1);
    $this->parasutCompanyId = $parasut->firmaId;
    $this->access_token = $parasut->accessToken;

  }
  // Parasut sisteminde kayıtlı tüm kategorileri döndürür.
  public function create(){

   $endpoind = $this->baseEndPoint;
   $array = [
     'data' => [
       'id' => 1,
       'type' => 'e_invoices',
       'attributes' => [

       ],
       'relationships' => [
         'invoice' => [
           'data' => [
             'id' => '101953659',
             'type' => 'sales_invoices'
           ]
         ]
       ]
     ]
   ];
   $response = Http::withHeaders(
     [
       'Accept' => 'application/json',
       'Authorization' => 'Bearer '.$this->access_token,
     ])->post($endpoind, $array);

    return  $response->json();
  }
}

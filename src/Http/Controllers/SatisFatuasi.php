<?php

namespace Scngnr\Mdent\FaturaEnt\Parasut\Http\Controllers;

use App\Models\Urunler;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;
use Scngnr\Mdent\FaturaEnt\Parasut\Models\Parasut;

class SatisFatuasi extends Controller
{

  public function __construct(){

    $parasut = Parasut::find(1);
    $this->parasutCompanyId = $parasut->firmaId;
    $this->access_token = $parasut->accessToken;

    $this->baseEndPoint = "https://api.parasut.com/v4/{$this->parasutCompanyId}/sales_invoices";
  }
  public function __construct(){
    $this->parasutCompanyId = "348340";

    //Auth Kontroller sınıfını kullanarak access_token al
    $controller = new \Scngnr\Mdent\FaturaEnt\Parasut\Http\Controllers\Auth();
    $response = $controller->oAuthToken();
    //$this->access_token = "w00U9BpQFcdCjfzSMAEdXkrdGrYvlObryFx17QaX2Vs";
    $this->access_token = $response['access_token'];
  }

  // Parasut sisteminde kayıtlı tüm kategorileri döndürür.
  public function index(){

   $response = Http::withHeaders(
     [
       'Accept' => 'application/json',
       'Authorization' => 'Bearer '.$this->access_token,
     ])->get($this->baseEndPoint);

    return $response->json();
  }


  public function create($array){

    $response = Http::withHeaders(
      [
        'Accept' => 'application/json',
        'Authorization' => 'Bearer '.$this->access_token,
      ])->post($this->baseEndPoint, $array);

    return  $response->json();
  }


  public function show($id){

    $response = Http::withHeaders(
      [
        'Accept' => 'application/json',
        'Authorization' => 'Bearer '.$this->access_token,
      ])->get($this->baseEndPoint . '/' . $id);

    return  $response->json();
  }


  public function edit($id, $array){

    $response = Http::withHeaders(
      [
        'Accept' => 'application/json',
        'Authorization' => 'Bearer '.$this->access_token,
      ])->put($this->baseEndPoint . '/' . $id, $array);


      return  $response->json();
  }


  public function delete($id){

    $response = Http::withHeaders(
      [
        'Accept' => 'application/json',
        'Authorization' => 'Bearer '.$this->access_token,
      ])->delete($this->baseEndPoint . '/' . $id);

    return  $response->json();
  }

  public function pay($id, $array){

    $response = Http::withHeaders(
      [
        'Accept' => 'application/json',
        'Authorization' => 'Bearer '.$this->access_token,
      ])->post($this->baseEndPoint . '/' . $id . '/payments', $array);


      return  $response->json();
  }

  public function cancel($id){

    $response = Http::withHeaders(
      [
        'Accept' => 'application/json',
        'Authorization' => 'Bearer '.$this->access_token,
      ])->delete($this->baseEndPoint . '/' . $id. '/cancel');


      return  $response->json();
  }

  public function recover($id,$array){

    $response = Http::withHeaders(
      [
        'Accept' => 'application/json',
        'Authorization' => 'Bearer '.$this->access_token,
      ])->patch($this->baseEndPoint . '/' . $id . '/recover', $array);

      return  $response->json();
  }

  public function archive($id){

    $response = Http::withHeaders(
      [
        'Accept' => 'application/json',
        'Authorization' => 'Bearer '.$this->access_token,
      ])->patch($this->baseEndPoint . '/' . $id . '/archive');

      return  $response->json();
  }

  public function unArchive($id){

    $response = Http::withHeaders(
      [
        'Accept' => 'application/json',
        'Authorization' => 'Bearer '.$this->access_token,
      ])->patch($this->baseEndPoint . '/' . $id . '/unarchive');

      return  $response->json();
  }

  public function convertEstimateInvoice($id, $array){

    $response = Http::withHeaders(
      [
        'Accept' => 'application/json',
        'Authorization' => 'Bearer '.$this->access_token,
      ])->patch($this->baseEndPoint . '/' . $id . '/convert_to_invoice', $array);

      return  $response->json();
  }
}

<?php

namespace Scngnr\Mdent\FaturaEnt\Parasut\Http\Controllers;

use App\Models\Urunler;
use Illuminate\Http\Request;
use Automattic\WooCommerce\Client;
use Illuminate\Routing\Controller;
use Scngnr\Mdent\PriceService\Models\priceService;
use Illuminate\Support\Facades\Http;
use Scngnr\Mdent\FaturaEnt\Parasut\Models\Parasut;

class Auth extends Controller
{

  // Parasut sisteminde kayıtlı tüm kategorileri döndürür.
  public function oAuthToken2(){

    $parasut = Parasut::find(1);

    $response = Http::asForm()->post('https://api.parasut.com/oauth/token', [
        'grant_type' => 'password',
        'access_token_url' => 'https://api.parasut.com/oauth/token',
        'client_id' => 'uDKy9IMfoNWxHbxgNbsOif4sjZTOcedT5B9FVb-5l5I',
        'client_secret' => 'ejWHWzlhm2aJbXv37SkRkeUm-TaAlcj2yXUS-Qy13sM',
        'username' => 'scngnr@gmail.com',
        'password' => 'scngnr546',
        'scope' => '',
    ]);
    //dd($response->json());
    $res = $response->json();
    $parasut->accessToken = $res['access_token'];
    return $response->json();

  }
  public function oAuthToken(){

    $parasut = Parasut::find(1);

    $response = Http::asForm()->post('https://api.parasut.com/oauth/token', [
        'grant_type' => 'password',
        'access_token_url' => 'https://api.parasut.com/oauth/token',
        'client_id' => $parasut->clientId,
        'client_secret' => $parasut->clientSecret,
        'username' => $parasut->kullaniciMail,
        'password' => $parasut->kullaniciPassword,
        'scope' => '',
    ]);
    //dd($response->json());
    $res = $response->json();
    $parasut->accessToken = $res['access_token'];
    $parasut->update();
    return $response->json();

  }

  public function accesToken(){

    $controller = new \Scngnr\Mdent\FaturaEnt\Parasut\Http\Controllers\Auth();
    $controller->oAuthToken();
  }
}

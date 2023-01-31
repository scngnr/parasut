<?php

namespace Scngnr\Mdent\FaturaEnt\Parasut\Http\Controllers;

use App\Models\Urunler;
use Illuminate\Http\Request;
use Automattic\WooCommerce\Client;
use Illuminate\Routing\Controller;
use Scngnr\Mdent\PriceService\Models\priceService;
use Scngnr\Mdent\FaturaEnt\Parasut\Models\Parasut;

class Product extends Controller
{
  public function __construct(){

    $parasut = Parasut::find(1);
    $this->parasutCompanyId = $parasut->firmaId;
    $this->access_token = $parasut->accessToken;

  }
  // Parasut sisteminde kayıtlı tüm kategorileri döndürür.
  public function index(){

  }

  //Parasut sistemine yeni kategori kayıt etmek için kullanılacak metod
  public function create(){

  }

  //Parasüt sistemindeki kategori idsi ile bilgileri çekme
  public function info(){

  }

  //Parasut kategori id ile kategori düzenle
  public function edit(){

  }

  //Parasut kategori id ile kategori sil
  public function delete(){

  }
}

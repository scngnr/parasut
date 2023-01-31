<?php

namespace Scngnr\Mdent\FaturaEnt\Parasut\Http\Controllers;

use App\Models\Urunler;
use Illuminate\Http\Request;
use Automattic\WooCommerce\Client;
use Illuminate\Routing\Controller;
use Scngnr\Mdent\PriceService\Models\priceService;
use Scngnr\Mdent\FaturaEnt\Parasut\Models\Parasut;

class Customer extends Controller
{
  public function __construct(){

    $parasut = Parasut::find(1);
    $this->parasutCompanyId = $parasut->firmaId;
    $this->access_token = $parasut->accessToken;

  }
  public function index(){

  }


  public function create(){

  }


  public function info(){

  }


  public function edit(){

  }


  public function delete(){

  }
}

<?php

namespace App\Http\Controllers;

use App\Models\Merchant;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MerchantController extends Controller
{
    public function getMerchant(Merchant $merchant){
        
        $merchant->load('menus');

        return Inertia::render('Merchant/DetailMerchant', [
            'merchant' => $merchant
        ]);
    }
}

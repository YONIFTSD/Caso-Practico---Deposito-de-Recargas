<?php

namespace App\Http\Controllers;

use App\Models\Cash;
use App\Models\Client;
use App\Models\KardexMovement;
use App\Models\Order;
use App\Models\Output;
use App\Models\Product;
use App\Models\RedeemedSale;
use App\Models\Requirement;
use App\Models\Reservation;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\SaleLow;
use App\Models\Stock;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    
    public function TotalHome(){
        $broadcast_date = date('Y-m-d');
        $broadcast_date = date("Y-m-d",strtotime($broadcast_date."-2 days"));
        $reservations = Reservation::where('state',1)->where('date',date('Y-m-d'))->count();
        $sale = Sale::TotalObservedVouchers($broadcast_date);
        $sale_low = SaleLow::ListObservedVouchers($broadcast_date);

        return response()->json([
            'status' => 200,
            'reservations' => $reservations,
            'voucher_observer' => count($sale) + count($sale_low),
        ]);


        
    }
    

    
}
?>

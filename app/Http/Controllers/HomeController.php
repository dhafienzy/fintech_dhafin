<?php

namespace App\Http\Controllers;
use App\Models\Transaksi;
use App\Models\Saldo;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $pengajuans = Transaksi::where("type", 1)
            ->where("status", 2)
            ->get();

        $pengajuan_jajans = Transaksi::where("type", 2)
            ->get();

        $jajan_by_invoices = Transaksi::where('type', 2)
            ->groupBy('invoice_id')
            ->get();
            $barangs = Barang::all();
        $carts = Transaksi::where("user_id", Auth::user()->id)->where("status", 1)->where("type", 2)->get();
        $checkouts = Transaksi::where("user_id", Auth::user()->id)->where("status", 2)->where("type", 2)->get();
        $saldo = Saldo::where("user_id", Auth::user()->id)->first();

        $total_cart = 0;
        $total_checkout = 0;

        foreach ($carts as $cart) {
            $total_cart += ($cart->barang->price * $cart->jumlah);
        }

        foreach ($checkouts as $checkout) {
            $total_checkout += ($checkout->barang->price * $checkout->jumlah);
        }

       

        // dd($jajan_by_invoices);

        return view('home', [
            "pengajuans" => $pengajuans,
            "jajan_by_invoices" => $jajan_by_invoices,
            "pengajuan_jajans" => $pengajuan_jajans,
            "barangs" => $barangs,
            "carts" => $carts,
            "checkouts" => $checkouts,
            "total_cart" => $total_cart,
            "total_checkout" => $total_checkout,
            "saldo" => $saldo
           
        ]);
    }
}
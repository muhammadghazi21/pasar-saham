<?php

namespace App\Http\Controllers;

use App\Models\Saham_owned;
use App\Models\Saham_sale;
use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Http\Request;

class SahamSaleController extends Controller
{
    //
    public function form_buy_saham($id)
    {
        $saham_sale = Saham_sale::find($id);
        $saham_owned = Saham_owned::where('user_id', $saham_sale->user_id)->where('company_id', $saham_sale->company_id)->first();
        return view('pages.form-buy-saham', compact('saham_sale', 'saham_owned'), ['type_menu' => 'transaction']);
    }

    public function store_buy_saham(Request $request, $id)
    {
        $saham_sale = Saham_sale::find($id);
        $saham_seller_owned = Saham_owned::where('user_id', $saham_sale->user_id)->where('company_id', $saham_sale->company_id)->first();

        if ($_POST['amount'] > $saham_sale->amount) {
            return redirect()->back()->with('error', 'Jumlah saham yang ingin dibeli melebihi jumlah saham yang tersedia');
        }

        $saham_seller_owned->amount -= $request->amount;
        if ($saham_seller_owned->amount == 0) {
            $saham_seller_owned->delete();
        } else {
            $saham_seller_owned->save();
        }

        $saham_sale->amount -= $request->amount;
        if ($saham_sale->amount == 0) {
            $saham_sale->delete();
        } else {
            $saham_sale->save();
        }

        $wallet_seller = Wallet::where('user_id', $saham_sale->user_id)->first();
        $wallet_seller->balance += $request->amount * $saham_sale->price;
        $wallet_seller->save();

        // yang bawah ini buat yang beli
        $saham_buyer_owned = Saham_owned::where('user_id', auth()->user()->id)->where('company_id', $saham_sale->company_id)->first();
        if (!empty($saham_buyer_owned)) {
            $saham_buyer_owned->amount += $request->amount;
            $wallet_user = Wallet::where('user_id', auth()->user()->id)->first();
            $wallet_user->balance -= ($request->amount * $saham_sale->price + $request->amount * $saham_sale->price * 0.01);
            $wallet_user->save();
        } else {
            $saham_buyer_owned = new Saham_owned;
            $saham_buyer_owned->user_id = auth()->user()->id;
            $saham_buyer_owned->company_id = $saham_sale->company_id;
            $saham_buyer_owned->amount = $request->amount;
            $saham_buyer_owned->price = $saham_sale->price;
            $wallet_user = Wallet::where('user_id', auth()->user()->id)->first();
            $wallet_user->balance -= ($request->amount * $saham_sale->price + $request->amount * $saham_sale->price * 0.01);
            $wallet_user->save();
        }
        $saham_buyer_owned->save();

        $transaction = new Transaction();
        $transaction->user_id = auth()->user()->id;
        $transaction->company_id = $saham_sale->company_id;
        $transaction->amount = $request->amount;
        $transaction->price = $saham_sale->price;
        $transaction->tax = $request->amount * $saham_sale->price * 0.01;
        $transaction->type = 'buy';
        $transaction->save();

        $transaction = new Transaction();
        $transaction->user_id = $saham_sale->user_id;
        $transaction->company_id = $saham_sale->company_id;
        $transaction->amount = $request->amount;
        $transaction->tax = 0;
        $transaction->price = $saham_sale->price;
        $transaction->type = 'sell';
        $transaction->save();

        // yang bawah ini buat admin

        $wallet_admin = Wallet::where('user_id', 1)->first();
        $wallet_admin->balance += ($request->amount * $saham_sale->price * 0.01);
        $wallet_admin->save();

        return redirect('dashboard-general')->with('success', 'Berhasil membeli saham');
    }

    public function detail_sell_saham()
    {
        $saham_owned = Saham_owned::where('user_id', auth()->user()->id)->get();
        $saham_sale = Saham_sale::where('user_id', auth()->user()->id)->get();

        // return response()->json($saham_owned);
        return view('pages.detail-sell-saham', compact('saham_owned', 'saham_sale'), ['type_menu' => 'transaction']);
    }

    public function store_sell_saham(Request $request, $id)
    {
        $saham_owned = Saham_owned::find($id);
        $saham_sale = Saham_sale::where('user_id', auth()->user()->id)->where('company_id', $saham_owned->company_id)->first();
        if ($saham_owned->amount < $request->amount) {
            return redirect()->back()->with('error', 'Jumlah saham yang ingin dijual melebihi jumlah saham yang dimiliki');
        } else if (!empty($saham_sale)) {
            $saham_sale->amount = $request->amount;
            $saham_sale->price = $request->price;
        } else {
            $saham_sale = new Saham_sale;
            $saham_sale->user_id = auth()->user()->id;
            $saham_sale->company_id = $saham_owned->company_id;
            $saham_sale->amount = $request->amount;
            $saham_sale->price = $request->price;
        }

        $saham_sale->save();

        return redirect()->back()->with('success', 'Berhasil menjual saham');
    }

    public function store_sell_saham_user(Request $request)
    {
        $saham_owned = Saham_owned::where('user_id', auth()->user()->id)->where('company_id', $request->company_id)->first();
        $saham_sale = Saham_sale::where('user_id', auth()->user()->id)->where('company_id', $saham_owned->company_id)->first();
        if ($saham_owned->amount < $request->amount) {
            return redirect()->back()->with('error', 'Jumlah saham yang ingin dijual melebihi jumlah saham yang dimiliki');
        } else if (!empty($saham_sale)) {
            $saham_sale->amount = $request->amount;
            $saham_sale->price = $request->price;
        } else {
            $saham_sale = new Saham_sale;
            $saham_sale->user_id = auth()->user()->id;
            $saham_sale->company_id = $saham_owned->company_id;
            $saham_sale->amount = $request->amount;
            $saham_sale->price = $request->price;
        }

        $saham_sale->save();

        return redirect()->back()->with('success', 'Berhasil menjual saham');
    }
}

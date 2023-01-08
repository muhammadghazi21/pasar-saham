<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Saham_owned;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SahamOwnedController extends Controller
{
    //
    public function store_make_saham(Request $request)
    {
        $user = Auth::user();
        $company = Company::where('user_id', $user->id)->with('user')->first();
        $request->validate([
            'user_id' => 'required',
            'company_id' => 'required',
            'amount' => 'required',
            'price' => 'required',
        ]);

        $saham_owned = new Saham_owned();
        $saham_owned->user_id = $user->id;
        $saham_owned->company_id = $company->id;
        $saham_owned->amount = $request->amount;
        $saham_owned->price = $request->price;
        $saham_owned->save();

        return redirect('dashboard-company');
    }

    public function store_edit_saham(Request $request, $id)
    {
        $user = Auth::user();
        $company = Company::where('user_id', $user->id)->with('user')->first();
        $request->validate([
            'amount' => 'required',
            'price' => 'required',
            'net_income' => 'required',
            'dividend' => 'required',
            'assets' => 'required',
            'debt' => 'required',
        ]);

        $saham_owned = Saham_owned::find($id);
        $saham_owned->user_id = $user->id;
        $saham_owned->company_id = $company->id;
        $saham_owned->amount = $request->amount;
        $saham_owned->price = $request->price;
        $saham_owned->save();

        $company->net_income = $request->net_income;
        $company->dividend = $request->dividend;
        $company->assets = $request->assets;
        $company->debt = $request->debt;
        $company->save();


        return redirect()->back()->with('success', 'Berhasil menjual saham');
    }
}

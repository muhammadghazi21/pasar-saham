<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Qna;
use App\Models\Saham_owned;
use App\Models\Saham_sale;
use App\Models\Transaction;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //

    public function index(Request $request)
    {
        $user = Auth::user();
        $search = request()->input('search');
        $wallet = $user->wallet->balance;
        $price_average = [];
        $people_selling = [];
        $sum_of_saham_company = [];
        $saham_owned = Saham_owned::where('user_id', $user->id)->with('company')->orderBy('price', 'desc')->get();
        $saham_all = Saham_owned::with('company')->get();
        $saham_sale = Saham_sale::with('company')->where('price', 'like', "%$search%")->get();
        foreach ($saham_all as $item) {
            $company = $item['company']['id'];
            if (array_key_exists($company, $sum_of_saham_company)) {
                $sum_of_saham_company[$company] += (int) $item['amount'];
            } else {
                $sum_of_saham_company[$company] = (int) $item['amount'];
            }
        }
        foreach ($saham_sale as $item) {
            $company = $item['company']['id'];
            if (array_key_exists($company, $price_average)) {
                $price_average[$company] += (int) $item['price'];
                $people_selling[$company] += 1;
            } else {
                $price_average[$company] = (int) $item['price'];
                $people_selling[$company] = 1;
            }
        }
        // untuk tabel saham yang ada yang sejenis
        // foreach ($saham_all as $item) {
        //     $item['company']['total_saham'] = $sum_of_saham_company[$item->company->id];
        //     $item['earning_per_share'] = ($item->company->net_income - $item->company->dividend) / $sum_of_saham_company[$item->company->id];
        //     $item['price_to_book_value'] = $sum_of_saham_company[$item->company->id] * $item->price / ($item->company->assets - $item->company->debt);
        //     $item['company']['price_average'] = $price_average[$item->company->id];
        // }
        foreach ($saham_owned as $item) {
            $item['company']['total_saham'] = $sum_of_saham_company[$item->company->id];
            $item['earning_per_share'] = ($item->company->net_income - $item->company->dividend) / $sum_of_saham_company[$item->company->id];
            $item['price_to_book_value'] = $sum_of_saham_company[$item->company->id] * $item->price / ($item->company->assets - $item->company->debt);
            $item['company']['price_average'] = $price_average[$item->company->id] / $people_selling[$item->company->id];
        }

        // untuk tabel saham yang dijual
        foreach ($saham_sale as $item) {
            $item['company']['total_saham'] = $sum_of_saham_company[$item->company->id];
            $item['earning_per_share'] = ($item->company->net_income - $item->company->dividend) / $sum_of_saham_company[$item->company->id];
            $item['price_to_book_value'] = $sum_of_saham_company[$item->company->id] * $item->price / ($item->company->assets - $item->company->debt);
            $item['company']['price_average'] = $price_average[$item->company->id] / $people_selling[$item->company->id];
        }

        // return response()->json($saham_owned);
        return view('pages.dashboard-general', compact('user', 'wallet', 'saham_sale', 'saham_owned'), ['type_menu' => 'dashboard']);
    }


    public function index_company(Request $request)
    {
        $user = Auth::user();
        $company = Company::where('user_id', $user->id)->with('user')->first();
        $user_has_saham_company = Saham_owned::where('company_id', $company->id)->with('company')->with('user')->get();
        $saham_owned = Saham_owned::where('user_id', $user->id)->with('user')->first();
        $saham_sale = Saham_sale::where('user_id', $user->id)->with('user')->first();
        $people_selling_saham = Saham_sale::where('company_id', $company->id)->get();
        $qna = Qna::where('user_id', $user->id)->get();

        $sum_of_saham_company = 0;
        foreach ($user_has_saham_company as $item) {
            $sum_of_saham_company += (int) $item['amount'];
        }
        $company['total_saham'] = $sum_of_saham_company;

        $transactions = Transaction::where('company_id', $company->id)
            ->where('date', '>=', Carbon::now()->subDays(7))
            ->get();

        $average_sales_per_day = $transactions->groupBy(function ($item) {
            return $item['date'];
        })->sortBy(function ($items, $date) {
            return $date;
        })->map(function ($items) {
            return array_sum($items->pluck('price')->toArray()) / $items->count();
        });


        $people_selling = 0;
        foreach ($people_selling_saham as $item) {
            $company['total_price'] += (int) $item['price'];
            $people_selling += 1;
        }
        $company['average_sales_per_day'] = $average_sales_per_day;
        $company['price_average'] = $company['total_price'] / $people_selling;
        $company['earning_per_share'] = ($company->net_income - $company->dividend) / $sum_of_saham_company;

        // return response()->json($user_has_saham_company);
        return $request->wantsJson() ? [
            'data' => $company,
            'qna' => $qna,
        ] : view('pages.dashboard-ecommerce', compact('user', 'company', 'user_has_saham_company', 'saham_owned', 'saham_sale'), ['type_menu' => 'dashboard']);
    }


    public function detail_saham(Request $request, $id)
    {
        $price_average = 0;
        $company = Company::where('id', $id)->with('user')->first();
        $user_has_saham_company = Saham_owned::where('company_id', $company->id)->with('company')->get();
        $people_selling_saham = Saham_sale::where('company_id', $company->id)->get();
        $saham_sale = Saham_sale::where('company_id', $company->id)->with('user')->with('company')->get();
        $transactions = Transaction::where('company_id', $company->id)
            ->where('date', '>=', Carbon::now()->subDays(7))
            ->get();

        $average_sales_per_day = $transactions->groupBy(function ($item) {
            return $item['date'];
        })->sortBy(function ($items, $date) {
            return $date;
        })->map(function ($items) {
            return array_sum($items->pluck('price')->toArray()) / $items->count();
        });

        // return response()->json($user_has_saham_company);
        $sum_of_saham_company = 0;
        foreach ($user_has_saham_company as $item) {
            $sum_of_saham_company += (int) $item['amount'];
        }

        $company['total_saham'] = $sum_of_saham_company;
        $people_selling = 0;
        foreach ($people_selling_saham as $item) {
            $company['total_price'] += (int) $item['price'];
            $people_selling += 1;
        }
        $company['average_sales_per_day'] = $average_sales_per_day;
        $company['price_average'] = $company['total_price'] / $people_selling;
        $company['earning_per_share'] = ($company->net_income - $company->dividend) / $sum_of_saham_company;

        foreach ($saham_sale as $item) {
            $price_average += (int) $item['price'];
            $people_selling += 1;
        }

        foreach ($saham_sale as $item) {
            $item['price_to_book_value'] = $sum_of_saham_company * $item->price / ($item->company->assets - $item->company->debt);
            $item['company']['price_average'] = $price_average / $people_selling;
        }


        // return response()->json($saham_sale);
        return $request->wantsJson() ? [
            'data' => $company,
        ] : view('pages.detail-saham', compact('saham_sale', 'company'), ['type_menu' => 'dashboard']);
    }

    public function index_manager(Request $request)
    {
        $all_company = Company::all();
        $price_total = [];
        $people_selling = [];
        $sum_of_saham_company = [];
        $total_on_sale = [];
        $saham_all = Saham_owned::with('company')->get();
        $saham_owned = Saham_owned::with('company')->get();
        $saham_sale = Saham_sale::with('company')->get();
        $transactions = Transaction::where('date', '>=', Carbon::now()->subDays(7))->with('company')->with('user')->orderBy('date', 'desc')->get();
        $transactions_in_day = Transaction::where('date', '>=', Carbon::now()->subDays(1))->with('company')->with('user')->orderBy('date', 'desc')->get();

        $dates = CarbonPeriod::create(Carbon::now()->subDays(6), Carbon::now())->toArray();

        $count_transaction = collect($dates)->mapWithKeys(function ($date) use ($transactions) {
            $key = $date->format('Y-m-d');
            $transaction = $transactions->where('type', 'buy')
                ->where('date', $key)
                ->count();

            return [$key => $transaction];
        });

        foreach ($saham_owned as $item) {
            $company = $item['company']['id'];
            if (array_key_exists($company, $sum_of_saham_company)) {
                $sum_of_saham_company[$company] += (int) $item['amount'];
            } else {
                $sum_of_saham_company[$company] = (int) $item['amount'];
            }
        };
        foreach ($saham_sale as $item) {
            $company = $item['company']['id'];
            if (array_key_exists($company, $price_total)) {
                $price_total[$company] += (int) $item['price'];
                $total_on_sale[$company] += (int) $item['amount'];
                $people_selling[$company] += 1;
            } else {
                $price_total[$company] = (int) $item['price'];
                $total_on_sale[$company] = (int) $item['amount'];
                $people_selling[$company] = 1;
            }
        };

        // untuk tabel saham yang dijual
        foreach ($saham_all as $item) {
            $item['company']['total_saham'] = $sum_of_saham_company[$item->company->id];
            $item['earning_per_share'] = ($item->company->net_income - $item->company->dividend) / $sum_of_saham_company[$item->company->id];
            $item['price_to_book_value'] = $sum_of_saham_company[$item->company->id] * $item->price / ($item->company->assets - $item->company->debt);
            $item['company']['price_average'] = $price_total[$item->company->id] / $people_selling[$item->company->id];
        }

        foreach ($all_company as $item) {
            $item['total_saham'] = $sum_of_saham_company[$item->id];
            $item['price_average'] = $price_total[$item->id] / $people_selling[$item->id];
            $item['earning_per_share'] = ($item->net_income - $item->dividend) / $sum_of_saham_company[$item->id];
            $item['on_sale'] = $total_on_sale[$item->id];
            $item['estimation_tax'] = $total_on_sale[$item->id] * $item->price_average * 0.01;
        }
        // return response()->json($count_transaction);
        return $request->wantsJson() ? [
            'data' => $all_company,
            'data_transaction' => $count_transaction,
        ] : view('pages.dashboard-manager', compact('transactions', 'transactions_in_day', 'sum_of_saham_company', 'saham_all', 'saham_sale', 'all_company'), ['type_menu' => 'dashboard']);
    }

    public function send_qna(Request $request)
    {
        $request->validate([
            'message' => 'required',
        ]);

        $qna = new Qna();
        $qna->message = $request->message;
        $qna->user_id = Auth::user()->id;
        if (Auth::user()->id == 1) {
            $qna->type = 'answer';
        } else {
            $qna->type = 'question';
        }
        $qna->save();

        return redirect()->back()->with('success', 'Question has been sent');
    }
}

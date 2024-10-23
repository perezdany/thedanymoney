<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Expense;
use App\Models\Weekly;
use DB;

class ExpenseController extends Controller
{
    //handel Expense

    public function AddExpenses(Request $request)
    {
        $subject =  $request->subject;
        $type = $request->type;
        $date = $request->date;
        $amount =  $request->amount;

        $Insert = Expense::create([
            'label' => $subject,
            'date_event' => $date,
            'price' => $amount,
            'id_type' => $type
        ]);

        return redirect()->route('home')->with('success', 'success');
    }
    

    public function OneDayExpenses($date)
    {
        $get = DB::table('expenses')
            ->join('types', 'expenses.id_type', '=', 'types.id')
            ->where('date_event', '=', $date)
            ->select('expenses.*', 'types.*',)
            ->get();

        return $get;
    }

    public function SearchSection(Request $request)
    {
        $somme = 0;
        $last_date =$request->ldate;
        $first_date = $request->fdate;

        $get = DB::table('expenses')
        ->join('types', 'expenses.id_type', '=', 'types.id')
        ->where('date_event', '<=', $last_date)
        ->where('date_event', '>=', $first_date)
        ->select('expenses.*', 'types.*')
        ->get();

        foreach($get as $all)
        {
            $somme = $somme + $all->price;
        }

        return view('search_week', [
            'query' => $get,
            'total' => $somme
            ]) ;

    }

    public function SearchDay(Request $request)
    {
        $somme = 0;

        $day = $request->date;

        $get = DB::table('expenses')
        ->join('types', 'expenses.id_type', '=', 'types.id')
        ->where('date_event', '=', $day)
        ->select('expenses.*', 'types.*')
        ->get();

        foreach($get as $all)
        {
            $somme = $somme + $all->price;
        }


        return view('search_day', [
            'query' => $get,
            'total' => $somme
            ]) ;
    }

    public function AllWeeklies()
    {
        $get = Weekly::All();

        return $get;
    }

    public function AddWeekly(Request $request)
    {
        $amount = $request->amount;
        $period = $request->period;

        $Insert = Weekly::create([
            'tot_weekly' => $amount,
            'period' => $period,
        ]);

        return back()->with('success', 'ok');
    }

    public function AllExpenses()
    {
        $query = DB::table('expenses')
        ->join('types', 'expenses.id_type', '=', 'types.id')
        ->select('expenses.*', 'types.*')
        ->get();

        return $query;

    }

    public function EditExpenseForm(Request $request)
    {
        return view('edit_expense',
            [
                'id' => $request->id,
            ]
        );
    }

    public function GetOneExpense($id)
    {
        //dd($id);
        $query = DB::table('expenses')
            ->join('types', 'expenses.id_type', '=', 'types.id')
            ->where('id', '=', $id)
            ->select('expenses.*', 'types.*')
            ->get();
        
        return $query;
    }

    public function EditExpense(Request $request)
    {
        $affected = DB::table('expenses')
              ->where('id', $request->id)
              ->update(['label' => $request->subject, 'date_event' => $request->date, 'price' => $request->amount, 'id_type' => $request->type]);

    
        return view('edit_expense', ['id' => $request->id, 'success' => 'ok']);
    }
}   

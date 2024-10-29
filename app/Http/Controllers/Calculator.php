<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Expense;

use DB;

class Calculator extends Controller
{
    //Handle calcualtions

    public function WeeklySumExpenses()
    {
        $somme = 0;
        $today = date("Y-m-d");
        $number_day = date('N');

        $year = date('Y');
        $month = date('m');
        $day = date('j');

        if($number_day != 7)
        {   
            $date_depart = $year."-".$month."-".($day-$number_day);

            $get = DB::table('expenses')
            ->join('types', 'expenses.id_type', '=', 'types.id')
            ->where('date_event', '<=', $today)
            ->where('date_event', '>=', $date_depart)
            ->select('expenses.*',)
            ->get();

            foreach($get as $all)
            {
                $somme = $somme + $all->price;
            }

        }

        return $somme;
    }

    public function MonthlySumExpenses()
    {
        $somme = 0;
        $today = date("Y-m-d");
        $number_day = date('t');

        $year = date('Y');
        $month = date('m');
        $day = date('j');

        $date_depart = $year."-".$month."-1";
        $date_fin = $year."-".$month."-".$number_day;

        //dd($date_fin);
        $get = DB::table('expenses')
        ->join('types', 'expenses.id_type', '=', 'types.id')
        ->where('date_event', '>=', $date_depart)
        ->where('date_event', '<=', $date_fin)
        ->select('expenses.*',)
        ->get();

        foreach($get as $all)
        {
            $somme = $somme + $all->price;
        }

        return $somme;
    }


    public function DailySumExpenses()
    {
        $today = date('Y-m-d');

        $somme = 0;

        $get = DB::table('expenses')
            ->join('types', 'expenses.id_type', '=', 'types.id')
            ->where('date_event', '=', $today)
            ->select('expenses.*',)
            ->get();

        foreach($get as $all)
        {
            $somme = $somme + $all->price;
        }

        return $somme;
    }

    public function MonthlyChart()
    {
        //FAIRE UNE BOUCLE POUR TOUS LES MOIS DE L'ANNEE
        
        //LE TABLEAU QUI VA RECCUEILLIR LES DONNES 
        $data = [];

        //l'année en cours
        $year = date('Y');

        //le mois en cours
        $month = date('m');

        //dd($month);
        //nombre de jours dans le mois
        $number = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        
        //LA BOUCLE DES JOURS DU MOIS
        for($i = 1; $i <= $number; $i++)
        {
            $somme = 0;   
            //$first_date = $year."-".$i."01";
            $the_date = $year."-". $month."-".$i;

            //LA REQUETE MAINTENANT
            $get = DB::table('expenses')
                ->join('types', 'expenses.id_type', '=', 'types.id')
                ->where('date_event', '=', $the_date)
                ->select('expenses.*',)
                ->get();

          
            //FAIRE UN FOREACH POUR FAIRE LA SOMME
            foreach($get as $all)
            {
                $somme = $somme + $all->price;
            }
           

            //METTRE DANS LE TABLEAU data
            array_push($data, $somme);

            //var_dump($data);
        }          
       return view('monthly_chart', compact('data'));

       
    }

    public function YearlyChart()
    {
        //FAIRE UNE BOUCLE POUR TOUS LES MOIS DE L'ANNEE
        
        //LE TABLEAU QUI VA RECCUEILLIR LES DONNES 
        $data = [];

        //l'année en cours
        $year = date('Y');

        //LA BOUCLE DES 12 MOIS
        for($i = 1; $i <= 12; $i++)
        {
            $somme = 0;
            //nombre de jours dans le mois
            $number = cal_days_in_month(CAL_GREGORIAN, $i, $year);

            $first_date = $year."-".$i."-01";
            $last_date = $year."-".$i."-".$number;
            
            //LA REQUETE MAINTENANT
            $get = DB::table('expenses')
                    ->where('date_event', '>=', $first_date)
                    ->where('date_event', '<=', $last_date)
                    ->select('expenses.*',)
                    ->get(['price']);
            
            //FAIRE UN FOREACH POUR FAIRE LA SOMME
            foreach($get as $montant)
            {
                //echo $montant->price."<br>";
                $somme = $somme + $montant->price;
            }

            //METTRE DANS LE TABLEAU data
            array_push($data, $somme);
        } 

       return view('yearly_chart', compact('data'));
    }

    public function SearchYearlyChart(Request $request)
    {
        //FAIRE UNE BOUCLE POUR TOUS LES MOIS DE L'ANNEE
        
        //LE TABLEAU QUI VA RECCUEILLIR LES DONNES 
        $data = [];

        //l'année envoyé dans le formulaire
        $year_get = date_parse($request->year);
        //$month_get;
        $year = $year_get['year'];
        

        //l'année en cours
        //$year = date('Y');

        //LA BOUCLE DES 12 MOIS
        for($i = 1; $i <= 12; $i++)
        {
            $somme = 0;
            //nombre de jours dans le mois
            $number = cal_days_in_month(CAL_GREGORIAN, $i, $year);

            $first_date = $year."-".$i."-01";
            $last_date = $year."-".$i."-".$number;
            
            //LA REQUETE MAINTENANT
            $get = DB::table('expenses')
                    ->where('date_event', '>=', $first_date)
                    ->where('date_event', '<=', $last_date)
                    ->select('expenses.*',)
                    ->get(['price']);
            
            //FAIRE UN FOREACH POUR FAIRE LA SOMME
            foreach($get as $montant)
            {
                //echo $montant->price."<br>";
                $somme = $somme + $montant->price;
            }

            //METTRE DANS LE TABLEAU data
            array_push($data, $somme);
        } 

       return view('search_yearly_chart', compact('data', 'year'));
    }

    public function SearchMonthChart(Request $request)
    {
        
        //FAIRE UNE BOUCLE POUR TOUS LES MOIS DE L'ANNEE
        $month_tab = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        //LE TABLEAU QUI VA RECCUEILLIR LES DONNES 
        $data = [];

        //l'année envoyé dans le formulaire
        $year_get = date_parse($request->month);
        //$month_get;
        $year = $year_get['year'];
        //$year = date('Y');
    
        //le mois en cours
        //$month = $request->month;
        //le mois recherché
        $month_get = date_parse($request->month);
        //$month_get;
        $month = $month_get['month'];

        //Envoyer le nom du mois
        $name_month = $month_tab[($month - 1)];
       
        //nombre de jours dans le mois
        $number = cal_days_in_month(CAL_GREGORIAN, $month, $year);
       
        //LA BOUCLE DES JOURS DU MOIS
        for($i = 1; $i <= $number; $i++)
        {
            $somme = 0;   
            //$first_date = $year."-".$i."01";
            $the_date = $year."-". $month."-".$i;

            //LA REQUETE MAINTENANT
            $get = DB::table('expenses')
                ->join('types', 'expenses.id_type', '=', 'types.id')
                ->where('date_event', '=', $the_date)
                ->select('expenses.*',)
                ->get();

          
            //FAIRE UN FOREACH POUR FAIRE LA SOMME
            foreach($get as $all)
            {
                $somme = $somme + $all->price;
            }
           

            //METTRE DANS LE TABLEAU data
            array_push($data, $somme);

            //var_dump($data);
        }          
       return view('search_yearly_chart', compact('data', 'name_month'));

    }

}

<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Calculator;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//AJOUT D'UN UTILISATEUR
Route::get('add_user', function () {
    return view('add_user');
});

Route::post('add_user', [UserController::class, 'AddUser']);


Route::middleware(['guest:web'])->group(function(){

    //PAGE DE CONNEXION
    Route::get('/', function () {
        return view('login');
    })->name('login');

    Route::post('go_login', [AuthController::class, 'AdminLogin']);

    //DECONNEXION
    //Route::get('logout', [AuthController::class, 'logoutUser']);
});

//SI IL EST DEJA CONNECTE 
Route::middleware(['auth:web'])->group(function(){
    
    //TABLEAU DE BORD
    Route::get('welcome', function () {
        return view('welcome');
    })->name('home');
    
    //PAGES DE RECHERCHE D'UNE DATE OU D'UNE PLAGE DONNEE
    Route::get('search_day', function () {
        return view('search_day');
    });
    
    Route::get('search_week', function () {
        return view('search_week');
    });

    //AJOUT D'UNE DEPENSE
    Route::post('addexpense', [ExpenseController::class, 'AddExpenses']);

    //RECHERCHER UNE SEMAINE
    Route::post('search_section', [ExpenseController::class, 'SearchSection']);

    //RECHERCHER UNE DATE
    Route::post('search_day', [ExpenseController::class, 'SearchDay']);
    
    //DEPENSES HEBDOS
    Route::get('weekly_info', function () {
        return view('weeklies');
    });

    //AJOUT DEPENSE HEBDOS
    Route::post('weekly_info', [ExpenseController::class, 'AddWeekly']);

    

    //DECONNEXION
    Route::get('logout', [AuthController::class, 'logoutUser']);

    Route::get('history', function(){
        return view('history');
    });

    //MODIFIER UNE DEPENSE ALLER AU FORMULAIRE ET AFFICHER LES DONNEES
    Route::post('edit_expense_form', [ExpenseController::class, 'EditExpenseForm']);
        
    //MODIF
    Route::post('edit_expense', [ExpenseController::class, 'EditExpense']);

    //AFFICHER LES GRAPHES

    //Monthly
    Route::get('monthly_chart', [Calculator::class, 'MonthlyChart']);

    //Yearly
    Route::get('yearly_chart', [Calculator::class, 'YearlyChart']);
    
});
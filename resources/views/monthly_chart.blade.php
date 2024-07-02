@php
	use App\Http\Controllers\ExpenseController;
	use App\Http\Controllers\TypeController;
	use App\Http\Controllers\Calculator;
	/*use App\Models\Type;
	use App\Models\Expense;*/
@endphp

@extends('layouts/app_base')

@section('content')
   
	<section class="content">
	
	   <div class="row">
        <div class="col-lg-4 col-xs-4">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>
                @php
                  $daily = (new Calculator())->DailySumExpenses();
                @endphp

                {{$daily}}
              </h3>

              <p>Daily Expenses</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
          
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-4">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>
                @php
                  $weekly = (new Calculator())->WeeklySumExpenses();
                @endphp

                {{$weekly}}
              </h3>

              <p>Weekly Expenses</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            
          </div>
        </div>
        <!-- ./col -->
      
        <div class="col-lg-4 col-xs-4">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>
                @php
                $daily = (new Calculator())->MonthlySumExpenses();
                @endphp

                {{$daily}}
              </h3>

              <p>Monthly Expenses</p>
            </div>
            <!--<div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>-->
            
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
	 <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                    <p class="text-center">
                        <strong><strong>Monthly Expenses Chart Of 
                        @php echo date('M'); @endphp</strong></strong>
                    </p>

                    <!--my chart-->
                    <canvas id="mychart" aria-label="chart" style="height:580px;"></canvas>

                    <!-- my own chart import-->
                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                    
                    <script>
                      //FONCTION POUR RECUPERER LE NOMBRE DE JOURS DU MOIS
                        function NonbreJourMois(mois, annee)
                        {
                          var nbreJour = 0;
                          
                          if (mois <= 6)
                          {
                            if (mois%2 == 0)
                            {
                              nbreJour = 31;
                            }
                            else
                            {
                              nbreJour = 30;
                            }
                          }
                          
                          else
                          {
                            if (mois%2 == 1)
                            {
                              nbreJour = 30;
                            }
                            else
                            {
                              nbreJour = 31;
                            }
                          }
                          if (mois == 1)
                          {
                            if(annee%4==0)
                          {
                            if(annee%100==0)
                              {
                                if(annee%400==0)
                                {
                                  nbreJour = 29;
                                }
                                else
                                {
                                    nbreJour = 28;
                                }

                              }
                              else
                              {
                                nbreJour = 29;
                              }
                          }
                          else
                          {
                            nbreJour = 28;
                          }

                          }
                          
                          return nbreJour;
                          
                        }

                        let thedate = new Date();
                        
                         //Récuper le mois et l'année
                        let mois = thedate.getMonth();
                        let annee = thedate.getFullYear();

                        //Récupérer le nombre de jours du mois en cours
                        const nb_jour = NonbreJourMois(mois, annee);

                        //Créer un tableau pour récuperer tous les numéros des jours du mois 
                        var tableau = ["1", "2", "3"];
                        for(let i = 4; i <= nb_jour; i++)
                        {
                          tableau.push(''+i+'');
                        }

                        const ctx = document.getElementById('mychart').getContext('2d');

                        const barchart = new Chart(ctx, {
                            type : "bar",
                            data : {

                                //LE LABELS POUR LES ABSCISSES DU GRAPHE
                                labels: tableau,
                                datasets: [{
                                    label: 'Expenses',
                                    data: @json($data),
                                    backgroundColor: ["#e8daef", " #a9dfbf", " #85929e", "blue", "#229954", " #f1948a ", "#2c3e50", "#fad7a0", "#2874a6", "#f1c40f", "#ebf5fb", "#1c2833", "#e8daef", " #a9dfbf", " #85929e", "blue", "#229954", " #f1948a ", "#2c3e50", "#fad7a0", "#2874a6", "#f1c40f", "#ebf5fb", "#1c2833", "#e8daef", " #a9dfbf", " #85929e",],
                                }]
                            },
                            options: {
                                layout: {
                                    padding: 20
                                }
                            }
                        })
                    </script>
                        <!-- /.chart-responsive -->
                    </div>
                </div>
            </div>
          <!-- /.box -->
        </section>
        <!-- /.Left col -->
       
      </div>
      <!-- /.row (main row) -->
	  
		<div class="row">
        	<div class="col-xs-12">
				  <div class="box">
					<div class="box-header">
					  <h3 class="box-title">Today Expenses</h3>
					</div>
					<!-- /.box-header -->
					@php
						$today = date("Y-m-d");
						$get = (new ExpenseController())->OneDayExpenses($today);
					@endphp
					<div class="box-body">
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
								<th>Object</th>
								<th>Type</th>
								<th>Amount</th>
								<th>Action</th>
								
								</tr>
							</thead>
							<tbody>
								@foreach($get as $all)
									<tr>
										<td>{{$all->label}}</td>
										<td>{{$all->name_type}}</td>
										<td>{{$all->price}}</td>
										<td>
											<form action="edit_expense_form" method="post">
													@csrf
													<input type="text" value="{{$all->id}}" style="display:none" name="id">
													<button class="btn btn-primary">Edit</button>
											</form>
											<button class="btn btn-danger">Delete</button>
											
										</td>
										
									</tr>
								@endforeach
								
								
							</tbody>
							<tfoot>
								<tr>
								<th>Object</th>
								<th>Type</th>
								<th>Amount</th>
								<th>Action</th>
								</tr>
							</tfoot>
						</table>
					</div>
					<!-- /.box-body -->
				  </div>
          		<!-- /.box -->
        	</div>
        	<!-- /.col -->
      	</div>	  
    </section>
@endsection


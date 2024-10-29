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
                        @php echo $year; @endphp</strong></strong>
                    </p>

                    <!--my chart-->
                    <canvas id="mychart" aria-label="chart" style="height:580px;"></canvas>

                    <!-- my own chart import-->
                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                    
                    <script>
                     
                        const ctx = document.getElementById('mychart').getContext('2d');

                        const barchart = new Chart(ctx, {
                            type : "bar",
                            data : {

                                //LE LABELS POUR LES ABSCISSES DU GRAPHE
                                labels: ["JANUARY", "FEBRUARY", "MARCH", "APRIL", "MAY", "JUNE", "JULY", "AUGUST", "SEPTEMBER", "OCTOBER", "NOVEMBER", "DECEMBER"],
                                datasets: [{
                                    label: 'Expenses',
                                    data: @json($data),
                                    backgroundColor: ["#e8daef", " #a9dfbf", " #85929e", "blue", "#229954", " #f1948a ", "#2c3e50", "#fad7a0", "#2874a6", "#f1c40f", "#038dfc", "#1c2833", ],
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
        	<div class="col-xs-6">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Search a Year never mind the month</h3>
              </div>
              <!-- /.box-header -->
            
              <div class="box box-primary">
                
                <!-- form start -->
                <form role="form" action="search_year_graph" method="post">
                  @csrf
                  <div class="box-body">
                    

                    <div class="form-group">
                    <label >Month:</label>
                    <input type="month" class="form-control" name="year">
                    </div>

                    
                  
                  </div>
                  <!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div>
              <!-- /.box-body -->
            </div>
          	<!-- /.box -->
        	</div>
        	<!-- /.col -->
      </div>	  
    </section>
@endsection


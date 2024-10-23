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
		<div class="box-header with-border">
			
			@if(session('success') != null)
			<p class="bg-success">Done!</p>
			@endif
        </div>
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
        <section class="col-lg-6 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
         <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add Expenses</h3>
			  @if(session('success') != null)
			  	<p class="bg-success">Done!</p>
			  @endif
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="addexpense" method="post">
				@csrf
				<div class="box-body">
					<div class="form-group">
					<label >Type of expenses </label>
					@php
						$get = (new TypeController())->AllTypes();
					@endphp
					<select class="form-control" name="type">
						@foreach($get as $all)
							<option value="{{$all->id}}">{{$all->name_type}}</option>
						@endforeach
						
					</select>
					</div>

					<div class="form-group">
					<label >Date:</label>
					<input type="date" class="form-control" name="date">
					</div>

					<div class="form-group">
					<label>Subject:</label>
					<input type="text" class="form-control" name="subject" placeholder="Subject">
					</div>

					<div class="form-group">
					<label for="exampleInputFile">Amount:</label>
					<input type="text" name="amount" class="form-control" placeholder="ex: 1000 OXF">
					</div>
				
				</div>
				<!-- /.box-body -->

				<div class="box-footer">
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
            </form>
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
											<button class="btn btn-primary">Edit</button>
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


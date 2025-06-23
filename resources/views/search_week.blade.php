@php
	use App\Http\Controllers\ExpenseController;
	use App\Http\Controllers\TypeController;
	use App\Http\Controllers\Calculator;
	/*use App\Models\Type;
	use App\Models\Expense;*/
@endphp

@extends('layouts/app_base')

@section('content')
    <!-- Left col -->
        <section class="col-lg-6 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <!-- general form elements -->
            <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Search Expenses</h3>
                @if(session('succes') != null)
                <p class="bg-successs">Done!</p>
                @endif
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="search_section" method="post">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label >First Date:</label>
                        <input type="date" class="form-control" name="fdate">
                    </div>

                    <div class="form-group">
                        <label >Last Date:</label>
                        <input type="date" class="form-control" name="ldate">
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
   
	<section class="content">
		<div class="row">
        	<div class="col-xs-12">
				  <div class="box">
					<div class="box-header">
					  <h3 class="box-title">Expenses</h3>
					</div>
					<!-- /.box-header -->
					
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
                                @if(isset($query))
                              
                                    @foreach($query as $all)
                                        <tr>
                                            <td>{{$all->label}}</td>
                                            <td>{{$all->name_type}}</td>
                                            <td>{{$all->price}}</td>
                                            <td>
                                                <form action="edit_expense_form" method="post">
												@csrf
												<input type="text" style="display:none;" name="id" value="{{$all->id}}">
												<button type="submit" class="btn btn-primary">Edit</button>
												</form>
												<form action="delete_expense" method="post">
													@csrf
													<input type="text" style="display:none;" name="id" value="{{$all->id}}">
													<button type="submit" class="btn btn-danger">Delete</button>
												</form>
                                            </td>
                                            
                                        </tr>
                                    @endforeach
								
                                  
                                @endif
				
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

                @if(isset($total))
                    <h3>TOTAL:{{$total}}</h3>
                @endif
        	</div>
        	<!-- /.col -->
            
            
      	</div>	  
    </section>
@endsection


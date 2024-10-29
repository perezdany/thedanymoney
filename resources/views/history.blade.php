@php
    use App\Http\Controllers\ExpenseController;
@endphp

@extends('layouts/app_base')

@section('content')

    <!-- /.content -->
	<section class="content">
		<div class="row">
        	<div class="col-xs-12">
				  <div class="box">
					<div class="box-header">
					  <h3 class="box-title">Expenses Datas</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
					<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
								<th>Object</th>
								<th>Type</th>
								<th>Date</th>
								<th>Amount</th>
								<th>Action</th>
								
								</tr>
							</thead>
							<tbody>
                                @php     
                                    $get = (new ExpenseController())->AllExpenses();    

									//dd($get);
                                @endphp
                                
                                    @foreach($get as $all)
                                        <tr>
                                            <td>{{$all->label}}</td>
                                            <td>{{$all->name_type}}</td>
											<td>{{$all->date_event}}</td>
                                            <td>{{$all->price}}</td>
                                            <td>
												<form action="edit_expense_form" method="post">
													@csrf
													<input type="text" value="{{$all->id}}" style="display:none" name="id">
													<button class="btn btn-primary">Edit</button>
												</form>
                                               <form action="delete_expense" method="post">
												@csrf
													<input type="text" style="display:none;" name="id" value="{{$all->id}}">
													<button type="submit" class="btn btn-danger">Delete</button>
												</form>
                                                
                                            </td>
                                            
                                        </tr>
                                    @endforeach
				
							</tbody>
							<tfoot>
								<tr>
								<th>Object</th>
								<th>Type</th>
								<th>Date</th>
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
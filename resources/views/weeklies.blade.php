@php
    use App\Http\Controllers\ExpenseController;    
@endphp

@extends('layouts/app_base')

@section('content')
    <!-- Main row -->
    <section class="content">
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-7 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Weekly Info</h3>
                    @if(session('success') != null)
                        <p class="bg-success">Done!</p>
                    @endif
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" acton="weekly_info" method="post">
					@csrf
					<div class="box-body">
						<div class="form-group">
						<label>The period</label>
						<input type="text" class="form-control" name="period" placeholder="ex=jj/mm/aaaa-jj/mm/aaaa">
						</div>
					
					</div>

                    <div class="box-body">
						<div class="form-group">
						<label>Total amount(XOF)</label>
						<input type="text" class="form-control" name="amount">
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
    </section>
    <!-- /.row (main row) -->

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
                                    <th>Period</th>
                                    <th>Amount</th>
                                    <th>Action</th>
								</tr>
							</thead>
							<tbody>
                            @php
                                $get = (new ExpenseController())->AllWeeklies();
                            @endphp
                            @foreach($get as $all)
                                <tr>
                                    <td>{{$all->tot_weekly}}</td>
                                    <td>{{$all->period}}</td>
                                 
                                    <td>
                                        <button class="btn btn-primary">Edit</button>
                                        <button class="btn btn-danger">Delete</button>
                                        
                                    </td>
                                    
                                </tr>
                            @endforeach
                        
							</tbody>
							<tfoot>
								<tr>
                                    <th>Period</th>
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
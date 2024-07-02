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
                <h3 class="box-title">Search A Day</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" acton="search_day" method="post">
					@csrf
					<div class="box-body">
						<div class="form-group">
						<label>The day</label>
						<input type="date" class="form-control" name="date">
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
                                                <button class="btn btn-primary">Edit</button>
                                                <button class="btn btn-danger">Delete</button>
                                                
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
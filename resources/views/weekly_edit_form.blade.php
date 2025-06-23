@php
    use App\Http\Controllers\ExpenseController;    
    $expensecontroller = new ExpenseController();
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
                <form role="form" action="edit_weekly" method="post">
					@csrf
					@php
						//dd($id);
						$get = $expensecontroller->GetById($id);
					@endphp
					<input type="text" value="{{$id}}" style="display: none;" name="id">
					@foreach($get as $resu)
						
						<div class="box-body">
							<div class="form-group">
							<label>The period</label>
							<input type="text" class="form-control" name="period" value="{{$resu->period}}" >
							</div>
						
						</div>

	                    <div class="box-body">
							<div class="form-group">
							<label>Total amount(XOF)</label>
							<input type="text" class="form-control" value="{{$resu->tot_weekly}}" name="amount">
							</div>
						
						</div>
						<!-- /.box-body -->
					@endforeach

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

  
@endsection
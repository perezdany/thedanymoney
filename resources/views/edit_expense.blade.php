@php
	use App\Http\Controllers\ExpenseController;
	use App\Http\Controllers\TypeController;
	
	/*use App\Models\Type;
	use App\Models\Expense;*/
@endphp

@extends('layouts/app_base')

@section('content')
   
	<section class="content">
	
	 <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-6 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
         <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Expense</h3>
			  @if(isset($success))
			  	<p class="bg-success">Done!</p>
			  @endif
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            @php
               
                $get = (new ExpenseController())->GetOneExpense($id);
            @endphp
            @foreach($get as $get)
                <form role="form" action="edit_expense" method="post">
                    @csrf
                    <input type="text" value="{{$get->id}}" name="id" style="display:none;">
                    <div class="box-body">
                        {{$get->name_type}}
                        <div class="form-group">
                            <label >Type of expenses </label>
                            
                            <select class="form-control" name="type">
                                <option value="{{$get->id_type}}">{{$get->name_type}}</option>
                                @php
                                    $query = (new TypeController())->AllTypes();
                                @endphp
                                @foreach($query as $all)
                                    <option value="{{$all->id_type}}">{{$all->name_type}}</option>
                                @endforeach
                                
                            </select>
                        </div>

                        <div class="form-group">
                            <label >Date:</label>
                            <input type="date" class="form-control" name="date" value="{{$get->date_event}}">
                        </div>

                        <div class="form-group">
                            <label>Subject:</label>
                            <input type="text" class="form-control" name="subject" placeholder="Subject" value="{{$get->label}}">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputFile">Amount:</label>
                            <input type="text" name="amount" class="form-control" placeholder="ex: 1000 OXF" value="{{$get->price}}">
                        </div>
                    
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            @endforeach
           
          </div>
          <!-- /.box -->
        </section>
        <!-- /.Left col -->
       
      </div>
      <!-- /.row (main row) -->
	  
		
    </section>
@endsection


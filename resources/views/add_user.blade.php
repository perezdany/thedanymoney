@php
	use App\Http\Controllers\ExpenseController;
	use App\Http\Controllers\TypeController;
	
	/*use App\Models\Type;
	use App\Models\Expense;*/
@endphp

@extends('layouts/user_interface_base')

@section('content')
   
	<section class="content">
	
	 <!-- Main row -->
      <div class="row login-box">
        <!-- Left col -->
        <section class="">
          <!-- Custom tabs (Charts with tabs)-->
         <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add A User</h3>
            @if(session('success') != null)
              <p class="bg-success">Done!</p>
            @endif
                </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="add_user" method="post">
              @csrf
              <div class="box-body">
                
                 <div class="form-group">
                              <label >Nom:</label>
                              <input type="text" class="form-control" name="nom" onkeyup="this.value=this.value.toUpperCase();">
                </div>

                <div class="form-group">
                              <label >Pseudo:</label>
                              <input type="text" class="form-control" name="login">
                </div>

                <div class="form-group">
                              <label>Password:</label>
                              <input type="password" class="form-control" name="password" placeholder="Password" id="pwd1">
                </div>

                <div class="form-group">
                              <label for="exampleInputFile">Confirm password:</label>
                              <input type="password" name="confirm-password" class="form-control" placeholder="Confirm" id="pwd2" onkeyup="verifyPassword();">
                </div>

                          <div class="form-group">
                              <label id="match"></label>
                          </div>
                          <script type="text/javascript">
                                      
                              /*UN SCRIPT QUI VA VERFIER SI LES DEUX PASSWORDS MATCHENT*/
                              function verifyPassword()
                              {
                              var msg; 
                              var str = document.getElementById("pwd1").value; 

                              /*if (str.match( /[0-9]/g) && 
                                  str.match( /[A-Z]/g) && 
                                  str.match(/[a-z]/g) && 
                                  str.match( /[^a-zA-Z\d]/g) &&
                                  str.length >= 10) 
                                  msg = "<p style='color:green'>Mot de passe fort.</p>"; 
                              else 
                                  msg = "<p style='color:red'>Mot de passe faible.</p>"; 
                              document.getElementById("msg").innerHTML= msg; */
                              //var _ = require('underscore');
                              var text1 = document.getElementById('pwd1').value;
                              var text2 = document.getElementById('pwd2').value;
                              
                              if((text1 == text2))
                              {
                                  var theText = "<p style='color:green'>Correspond.</p>"; ;
                                  document.getElementById("match").innerHTML= theText; 
                              }
                              else
                              {
                                  var theText = "<p style='color:red'>Ne correspond pas.</p>";
                                  document.getElementById("match").innerHTML= theText; 
                              }
                              }
                                      
                          </script>
              
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>

            <br>
            <a href="/" style=""><button class="btn btn-default">Retour</button></a>
          </div>
              <!-- /.box -->
        </section>
        <!-- /.Left col -->
       
      </div>
      <!-- /.row (main row) -->
	  
		
    </section>
@endsection


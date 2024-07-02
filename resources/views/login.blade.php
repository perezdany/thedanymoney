@php
    use App\Http\Controllers\VerseController;
@endphp
@extends('layouts/user_interface_base')

@section('content')
    <div class="login-box">
        <div class="login-logo">
            <a href=""><b>TheDany</b>MONEY</a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p>
                @php
                   
                    $n = (new VerseController())->CountVerse();
                    //Un random pour obtenir le contenu
                    $id = rand(1, $n);

                    $the_verse = (new VerseController())->GetVerseById($id);

                    foreach($the_verse as $the_verse)
                    {
                        echo '<h3>'.$the_verse->title."</h3>";
                        echo $the_verse->text."<br>";
                    }
                @endphp
            </p>
            <p class="login-box-msg">Sign in to start your session</p>
            @if(session('error'))
                <p class="bg-warning">{{session('error')}}</p>
            @endif
            <form action="go_login" method="post">
                @csrf
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" placeholder="Login" name="login">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Password" name="password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                
                    <!-- /.col -->
                    <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <br>
            <hr>
            <a href="add_user">Signn up</a><br>
            <a href="#">I forgot my password</a><br>
            

        </div>
        <!-- /.login-box-body -->
    </div>
<!-- /.login-box -->
@endsection

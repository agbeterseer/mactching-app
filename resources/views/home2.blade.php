@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                         <!-- Message -->
  @if(Session::has('message'))
        <p >{{ Session::get('message') }}</p>
     @endif
 
 <form method='post' action="{{url('/uploadFile')}}" enctype='multipart/form-data' >
       {{ csrf_field() }}
       <input type='file' name='file' required>
       <input type='submit' name='submit' value='Import'>
     </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

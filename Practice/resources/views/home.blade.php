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

                 <!  You are logged in!>

                    <table class="table table-striped table-dark">
                          <thead>
                            <tr>
                              <th scope="col">Name</th>
                              <th scope="col">Email</th>
                              <th scope="col">Created At</th>
                              <th scope="col">Updated At</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($all_users as $users)
                                <tr>
                                  <td>{{ $users->name }}</td>
                                  <td>{{$users->email}}</td>
                                  <td>{{$users->created_at}}</td>
                                  <td>{{$users->updated_at}}</td>
                                </tr>
                            @endforeach
                          </tbody>
                        </table class>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layout/app')

@section('content')
    <div class="w-50 center border rounded px-3 py-3 mx-auto">
        <h1>LOGIN</h1>
        <form action="/session/login" method="post">
            @csrf
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="username" name="username" value="{{Session::get('username')}}"  class="form-control">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="mb-3 d-grid">
                <button type="submit" name="submit" class="btn btn-primary">LOGIN</button>
            </div>
        </form>
        <div>Create new <a href="/session/register">account</a> or <a href="/">back</a></div>
    </div>

@endsection

@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <h1>Sign Up</h1>
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            <form class="" action="{{ route('user.signup') }}" method="post">
                {{ csrf_field() }}

                 <div class="form-group">
                    <label for="fname">First Name: </label>
                    <input type="text" name="fname" id="fname" class="form-control">
                </div>

                <div class="form-group">
                    <label for="lname">Last Name: </label>
                    <input type="text" name="lname" id="lname" class="form-control">
                </div>

                <div class="form-group">
                    <label for="addressline">Address Line: </label>
                    <input type="text" name="addressline" id="addressline" class="form-control">
                </div>

                <div class="form-group">
                    <label for="town">Town: </label>
                    <input type="text" name="town" id="town" class="form-control">
                </div>

                <div class="form-group">
                    <label for="zipcode">Zipcode: </label>
                    <input type="text" name="zipcode" id="zipcode" class="form-control">
                </div>

                <div class="form-group">
                    <label for="phone">Phone: </label>
                    <input type="text" name="phone" id="phone" class="form-control">
                </div>

                <div class="form-group">
                    <label for="email">Email: </label>
                    <input type="text" name="email" id="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">Password: </label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                    <input type="submit" value="Sign Up" class="btn btn-primary">
             </form>
        </div>
    </div>
@endsection 
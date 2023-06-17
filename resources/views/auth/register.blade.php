@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card shadow">
                    <div class="card-header bg-white border-0">
                        <h1 class="text-center display-5 fw-bold py-3">Register</h1>
                    </div>

                    <div class="card-body pt-0">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="col-10 mx-auto">

                                <!-- fullname -->
                                <div class="mb-3">
                                    <label for="fullname" class="form-label">Full Name</label>
                                    <input type="text" name="full_name" id="fullname" class="form-control"
                                        placeholder="John Smith" value="{{ old('full_name') }}">

                                    @error('full_name')
                                        <div class="text-danger small" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>

                                <!-- username -->
                                <div class="mb-3">
                                    <label for="username" class="form-label">User Name</label>
                                    <input type="text" name="user_name" id="username" class="form-control"
                                        placeholder="John" value="{{ old('user_name') }}">

                                    @error('user_name')
                                        <div class="text-danger small" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>

                                <!-- email -->
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" name="email" id="email" class="form-control"
                                        placeholder="example@example.com" value="{{ old('email') }}">

                                    @error('email')
                                        <div class="text-danger small" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>

                                <!-- password -->
                                <div class="mb-3 row">
                                    <div class="col">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" name="password" id="password" class="form-control"
                                            placeholder="Enter Password">

                                        @error('password')
                                            <div class="text-danger small" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="confirmpassword" class="form-label">Confirm Password</label>
                                        <input type="password" name="password_confirmation" id="confirmpassword"
                                            class="form-control" placeholder="Enter Confirm Password">
                                    </div>
                                </div>

                                <!-- policy -->
                                    <div class="mb-3 form-check col-md-6 offset-md-3">
                                        <input type="checkbox" name="policy" id="policy" class="form-check-input"
                                            value="" required>
                                        <label for="policy" class="form-check-label">
                                            I have read and agree to the
                                            <a href="{{ route('privacy') }}">Privacy Policy</a>
                                        </label>
                                    </div>

                                <!-- button -->
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <a href="{{ route('login') }}">You have already an account.</a>
                                    <button type="submit" class="button btn-orange">Register</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

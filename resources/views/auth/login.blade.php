@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card shadow">
                    <div class="card-header bg-white border-0">
                        <h1 class="text-center display-5 fw-bold py-3">Login</h1>
                    </div>

                    <div class="card-body pt-0">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="col-10 mx-auto">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>

                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <div class="text-danger small" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-5">
                                    <label for="password" class="form-label">Password</label>

                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">

                                    @error('password')
                                        <div class="text-danger small" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>

                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <a href="{{ route('register') }}">Create a new account.</a>
                                    <button type="submit" class="button btn-orange">Login</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

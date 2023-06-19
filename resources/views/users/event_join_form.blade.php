@extends('layouts.app')

@section('title', 'Event Join Form')

@section('style')
  <link rel="stylesheet" href="{{ mix('css/event.css') }}">
@endsection

@section('content')
    <div class="container row mx-auto">
        <div class="card event-join-card col-5 mx-auto">
            <div class="card-body">
                <form action="#">
                    @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold">Name</label>
                            <input class="form-control" name="name" id="name" rows="3" placeholder="full name or nick name">{{old('name')}}
                        </div>
                            @error('name')
                                <div class="text-danger small">{{$message}}</div>
                            @enderror
                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">Email</label>
                            <input type="email" class="form-control" name="email" id="email" rows="3" placeholder="email">{{old('email')}}
                        </div>
                            @error('email')
                                <div class="text-danger small">{{$message}}</div>
                            @enderror
                        <div class="text-center">
                            <a href="#" class="button btn-orange m-4">
                                Join!!
                            </a>     
                        </div>
                </form>            
            </div>
        </div>
    </div>
@endsection
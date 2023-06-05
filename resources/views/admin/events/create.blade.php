@extends('layouts.admin-app')

@section('title','Create Event')

@section('content')
<div class="row">
    <div class="content">
        <div class="row justify-content-center">
            <div class="col-6 event-form ">
                <h1>New Event</h1>
                <form action="#" method="post">
                    @csrf
                    <div class="form-group my-4">
                        <label for="theme" class="form-label fs-5 mb-0">Theme</label>
                        <input type="text" name="theme" id="theme" class="form-control theme">
                        @error('theme')
                            <p class="form-text text-danger mt-0">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="form-group my-2 col">
                            <label for="date" class="form-label  fs-5 mb-0">Date</label>
                            <input type="datetime-local" name="date" id="date" class="form-control">
                            @error('date')
                                <p class="form-text text-danger mt-0">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group my-2 col">
                            <label for="level" class="form-label fs-5 mb-0">Level</label>
                            <select name="level" id="level" class="form-control">
                                <option value="hidden">--Select Level--</option>
                                <option value="Beginner">Beginner</option>
                                <option value="Intermediate">Intermediate</option>
                                <option value="Advanced">Advanced</option>
                                <option value="All Level">All Level</option>
                            </select>
                        </div>
                        @error('level')
                            <p class="form-text text-danger mt-0">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group my-4">
                        <label for="location" class="form-label fs-5 mb-0">Location</label>
                        <input type="text" name="location" id="location" class="form-control">
                        @error('location')
                            <p class="form-text text-danger mt-0">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group my-5">
                        <input type="file" name="image" id="image" class="form-control">
                    </div>
                    <div class="form-group my-5">
                        <label for="comment" class="form-label  fs-5 mb-0">Comment</label>
                        <textarea name="comment" id="comment" cols="100" class="form-control"></textarea>
                        @error('comment')
                            <p class="form-text text-danger mt-0">{{$message}}</p>
                        @enderror
                    </div>

                    <button type="submit" class="my-5 btn px-5 ms-3 button btn-gray float-end">Create</button>
                    <a href="{{route('admin.showEvents')}}" type="button" class="my-5 btn px-5 button btn-gray float-end">Back</a>

                </form>
            </div>
        </div>

    </div>
</div>


@endsection

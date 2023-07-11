@extends('layouts.admin-app')

@section('title','Edit Event')
@section('hilight_text','Events')
@section('subtitle','Update Events')

@section('content')
<div class="row">
    <div class="content">
        <div class="row justify-content-center">
            <div class="col-6 event-form ">
                <h1>Edit Event</h1>
                <form action="{{ route('admin.events.update',$event->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-group my-4">
                        <label for="theme" class="form-label fs-5 mb-0">Theme</label>
                        <input type="text" name="theme" id="theme" class="form-control theme" value="{{$event->theme}}">
                        @error('theme')
                            <p class="form-text text-danger mt-0">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="form-group my-2 col-6">
                            <label for="date" class="form-label  fs-5 mb-0">Date</label>
                            <input type="date" name="date" id="date" class="form-control" value="{{$date}}">
                            {{-- we need to discuss about type, we need to decide date or datetime --}}
                            @error('date')
                                <p class="form-text text-danger mt-0">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group my-2 col-6">
                            <label for="time" class="form-label  fs-5 mb-0">Time</label>
                            <input type="time" name="time" id="time" class="form-control" value="{{$time}}">
                            {{-- we need to discuss about type, we need to decide date or datetime --}}
                            @error('time')
                                <p class="form-text text-danger mt-0">{{$message}}</p>
                            @enderror
                        </div>
                        {{-- it should show the selected levels --}}
                        <div class="form-group my-3">
                            <label for="level" class="form-label fs-5 mb-0">Level</label><br>
                            <input type="checkbox" {{ in_array(1, $eventLevels) ? 'checked' : '' }} class="from-check-input" name="level[]" id="1" value="1"> Beginner
                            <input type="checkbox" {{ in_array(2, $eventLevels) ? 'checked' : '' }} class="from-check-input ms-3" name="level[]" id="2" value="2"> Intermediate
                            <input type="checkbox" {{ in_array(3, $eventLevels) ? 'checked' : '' }} class="from-check-input ms-3" name="level[]" id="3" value="3"> Advanced
                            @error('level')
                            <p class="form-text text-danger mt-0">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group my-4">
                        <label for="location" class="form-label fs-5 mb-0">Location</label>
                        <input type="text" name="location" id="location" class="form-control" value="{{$event->location}}">
                        @error('location')
                            <p class="form-text text-danger mt-0">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group my-4">
                        <label for="limit" class="form-label fs-5 mb-0">Participant Limit</label>
                        <input type="number" name="limit" id="limit" class="form-control" value="{{$event->participants_limit}}">
                        @error('limit')
                            <p class="form-text text-danger mt-0">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group my-5">
                        <div class="form-text">Exisiting Image</div>
                        <img src="{{ asset('/storage/images/'. $event->image )}}" alt="" class="w-50 mb-3 img-thumbnail">
                        <input type="file" name="image" id="image" class="form-control" value="">
                    </div>
                    <div class="form-group my-5">
                        <label for="comment" class="form-label  fs-5 mb-0">Comment</label>
                        <textarea name="comment" id="comment" cols="100" class="form-control">{{$event->comment}}</textarea>
                        @error('comment')
                            <p class="form-text text-danger mt-0">{{$message}}</p>
                        @enderror
                    </div>

                    <button type="submit" class="my-5 btn px-5 ms-3 button btn-gray float-end">Update</button>
                    <a href="{{route('admin.events.show')}}" type="button" class="my-5 btn px-5 button btn-gray float-end">Back</a>

                </form>
            </div>
        </div>

    </div>
</div>


@endsection

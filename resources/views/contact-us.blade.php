@extends('layouts.app')

@section('title', 'ContactUs')

@section('style')
    <link rel="stylesheet" href="{{ mix('css/contact-us.css') }}">
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">

            <!-- card -->
            <div class="card shadow pd-4 mb-5">

                <div class="card-header bg-white border-0">
                    <h1 class="text-center m-0 pt-5 pb-3 display-5 fw-bold contact-us-title">Contact Form</h1>
                </div>
            
                <div class="card-body">
                    <form action="{{ route('contact-us.store') }}" method="post">
                        @csrf

                        <div class="col-9 mx-auto">
                            <!-- username -->
                            <div class="mb-3">
                                <label for="name" class="form-label">User Name</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Username">

                                {{-- Error --}}
                                @error('name')
                                <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" name="email" id="email" class="form-control" placeholder="example">

                                {{-- Error --}}
                                @error('email')
                                <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" name="title" id="title" class="form-control">

                                {{-- Error --}}
                                @error('title')
                                <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- subtitle -->
                            <div class="mb-3">
                                <label for="subtitle" class="form-label">Subtitle</label>
                                <select class="form-select" name="subtitle_id">
                                    <option value="" class="dropdown-placeholder">-- Select Subtitle --</option>

                                        @foreach ($all_subtitles as $subtitle)
                                            <option value="{{ $subtitle->id }}" id="{{ $subtitle->id }}">{{ $subtitle->name }}</option>
                                        @endforeach

                                        @if (Auth::check())
                                            <option value="review">Review</option>
                                        @endif
                                
                                        {{-- Error --}}
                                        @error('subtitle-id')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                </select>
                            </div>

                            @if (Auth::check())
                                <div class="mb-3" id="rating-input" style="display: none;">
                                    <label for="rating" class="form-label">Rating this app</label>
                                    <div class="form-group">
                                        <input class="star1 radioBtnStar" type="radio" name="comment[rating]" value="1" required>
                                        <label for="star1"><i class="starPicker starIcon1 fa-solid fa-star"></i></label>
                                
                                        <input class="star2 radioBtnStar" type="radio" name="comment[rating]" value="2">
                                        <label for="star2"><i class="starPicker starIcon2 fa-solid fa-star"></i></label>
                                
                                        <input class="star3 radioBtnStar" type="radio" name="comment[rating]" value="3">
                                        <label for="star3"><i class="starPicker starIcon3 fa-solid fa-star"></i></label>
                                
                                        <input class="star4 radioBtnStar" type="radio" name="comment[rating]" value="4">
                                        <label for="star4"><i class="starPicker starIcon4 fa-solid fa-star"></i></label>
                                
                                        <input class="star5 radioBtnStar" type="radio" name="comment[rating]" value="5">
                                        <label for="star5"><i class="starPicker starIcon5 fa-solid fa-star"></i></label>
                                    </div>
                                </div>    
                            @endif

                            <!-- message -->
                            <div class="mb-3">
                                @if (Auth::check())
                                    <label for="content" class="form-label" id="comments" style="display: none;">Review Comments</label>
                                    <label for="content" class="form-label" id="message" style="display: none;">Message</label>
                                @else               
                                    <label for="content" class="form-label">Message</label>
                                @endif
                                    <textarea class="form-control" name="content" id="content" cols="30" rows="10"></textarea>

                                {{-- Error --}}
                                @error('content')
                                <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="buttons">
                                <a href="{{ url('/') }}" class="button btn-gray">Cancel</a>
                                <button type="submit" class="button btn-orange" >Submit</button>

                                {{-- Modal --}}
                                @if (session('success'))
                                <div class="modal fade success-modal" id="contact-us-result" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="contact-us-result-label" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                <div class="text-box">
                                                    <div class="modal-text">
                                                        <h3 class="h5 success-title mb-3">Thank you!</h3>
                                                        <p class="success-message">Your message has been confirmed. Check your email for details.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ mix('js/contact-us.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#contact-us-result').modal('show');
        });

        $(document).ready(function() {
        $('select[name="subtitle_id"]').change(function() {
            if ($(this).val() !== 'review') {
                $('#rating-input').hide(),
                $('#comments').hide();
                $('#message').show();
            } else {
                $('#rating-input').show(),
                $('#comments').show();
                $('#message').hide();
            }
        });
    });
    </script>

@endsection
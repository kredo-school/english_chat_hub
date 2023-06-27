@extends('layouts.app')

@section('title', 'welcome page')

@section('style')
    <link rel="stylesheet" href="{{ mix('css/welcome.css') }}">
@endsection

@section('banner')
<div class="banner" id="banner" style="background-image: url(../image/welcome/lights.png);">
    <div class="banner-text">
        <h2 class="welcoming mt-5">Welcome 
            <br>English Chat Hub
        </h2>

        <div class="message">
            <p>Do you want to be able to speak English?
            <br>
            If you're looking for somewhere you can talk  for practice in English, 
            <br>
            you just got right place!
            <br>
            In here, you can enjoy chatting with people who are as same as you. 
            <br>
            You can find the topic you're interested in, 
            <br>
            or even you can decide on new talk topic.
            <br>
            <br>
            You easily join us, you may feel it's like friends who already know. 
            <br>
            <br>
            <br>
            So Let's get started!!
            </p>
        </div>
    </div>
    <div class="start-button">
        <button class="button btn-orange">Getting Started</button>
    </div>
</div> 
@endsection

@section('content')
    <!-- About Us -->
    <div class="main">
        <div class="about-us" id="about-us" name="about-us">
            <div class="comment">
                <h2>Are you still hesitate?
                    <br>
                    In that case, let's take a look.
                </h2>
            </div>
            <div class="section-header">
                <h3 class="mx-auto">About Us</h3>
            </div>
            <div class="content">
                <p>This app provides a place where everyone who wants to learn English can <strong>easily</strong> start to communicate in English.</p>
            </div>  
        </div>

        <!-- How to use -->
        <div class="how-to-use" id="how-to-use" name="how-to-use">
            <div class="section-header">
                <h3 class="mx-auto">How to Use</h3>
            </div>
            <div class="use-item">
                <div class="row justify-content-center">
                    <div class="col-md-3">
  
                        <div class="description mx-auto" style="background-image: url({{ asset('image/welcome/bg-tag.png') }});">
                            <img src="image/welcome/chat-icon.png" alt="chat-icon" class="icon mx-auto">
                            <h4 class="title">Chat Room</h4>
                            <div class="instruction">
                                <p class="mx-auto instruct-text">You can choose a chat room matching your favorite timing, topic, and level.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-9">
                        <video controls src="video/Chat-video.mp4" class="video"></video>
                    </div>
                </div>
            </div>
            <div class="use-item">
                <div class="row justify-content-center">
                    <div class="col-md-3">
                        <div class="description mx-auto" style="background-image: url({{ asset('image/welcome/bg-tag.png') }});">
                            <img src="image/welcome/event-icon.png" alt="event-icon" class="icon mx-auto">
                            <h4 class="title">Chat Room</h4>
                            <div class="instruction">
                                <p class="mx-auto instruct-text">You can get opportunities to speak English face-to-face on any topic/level of your choice
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-9">
                        <video controls src="video/Event-video.mp4" class="video"></video>
                    </div>
                </div>
            </div>
        </div>

        <!-- Testimonial -->
        <div class="testimonial mb-5">
            <div class="section-header">
                <h3 class="mx-auto">Testimonial</h3>
            </div>
            @foreach ($all_reviewers as $reviewer)    
            <div class="reviews swiper-container">
                <div class="row justify-content-center mb-5 mt-2 swiper-wrapper">
                    <div class="col-md-1 slider-item">
                        @if($reviewer->avatar)
                        <img src="{{ asset('storage/avatars/'.$users[$loop->index]->avatar) }}" alt="" class="avatar-md" >
                        @else
                        <i class="fa-solid fa-user avatar-icon"></i>
                        @endif
                    </div>
                    <div class="col-md-3 slider-item" style="flex-direction: column;"> 
                        <div class="profile-user mt-2">
                            <div class="user-level">
                                <img src="{{ asset('image/level/'.$users[$loop->index]->level->icon)}}" alt="" width="20px" height="25px" class="">
                            </div>
                            <h3 class="username fs-3">{{ $reviewer->name }}</h3>
                        </div>
                        <div class="rating-level mt-3">
                            @for ($i = 0; $i < 5; $i++) 
                                @if ($i < $reviewer->rating)
                                <i class="starPicker fa-solid fa-star on"></i>                                          
                                @else
                                <i class="starPicker fa-solid fa-star off"></i>    
                                @endif                                  
                            @endfor
                        </div> 
                    </div>
                    <div class="col-md-8 review slider-item">
                        <p class="review-content">{{ $reviewer->content }}</p>
                    </div>
                </div>
            </div>
            <hr class="slider-item" style="height: 2px;background-color: white;border: 0;opacity: 1 !important;">
            @endforeach
        </div>

        <!-- Last message -->
        <div class="last-message mb-5">
            <div class="content">
                <p>You want to start English Chat Hub?
                <br>Register or Login first!
                </p>
                <img src="image/welcome/go-hand.png" alt="go-hand" class="go-hand mb-2">
                <button class="btn button btn-orange start">Getting Started</button>
            </div>  
        </div>
    </div>
@endsection
@extends('layouts.app')

@section('title', 'FAQ')

@section('style')
    <link rel="stylesheet" href="{{ mix('css/faq.css') }}">
@endsection

@section('content')
<div class="main">
    <div class="section-header">
        <h3 class="mx-auto">FAQ</h3>
    </div>
    <div class="row justify-content-center mb-3">
        <div class="col-md-6">
            <div class="question-box" >
                <img src="image/faq/Question-icon.png" alt="faq-icon" class="faq-icon">
                <p class="faq-text">Can I join a chat room without my Zoom account?</p>
            </div>
            <div class="answer-box">
                <img src="image/faq/Answer-icon.png" alt="faq-icon" class="faq-icon">
                <p class="faq-text">No, you can't. When you join a chat room, you're supposed to have your Zoom account.</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="question-box" style="background-color:#FFD700;">
                <img src="image/faq/Question-icon.png" alt="faq-icon" class="faq-icon">
                <p class="faq-text">Where can I check my schedule of chat rooms that I made reservation of? </p>
            </div>
            <div class="answer-box" style="background-color:#FFF;">
                <img src="image/faq/Answer-icon.png" alt="faq-icon" class="faq-icon">
                <p class="faq-text">Yes. We welcome all beginners who want to improve their English skills.</p>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mb-3">
        <div class="col-md-6">
            <div class="question-box" >
                <img src="image/faq/Question-icon.png" alt="faq-icon" class="faq-icon">
                <p class="faq-text">Do I have to register to join a chat room?</p>
            </div>
            <div class="answer-box">
                <img src="image/faq/Answer-icon.png" alt="faq-icon" class="faq-icon">
                <p class="faq-text">Yes. If you register, you can get good opportunities to communicate with someone in English online in the chat rooms.</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="question-box" style="background-color:#FFD700;">
                <img src="image/faq/Question-icon.png" alt="faq-icon" class="faq-icon">
                <p class="faq-text">Can I enter and leave the chat room in the middle of a session?</p>
            </div>
            <div class="answer-box" style="background-color:#FFF;">
                <img src="image/faq/Answer-icon.png" alt="faq-icon" class="faq-icon">
                <p class="faq-text">Yes, you can. Beside, in order to join your reserved chat room, you will need your Zoom account.</p>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mb-3">
        <div class="col-md-6">
            <div class="question-box" >
                <img src="image/faq/Question-icon.png" alt="faq-icon" class="faq-icon">
                <p class="faq-text">Can I join a chat room without showing my face?</p>
            </div>
            <div class="answer-box">
                <img src="image/faq/Answer-icon.png" alt="faq-icon" class="faq-icon">
                <p class="faq-text">Yes. We recommend to use your avatar which is one of Zoom functions instead of turning off your camera.</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="question-box" style="background-color:#FFD700;">
                <img src="image/faq/Question-icon.png" alt="faq-icon" class="faq-icon">
                <p class="faq-text">If I have any problem, what should I do?</p>
            </div>
            <div class="answer-box" style="background-color:#FFF;">
                <img src="image/faq/Answer-icon.png" alt="faq-icon" class="faq-icon">
                <p class="faq-text">If you have problem, you can report the problem in <a href="{{ route('contact-us.create') }}" class="contact-us-link">Contact Us</a> form. Select “Report” in category section.</p>
            </div>
        </div>
    </div>

    <div class="guide">
        <p class="other">Any other question?</p>
        <a href="{{ route('contact-us.create') }}" class="contact-us-link">Contact Us</a>
    </div>
</div>
@endsection

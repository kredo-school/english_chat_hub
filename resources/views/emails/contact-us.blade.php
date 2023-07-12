
    <h3>Your Contact Us Form Submission is completed</h3>

    <p>Hello, {{ $name }}</p>
    <p>We accepted your message. Your message details are as follows</p>

    <p><strong>Title:</strong> {{ $title }}</p>
    <p><strong>Subtitle:</strong> {{ $subtitle }}</p>
    <p><strong>Content:</strong> {{ $content }}</p>

    @if ($rating)
    <p><strong>Your rating of this app:</strong> {{ $rating }} /5</p>
    @endif

    <p>This message is sent to: {{ $email }}</p>
    <p>Please delete this email if you were not aware that you were going to receive it.</p>

<div class="modal fade" id="message-detail-{{ $message->id }}">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-body p-3 text-start">
            <h1 class="h3">{{ $message->name }}</h1>
             <p class="h4">Title: {{ $message->title }}</p>
             <p class="h4">Subtitle: {{ $message->subtitle->name }}</p>
             <p class="h4">From: {{ $message->email }}</p>
             <hr>
             <div class="message">
              {{ $message->content}}
             </div>

          </div>
      </div>
  </div>
</div>
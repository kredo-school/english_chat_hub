<div class="modal fade" id="message-detail-{{ $message->id }}">
  <div class="modal-dialog">
      <div class="modal-content py-5 px-2">
          <div class="modal-body p-3 text-start">
            <p class="mb-0">{{ $message->created_at }}</p>
            <div class="fs-5">
              <p class="d-inline">Name: {{ $message->name }}</h1>
              <p class="d-inline ms-5">From: {{ $message->email }}</p>
            </div>
             <p class="h3 fw-bolder my-1">Title: {{ $message->title }}</p>
             <p class="h5 fw-bold">Subtitle: {{ $message->subtitle->name }}</p>
             
             <hr>
             <div class="message">
              {{ $message->content}}
             </div>

          </div>
      </div>
  </div>
</div>
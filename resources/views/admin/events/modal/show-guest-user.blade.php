{{-- if participant dosen't have user_id, he/she should be shown as a guest --}}
<div class="modal fade" id="show-guest-{{$participant->id}}">
  <div class="modal-dialog">
      <div class="modal-content border-dark">
          <div class="modal-body p-5">
              <h2 class="modal-title mb-3">Guest User</h2>
              <div class="my-5">
                @if ($participant)
                <p class="my-5">
                  <i class="fa-solid fa-circle-user avatar-modal"></i>
                </p>
                <p class="my-3 ms-5 text-start fs-4">User Name: {{$participant->name}} </p>
                <p class="my-3 ms-5 text-start fs-4">Email: {{$participant->email}}</p>
                <p class="my-3 ms-5 text-start fs-4">Application Date: {{$participant->created_at}}</p>
                @endif
              </div>
          </div>
      </div>
  </div>
</div>


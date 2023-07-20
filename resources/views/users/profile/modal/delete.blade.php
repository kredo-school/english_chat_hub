{{-- Delete Profile --}}
<div class="modal fade" id="delete-profile-{{$user->id}}">
    <div class="modal-dialog">
        <div class="modal-content border border-2 border-danger">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>    
            <div class="modal-header border-danger">
                <h3 class="modal-title text-danger fs-3 fw-bold mx-auto">Are you sure you want to delete your account?</h3>
            </div>
            <p class="text-danger text-center mt-3">If you delete your account, your meetings and reservation for events will be also deleted.</p>
            <p class="text-muted text-center">If you would like to join again, please contact us from the "Contact Us" form.</p>

            <div class="modal-footer border-0">
                <form action="{{route('users.profile.destroy', $user->id)}}" method="post" class="mt-0">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="button btn-gray">Delete my Account</button>  
                </form>
            </div>
        </div>
    </div>
</div>

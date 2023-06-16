<div class="modal fade" id="detail-{{ $meeting->id }}">
    <div class="modal-dialog">
        <div class="modal-content position-relative">

            <div class="modal-header border-0 justify-content-center">
                <h1 class="mb-0 pb-0 text-capitalize">{{ $meeting->title }}</h1>
            </div>

            <div class="modal-body">
                <div class="col-8 mx-auto">
                    <div class="row mb-3 border-bottom">
                        <div class="col-4 fw-bold">Created By</div>
                        <div class="col">{{ date('Y-m-d', strtotime($meeting->created_at)) }}</div>
                    </div>
                    @if ($meeting->deleted_at)
                        <div class="row mb-3 border-bottom">
                            <div class="col-4 fw-bold">Deleted At</div>
                            <div class="col">{{ date('Y-m-d', strtotime($meeting->deleted_at)) }}</div>
                        </div>
                    @endif
                    <div class="row mb-3 border-bottom">
                        <div class="col-4 fw-bold">Room</div>
                        <div class="col">{{ $meeting->room()->withTrashed()->first()->name }}</div>
                    </div>
                    <div class="row mb-3 border-bottom">
                        <div class="col-4 fw-bold">Category</div>
                        <div class="col">{{ $meeting->category()->withTrashed()->first()->name }}</div>
                    </div>
                    <div class="row mb-3 border-bottom">
                        <div class="col-4 fw-bold">Level</div>
                        <div class="col">{{ $meeting->level->name }}</div>
                    </div>
                    <div class="row mb-3 border-bottom">
                        <div class="col-4 fw-bold">Date</div>
                        <div class="col">{{ $meeting->date }}</div>
                    </div>
                    <div class="row mb-3 border-bottom">
                        <div class="col-4 fw-bold">Start At</div>
                        <div class="col">{{ $meeting->start_at }} : 00~</div>
                    </div>
                </div>
            </div>

            <button type="button" data-bs-dismiss="modal" class="btn-close position-absolute top-0 end-0"></button>
            
        </div>
    </div>
</div>

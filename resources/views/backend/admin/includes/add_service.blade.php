<div class="modal fade d-print-none" id="add_service" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Service</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" action="{{route('service.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row justify-content-center">
                        <div class="form-group col-sm-12" data-children-count="1">
                            <label><strong data-children-count="0">Booking ID</strong></label>
                            <input class="form-control" readonly="" value="{{$reservation->uid}}">
                        </div>
                    </div>
                    <div class="form-row justify-content-center">
                        <div class="form-group col-sm-12" data-children-count="1">
                            <label><strong data-children-count="0">Date</strong></label>
                            <input class="form-control" name="date" readonly="" value="{{date('d/m/Y')}}">
                        </div>
                    </div>
                    <div class="form-row justify-content-center">
                        <div class="form-group col-sm-12" data-children-count="1">
                            <label><strong data-children-count="0">Select service
                                    Method</strong></label>
                            <select class="form-control" name="paid_service_id">
                                @foreach ($paid_services as $paid_service)
                                <option value="{{$paid_service->id}}">{{$paid_service->title}}
                                    ( {{$paid_service->price}} Rupee )</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="reservation_id" value="{{$reservation->id}}" type="number">
                    <div class="form-row justify-content-center">
                        <div class="form-group col-sm-12" data-children-count="1">
                            <label><strong data-children-count="0">Quantity</strong></label>
                            <input class="form-control" name="quantity" value="" placeholder="0" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@extends('backend.admin.master')
@section('title', 'Reservation')
@section('main')
<div class="main-content p-4" id="panel">
    <div>
        <div class="card-header bg-white">
            <h2>Select Room Details
            </h2>
        </div>



        @if (Session::has('success'))

        <div class="alert alert-success mt-2">{{ Session::get('success') }}</div>

        @endif

        @if (Session::has('danger'))

        <div class="alert alert-danger mt-2">{{ Session::get('danger') }}</div>

        @endif

        @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if (Session::has('details'))

        <div class="alert alert-default mt-2">{{ Session::get('details') }}</div>

        @endif

        <div class="progress-wrapper">
            <div class="progress-info">
                <div class="progress-label">
                    <span>Task completed</span>
                </div>
                <div class="progress-percentage">
                    <span>20%</span>
                </div>
            </div>
            <div class="progress">
                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="20" aria-valuemin="0"
                    aria-valuemax="100" style="width: 20%;"></div>
            </div>
        </div>

        <form action="{{ route('check_in.rooms', $guest->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-lg">Guest Name</span>
                    </div>
                    <input type="text" class="form-control" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-lg" value="{{ $guest->name }}" name="guest" required>
                    <input type="hidden" value="{{$guest->id}}" name="user_id" />
                </div>
            </div>


            {{-- <select class="form-control form-control-lg" name="room_type_id">
                <option selected="true" disabled="disabled">Select room type</option>
                @foreach ($room_types as $room_type)
                <option value="{{$room_type->id}}">{{$room_type->title}}</option>

            @endforeach
            </select> --}}
            <div class="form-row justify-content-center mt-3">

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="example-number-input" class="form-control-label">&nbsp;Adults</label>
                        <input class="form-control" type="number" value="1" id="example-number-input" name="adults"
                            required>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="example-number-input" class="form-control-label">&nbsp;Kids</label>
                        <input class="form-control" type="number" value="0" id="example-number-input" name="kids"
                            required>
                    </div>
                </div>

            </div>

            <div class="form-row justify-content-center">
                <div class="form-group col-md-6">
                    <label>Check in</label>
                    <div class="input-group date" data-provide="datepicker" data-date-format="dd/mm/yyyy">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                            </div>
                            <input value="{{ date('d/m/Y') }}" name="check_in" class="form-control datepicker"
                                placeholder="Select date" type="text" required autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label>Check out</label>
                    <div class="input-group date" data-provide="datepicker" data-date-format="dd/mm/yyyy">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                            </div>
                            <input value="{{ old('check_in') }}" name="check_out" class="form-control datepicker"
                                placeholder="Select date" type="text" required autocomplete="off">
                        </div>
                    </div>
                </div>
            </div>



            <button class="btn btn-success" type="submit">Check Available Rooms</button>
        </form>
    </div>
</div>


@endsection
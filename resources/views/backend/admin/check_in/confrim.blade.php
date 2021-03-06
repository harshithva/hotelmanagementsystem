@extends('backend.admin.master')
@section('title', 'Reservation')
@section('main')
<div class="main-content p-4" id="panel">
    <div>
        <div class="card-header bg-white">
            <h2>Check in</h2>
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

        @if (Session::has('confrim'))

        <div class="alert alert-default mt-2">{{ Session::get('confrim') }}</div>

        @endif

        <div class="progress-wrapper">
            <div class="progress-info">
                <div class="progress-label">
                    <span>Task completed</span>
                </div>
                <div class="progress-percentage">
                    <span>90%</span>
                </div>
            </div>
            <div class="progress">
                <div class="progress-bar bg-success" role="progressbar" aria-valuenow="90" aria-valuemin="0"
                    aria-valuemax="100" style="width: 90%;"></div>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-white">
                <h2>Confirm Check in
                    <a href="{{route("checkin.index")}}" class="btn btn-tsk float-right"><i class="fa fa-list"></i>Check
                        in List</a></h2>
            </div>
            <div class="card-body">
                <div class="row">

                    <div class="col-md-12">
                        <div class="form-row mb-4">
                            <div class="col-md">
                                <div class="card text-center">
                                    <div class="card-header bg-primary">
                                        <h3 class="text-white">Rooms</h3>
                                    </div>
                                    <div class="card-body">
                                        <h3>{{$reservation->roomsCount}}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="card text-center">
                                    <div class="card-header bg-primary">
                                        <h3 class="text-white">Adults</h3>
                                    </div>
                                    <div class="card-body">
                                        <h3>{{$reservation->adults}}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="card text-center">
                                    <div class="card-header bg-primary">
                                        <h3 class="text-white">Kids</h3>
                                    </div>
                                    <div class="card-body">
                                        <h3>{{$reservation->kids}}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="card text-center">
                                    <div class="card-header bg-primary">
                                        <h3 class="text-white">Nights</h3>
                                    </div>
                                    <div class="card-body">
                                        <h3>{{$reservation->nights}}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row justify-content-center">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body p-0 table-responsive">
                                        <table class="table table-sm  res-tbl mb-0">
                                            <tbody>
                                                <tr>
                                                    <table class="table table-sm borderless mb-0">
                                                        <thead class="font-weight-bold">
                                                            <tr>
                                                                <td class="sl">#</td>
                                                                <td>Check in</td>
                                                                <td>Check out</td>
                                                                <td>Rooms</td>
                                                                <td>Qty</td>

                                                                <td class="text-right">Total Price</td>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td class="sl">1.</td>
                                                                <td class="text-muted">{{$reservation->check_in}}
                                                                </td>
                                                                <td class="text-muted">{{$reservation->check_out}}
                                                                </td>
                                                                <td>
                                                                    <div>
                                                                        @foreach ($reservation->rooms as $room)


                                                                        <span class="badge badge-pill badge-success">
                                                                            {{$room->number}}</span>
                                                                        @endforeach
                                                                    </div>
                                                                </td>
                                                                <td class="text-success">{{$reservation->rooms_count}}
                                                                </td>

                                                                <td class="text-right">
                                                                    {{$reservation->total}} Rupee
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </tr>

                                                <tr>

                                                    <td class="p-0">
                                                        <table class="table table-sm borderless mb-0">
                                                            <tbody>
                                                                <tr class="font-weight-bold">
                                                                    <td colspan="3">Total TAX</td>
                                                                    <td class="text-right "><span
                                                                            class="border-top"><input type="hidden"
                                                                                value="0">
                                                                            {{$reservation->total_tax}} Rupee</span>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>

                                                    <td class="p-0">
                                                        <table class="table table-sm borderless mb-0">
                                                            <tbody>
                                                                <tr class="font-weight-bold">
                                                                    <td colspan="3">Total (Including tax)</td>
                                                                    <td class="text-right "><span
                                                                            class="border-top"><input type="hidden"
                                                                                value="0">
                                                                            {{$reservation->total_plus_tax}}
                                                                            Rupee</span>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>

                                                </tr>
                                                <!---->
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="form-row justify-content-center">
                            <div class="form-group col-sm-6 mt-2">
                                <a href="{{route('check_in.guest')}}"
                                    class="btn btn-warning btn-outline-tsk float-left">
                                    <i class="fa fa-refresh"></i> Reset
                                </a>
                                <div>
                                    <!---->
                                </div>
                                <form action="{{route('checkin.store')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="reservation" value="{{$reservation}}">
                                    <button class="btn btn-primary btn-tsk float-right" type="submit"><i
                                            class="fa fa-save"></i>
                                        Check in</button>
                                </form>

                                {{-- <a class="btn btn-danger float-right mr-1"
                                        href="{{route('reservations.rooms.select', $reservation->guest)}}"><i
                                    class="fa fa-arrow-left"></i>
                                Back</a> --}}
                            </div>

                            @endsection @section('scripts') @endsection
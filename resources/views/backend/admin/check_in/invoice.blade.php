@extends('backend.admin.master')
@section('title', 'Invoice')
@section('main')
<div class="main-content p-4" id="panel">
    <div>
        <div class="card-header bg-white d-print-none">
            <h2>Invoice
                <a class="btn btn-outline-success float-right" href="{{ route('reservations.index') }}"><i
                        class="fa fa-list"></i>&nbsp;Check In List</a>
            </h2>
            <div class="mt-3">

                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit_invoice">
                    Edit Tax
                </button>

                <button class="btn btn-outline-default btn-sm" onclick="javascript:window.print()"><i
                        class="fa fa-print">
                    </i>
                </button>

            </div>


            {{-- edit_invoice --}}
            <div class="modal fade d-print-none" id="edit_invoice" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Invoice</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="form" action="{{route('invoice.update',$reservation->invoice->id)}}"
                                method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="form-row justify-content-center">
                                    <div class="form-group col-sm-12" data-children-count="1">
                                        <label><strong data-children-count="0">Booking ID</strong></label>
                                        <input class="form-control" value="{{$reservation->uid}}" disabled>
                                    </div>
                                </div>

                                <input type="hidden" name="checkin_id" value="{{$reservation->id}}" type="number"
                                    required>
                                <div class="form-row justify-content-center">
                                    <div class="form-group col-sm-12" data-children-count="1">
                                        <label><strong data-children-count="0">Tax</strong></label>
                                        <input class="form-control" name="tax" placeholder="0.00 %" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>


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

        @if (Session::has('room'))

        <div class="alert alert-default mt-2">{{ Session::get('room') }}</div>

        @endif

        <div class="card-body bg-white">


            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active show" id="Details">
                    <div class="row mt-5">
                        <div class="col-md-12">
                            <h2 class="page-header">
                                <img src="{{ asset('backend/assets/img/brand/blue.png') }}" class="img-fluid"
                                    style="max-height: 40px">
                                <br><br>
                                <small class="pull-right">Booking ID: {{$reservation->uid}}</small><br>
                                <small class="pull-right">Invoice No: {{$reservation->invoice->invoice_no}}</small>
                            </h2>
                            <hr>
                        </div>
                    </div>
                    <div class="row invoice-info">
                        <div class="col-md-4 invoice-col">
                            Hotel Details <address> <br>
                                <strong>{{$hotel->name}}</strong><br>
                                Phone: {{$hotel->phone_number}}<br>
                                Email: {{$hotel->email}} <br>
                                Address: {{$hotel->address}} <br>
                                GSTIN: {{$hotel->gst_number}} <br>
                            </address>
                        </div>
                        <div class="col-md-4 invoice-col">
                            Guest Details <address> <br>
                                <strong>{{$reservation->user->name}}</strong><br>
                                {{$reservation->user->address ?? ""}}
                                <br>
                                Phone: {{$reservation->user->phone}}<br>
                                Email: {{$reservation->user->email}}</address>
                        </div>
                        <div class="col-md-4 invoice-col">
                            <table width="90%">
                                <tbody>
                                    <tr>
                                        {{-- <th><b>Room Type</b></th>
                                        <th>:</th>
                                        <td>Deluxe Room</td> --}}
                                    </tr>
                                    <tr>
                                        <th><b>Booking Date:</b></th>
                                        <th>:</th>
                                        <td>{{$reservation->created_at}}</td>
                                    </tr>
                                    <tr>
                                        <th><b>Check in </b></th>
                                        <th>:</th>
                                        <td> {{ date('d-M-y', strtotime($reservation->check_in)) }}</td>
                                    </tr>
                                    <tr>
                                        <th><b>Check out</b></th>
                                        <th>:</th>
                                        <td>{{ date('d-M-y', strtotime($reservation->check_out)) }}</td>
                                    </tr>
                                    <tr>
                                        <th><b>Payment Status </b></th>
                                        <th>:</th>
                                        <td>
                                            @if((($reservation->total_plus_tax + $extra + $reservation->total_tax) -
                                            $reservation->total_paid) <= 0) <span class="badge badge-success">
                                                Paid</span>
                                                @else
                                                <span class="badge badge-info">Due</span>
                                                @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th><b>Booking Status </b></th>
                                        <th>:</th>
                                        @if ($reservation->status == 'PENDING')
                                        <td><span class="badge badge-info">Pending</span></td>
                                        @elseif($reservation->status == 'CANCEL')
                                        <td><span class="badge badge-danger">Cancelled</span></td>
                                        @else
                                        <td><span class="badge badge-success">Success</span></td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <th><b>Adults</b></th>
                                        <th>:</th>
                                        <td>{{$reservation->adults}} Person</td>
                                    </tr>
                                    <tr>
                                        <th><b>Kids </b></th>
                                        <th>:</th>
                                        <td>{{$reservation->kids}} Person</td>
                                    </tr>
                                    <tr>
                                        <th><b>Nights </b></th>
                                        <th>:</th>
                                        <td>1</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 table-responsive">
                            <p class="lead text-info">Night list</p>
                            <table class=" table-sm w-100">
                                <thead class="bg-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Room</th>
                                        <td align="right"><b>Price</b></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>#</td>
                                        <td>{{ date('d-M-y', strtotime($reservation->created_at)) }}</td>
                                        <td>
                                            <div>
                                                @if (count($reservation->reservation_room) > 1)


                                                @foreach ($reservation->reservation_room as $room)


                                                <span class="badge badge-pill badge-success">
                                                    {{$room->room->number}}</span>
                                                @endforeach
                                                @endif
                                            </div>
                                        </td>
                                        <td align="right">{{$reservation->total}} Rupee</td>
                                    </tr>
                                    <tr class="border-top">
                                        <td colspan="3"><b>Total Price</b></td>
                                        <td align="right"> <b> {{$reservation->total}} Rupee</b></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table-sm w-100">
                                    <tbody>

                                        <tr>
                                            <td colspan="3" align=""><b>Extra</b></td>
                                            <td class="text-right"><b>
                                                    {{$extra}} Rupee</b></td>
                                        </tr>


                                        <tr>
                                            <td colspan="3" align=""><b>Total Tax</b></td>
                                            <td class="text-right"><b>{{$reservation->total_tax}} Rupee</b></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table-sm w-100">
                                    <tbody>
                                        <tr>
                                            <td colspan="3" align=""><b>Payable Amount</b></td>
                                            <td class="text-right">
                                                <b>{{$reservation->total_plus_tax + $extra +  $reservation->total_tax }}
                                                    Rupee</b>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-12">
                            <p class="lead text-info">Payment</p>
                            <div class="table-responsive">
                                <table class="table-sm w-100">
                                    <thead>
                                        <tr class="bg-light">
                                            <th>#</th>
                                            <th>Date</th>
                                            <th>Transaction</th>
                                            <th>Method</th>
                                            <th class="text-right">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($reservation->payment as $payment)
                                        <tr>
                                            <td>1</td>
                                            <td>{{$payment->created_at}}</td>
                                            <td>{{$payment->transaction_id}}</td>
                                            <td>{{$payment->method}}</td>
                                            <td class="text-right"> {{$payment->amount}} Rupee</td>
                                        </tr>
                                        @endforeach
                                        <tr class="border-top">
                                            <td colspan="4" align=""><b>Total Payment</b></td>
                                            <td class="text-right"><b>{{ $reservation->total_paid}} Rupee</b></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" align=""><b>Due</b></td>
                                            <td class="text-right">
                                                <b>{{($reservation->total_plus_tax + $extra +  $reservation->total_tax) - $reservation->total_paid}}
                                                    Rupee</b>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>



                @endsection

                @section('scripts')

                @endsection
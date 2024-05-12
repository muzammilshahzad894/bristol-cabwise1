<x-auth-layout pageTitle="All Bookings">

    <x-front.card>
        <div class="container mt-4 ">
            <div class="row">


                <div class="table-responsive">
                    <table id="dataTable" class="table table-striped">
                        <thead>
                        <tr>
                            <th>Request Type</th>
                            <th>Payment Type</th>
                            <th>PickUp Address</th>
                            <th>Destination Address</th>
                            <th>PickUp Date</th>
                            <th>Fleet</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Amount</th>
                            <th>Payment Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $booking)
                        <tr>
                            <td>{{$booking->request_type}}</td>
                            <td>{{$booking->payment_type}}</td>

                            <td>
                                    {{$booking->pickup_address}}
                            </td>
                            <td>
                                    <b>{{$booking->destination_address}}</b>
                            </td>
                            <td>{{$booking->pickup_date_time}}</td>
                            <td>{{$booking->fleet->title}}</td>
                            <td>{{$booking->name}}</td>
                            <td>{{$booking->phone}}</td>
                            <td>{{$booking->email}}</td>
                            <td>{{$booking->payment_amount}}</td>
                            <td>{{$booking->payment_status}}</td>

                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </x-front.card>


</x-auth-layout>

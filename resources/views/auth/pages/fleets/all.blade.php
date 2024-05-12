<x-auth-layout pageTitle="All Products">

    <x-front.card>
        <div class="container mt-4 ">
            <div class="row">

                <div class=" col-md-2 mb-3 ">
                    <a href="{{ route('fleets.create') }}"><button class="btn btn-primary">Add Fleet</button></a>
                </div>

                <div class="table-responsive">
                    <table id="dataTable" class="table table-striped">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Features</th>
                            <th>Taxes</th>
                            <th>Max Passengers</th>
                            <th>Max Suitcases</th>
                            <th>Max Hand Luggages</th>
                            <th>Banner Image</th>
                            <th>Rate</th>
                            <th>Gallery</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $fleet)

                        <tr>
                            <td>{{$fleet->title}}</td>
                            <td>{{$fleet->description}}</td>

                            <td>
                                @foreach($fleet->features as $feature)
                                    {{$feature->feature_name}}<br>
                                @endforeach
                            </td>
                            <td>

                                @foreach($fleet->taxes as $tax)
                                    <b>{{$tax->tax_title}}</b>
                                    {{$tax->tax_amount}}
                                    <br>
                                @endforeach
                            </td>
                            <td>{{$fleet->max_passengers}}</td>
                            <td>{{$fleet->max_suitcases}}</td>
                            <td>{{$fleet->max_hand_luggage}}</td>

                            <td><img src="{{asset('storage/'.$fleet->banner_image)}}" alt="null" style="width:40px"></td>
                            <td>{{$fleet->rate}}</td>
                            <td><a href="{{route('fleets-gallery',$fleet->id)}}"><button
                                        class="btn btn-dark">Gallery</button></a></td>
                            <td><a href="{{route('fleets.edit',$fleet->id)}}"><button
                                        class="btn btn-primary">Edit</button></a></td>
                            <td><a href="{{route('fleets-destroy',$fleet->id)}}"><button
                                        class="btn btn-danger">Delete</button></a></td>

                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>


    </x-front.card>


</x-auth-layout>

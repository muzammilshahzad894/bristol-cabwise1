<x-auth-layout pageTitle="Gallery">

    <x-front.card>
        <div class="container mt-4">
            <div class="row">

                <table class="table table-bordered">
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Images</th>
                        <th colspan="2">Action</th>
                    </tr>
                    @if($data!=null)
                    @foreach(json_decode($data->imageUrl(),true) as $img)
                    <tr>
                        <td> {{ $img['title'] }}</td>
                        <td> {{ $img['description'] }}</td>
                        <td> <img src="{{asset('storage/'.$img['url'])}}" alt="null" style="width:100px;"></td>
                        <td><a href="{{route('img-edit',$img['id'])}}"><button class="btn btn-primary">Edit</button></a>
                        </td>
                        <td><a href="{{route('img-delete',$img['id'])}}"><button
                                    class="btn btn-danger">Delete</button></a></td>
                    </tr>
                    @endforeach
                    @endif
                </table>


            </div>
        </div>

    </x-front.card>


</x-auth-layout>

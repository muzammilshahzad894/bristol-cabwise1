<x-auth-layout pageTitle="Taxes">

    <x-front.card>
        <div class="container mt-4">
            <div class="row">

                <table class="table table-bordered">
                    @displayErrors
                    <tr>
                        <th>Title</th>
                        <th>Amount</th>
                        <th colspan="2">Action</th>
                    </tr>
                    @if($data!=null)
                    @foreach($data as $tax)
                    <tr>
                        <td> {{ $tax->tax_title }}</td>
                        <td> {{ $tax->tax_amount}}</td>
                        <td><a href="{{route('edit-taxes',$tax->id)}}"><button class="btn btn-primary">Edit</button></a>
                        </td>
                        <td><a href="{{route('delete-taxes',$tax->id)}}"><button
                                    class="btn btn-danger">Delete</button></a></td>
                    </tr>
                    @endforeach
                    @endif
                </table>


            </div>
        </div>

    </x-front.card>


</x-auth-layout>

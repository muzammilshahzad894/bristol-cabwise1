<x-auth-layout pageTitle="Edit Taxes">

    <x-front.card>
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-md-8 mt-3">
                    <form action="{{route('update-taxes',$data->id)}}" method="post" enctype="multipart/form-data">
                        @method('PUT')
                        @displayErrors
                        @csrf
                        <label for="tax_title" class="form-label">Title</label>
                        <input type="text" name="tax_title" class="form-control mb-3" value="{{ $data->tax_title }}">
                        <label for="tax_amount" class="form-label">Title</label>
                        <input type="text" name="tax_amount" class="form-control mb-3" value="{{ $data->tax_amount }}">
                        <input type="submit" class="btn btn-primary form-control mt-2">
                    </form>
                </div>

            </div>
        </div>
    </x-front.card>

</x-auth-layout>

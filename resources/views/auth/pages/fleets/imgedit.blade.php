<x-auth-layout pageTitle="Edit Image">

    <x-front.card>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <img src="{{asset('storage/'.$data['url'])}}" alt="null" style="width:200px">
                </div>

                <div class="col-md-8 mt-3">
                    <form action="{{route('img-update',$data->id)}}" method="post" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" class="form-control mb-3" value="{{ $data->title }}">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control mb-2" id="description" name="description" rows="3" >{{ $data->description }}</textarea>
                        <input type="file" name="image" class="form-control">
                        <input type="submit" class="btn btn-primary form-control mt-2">
                    </form>
                </div>

            </div>
        </div>
    </x-front.card>

</x-auth-layout>

<x-auth-layout pageTitle="Update Fleets">
    <x-front.card>
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-12">
                    @if($data)
                    <form action="{{ route('fleets.update', $data->id) }}" method="post" enctype="multipart/form-data">
                        @displayErrors
                        @method('PUT')
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ $data->title }}" required>
                        </div>
                        <!-- Description textarea -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required>{{ $data->description }}</textarea>
                        </div>
                        <!-- Features input -->
                        <div class="mb-3">
                            <label for="features" class="form-label">Features</label>
                            @foreach($data->features as $feature)
                                <input type="text" class="form-control mt-2" id="features" name="feature_name[]" value="{{ $feature->feature_name }}" required>
                            @endforeach
                        </div>
                        <!-- Features input -->
                        <div class="mb-3">
                            <label for="tex" class="form-label">Taxes</label>:<br>
                            @foreach($data->taxes as $tax)
                                <label for="tax_title">Tax Title</label>
                                <input type="text" class="form-control mt-2" id="tax_title" name="tax_title[]" value="{{ $tax->tax_title }}" required>
                                <label>Tax Amount</label>
                                <input type="number" class="form-control mt-2" id="tax_title" name="tax_amount[]" value="{{ $tax->tax_amount }}" required>
                            @endforeach
                        </div>
                        <!-- Max Passengers input -->
                        <div class="mb-3">
                            <label for="max_passengers" class="form-label">Max Passengers</label>
                            <input type="number" class="form-control" id="max_passengers" name="max_passengers" value="{{ $data->max_passengers }}" required>
                        </div>
                        <!-- Max Suitcases input -->
                        <div class="mb-3">
                            <label for="max_suitcases" class="form-label">Max Suitcases</label>
                            <input type="number" class="form-control" id="max_suitcases" name="max_suitcases" value="{{ $data->max_suitcases }}" required>
                        </div>
                        <!-- Max Hand Luggage input -->
                        <div class="mb-3">
                            <label for="max_hand_luggage" class="form-label">Max Hand Luggage</label>
                            <input type="number" class="form-control" id="max_hand_luggage" name="max_hand_luggage" value="{{ $data->max_hand_luggage }}" required>
                        </div>
                        <!-- Rate input -->
                        <div class="mb-3">
                            <label for="rate" class="form-label">Rate</label>
                            <input type="number" class="form-control" id="rate" name="rate" value="{{ $data->rate }}" required>
                        </div>
                        <!-- Banner Image input -->
                        <div class="mb-3">
                            <label for="banner_image" class="form-label">Choose Banner Image</label>
                            <input type="file" class="form-control" id="banner_image" name="banner_image">
                        </div>
                        <!-- Display the current banner image -->
                        <div class="mb-3">
                            <label for="current_banner_image" class="form-label">Current Banner Image</label><br>
                            <img src="{{ asset('storage/'.$data->banner_image) }}" alt="Current Banner Image" style="max-width: 200px;">
                        </div>
                        <!-- Submit button -->
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </x-front.card>
</x-auth-layout>

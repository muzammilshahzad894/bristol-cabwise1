<x-auth-layout pageTitle="Create Fleets">
    <x-front.card>
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('fleets.store') }}" method="post" enctype="multipart/form-data">
                        @displayErrors
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <!-- Description textarea -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="features" class="form-label">Enter Feature Name</label>
                            <div id="featureFields">
                                <input type="text" class="form-control mb-2" name="feature_name[]" required>
                            </div>
                            <button type="button" class="btn btn-secondary" id="addFeature">Add Feature</button>
                        </div>
                        <div class="mb-3">
                            <label for="max_passengers" class="form-label">Max Passengers</label>
                            <input type="number" class="form-control" id="max_passengers" name="max_passengers" required>
                        </div>
                        <div class="mb-3">
                            <label for="max_suitcases" class="form-label">Max Suitcases</label>
                            <input type="number" class="form-control" id="max_suitcases" name="max_suitcases" required>
                        </div>
                        <div class="mb-3">
                            <label for="max_hand_luggage" class="form-label">Max Hand Luggage</label>
                            <input type="number" class="form-control" id="max_hand_luggage" name="max_hand_luggage" required>
                        </div>
                        <div class="mb-3">
                            <label for="rate" class="form-label">Rate</label>
                            <input type="number" class="form-control" id="rate" name="rate" required>
                        </div>

                        <!-- Banner Image input -->
                        <div class="mb-3">
                            <label for="banner_image" class="form-label">Choose Banner Image</label>
                            <input type="file" class="form-control" id="banner_image" name="banner_image" required>
                        </div>

                        <!-- Additional Gallery Image Fields (to be added dynamically) -->
                        <div id="additionalImages"></div>

                        <!-- Add Image button -->
                        <div class="mb-3">
                            <button type="button" class="btn btn-secondary mt-2" id="addImage">Add Image</button>
                        </div>

                        <!-- Tax fields -->
                        <div id="additionalTaxes"></div>

                        <!-- Add Tax button -->
                        <div class="mb-3">
                            <button type="button" class="btn btn-secondary mt-2" id="addTax">Add Tax</button>
                        </div>

                        <!-- Submit button -->
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </x-front.card>

    <script>
        // Function to dynamically add additional image fields
        document.getElementById("addImage").addEventListener("click", function() {
            // Create new div for additional image fields
            var div = document.createElement("div");
            div.classList.add("additional-image-fields", "mb-3");

            // Image Title input
            var titleLabel = document.createElement("label");
            titleLabel.setAttribute("for", "imageTitle");
            titleLabel.classList.add("form-label");
            titleLabel.textContent = "Image Title";
            var titleInput = document.createElement("input");
            titleInput.setAttribute("type", "text");
            titleInput.classList.add("form-control");
            titleInput.setAttribute("name", "image_title[]");
            titleInput.required = true;

            // Image Description textarea
            var descriptionLabel = document.createElement("label");
            descriptionLabel.setAttribute("for", "imageDescription");
            descriptionLabel.classList.add("form-label");
            descriptionLabel.textContent = "Image Description";
            var descriptionTextarea = document.createElement("textarea");
            descriptionTextarea.classList.add("form-control");
            descriptionTextarea.setAttribute("rows", "3");
            descriptionTextarea.setAttribute("name", "image_description[]");
            descriptionTextarea.required = true;

            // Image input
            var imageLabel = document.createElement("label");
            imageLabel.setAttribute("for", "image");
            imageLabel.classList.add("form-label");
            imageLabel.textContent = "Choose Image";
            var imageInput = document.createElement("input");
            imageInput.setAttribute("type", "file");
            imageInput.classList.add("form-control");
            imageInput.setAttribute("name", "images[]");
            imageInput.required = true;

            // Append elements to div
            div.appendChild(titleLabel);
            div.appendChild(titleInput);
            div.appendChild(descriptionLabel);
            div.appendChild(descriptionTextarea);
            div.appendChild(imageLabel);
            div.appendChild(imageInput);

            // Append div to container
            document.getElementById("additionalImages").appendChild(div);
        });

        // Function to dynamically add additional tax fields
        document.getElementById("addTax").addEventListener("click", function() {
            // Create new div for additional tax fields
            var div = document.createElement("div");
            div.classList.add("additional-tax-fields", "mb-3");

            // Tax Title input
            var titleLabel = document.createElement("label");
            titleLabel.setAttribute("for", "taxTitle");
            titleLabel.classList.add("form-label");
            titleLabel.textContent = "Tax Title";
            var titleInput = document.createElement("input");
            titleInput.setAttribute("type", "text");
            titleInput.classList.add("form-control");
            titleInput.setAttribute("name", "tax_title[]");
            titleInput.required = true;

            // Tax Amount input
            var amountLabel = document.createElement("label");
            amountLabel.setAttribute("for", "taxAmount");
            amountLabel.classList.add("form-label");
            amountLabel.textContent = "Tax Amount";
            var amountInput = document.createElement("input");
            amountInput.setAttribute("type", "number");
            amountInput.classList.add("form-control");
            amountInput.setAttribute("name", "tax_amount[]");
            amountInput.required = true;

            // Append elements to div
            div.appendChild(titleLabel);
            div.appendChild(titleInput);
            div.appendChild(amountLabel);
            div.appendChild(amountInput);

            // Append div to container
            document.getElementById("additionalTaxes").appendChild(div);
        });

        // Function to dynamically add additional feature fields
        document.getElementById("addFeature").addEventListener("click", function() {
            var featureContainer = document.getElementById("featureFields");

            // Create new input field for features
            var input = document.createElement("input");
            input.type = "text";
            input.classList.add("form-control", "mb-2");
            input.setAttribute("name", "feature_name[]");
            input.required = true;

            // Append input field to the container
            featureContainer.appendChild(input);
        });
    </script>
</x-auth-layout>

<script>
    const uploadImagesInput = document.getElementById('images');
    const imagesPreviewContainer = document.getElementById('imagesPreviewContainer');

    uploadImagesInput.addEventListener('change', (event) => {
        // Clear previous preview images
        imagesPreviewContainer.innerHTML = '';

        /**
         * Go through all uploaded files and create following structure:
         * <div>
         *   <img /> (image itself)
         *   <span>image.png</span> (image filename)
         *   <button>X</button> (delete button positioned in the top right corner of an image)
         * </div>
        */
        Array.from(event.target.files).forEach((file) => {
            const div = document.createElement('div');
            div.classList.add('col-md-3', 'mb-3', 'text-center', 'image-container');

            const img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            img.classList.add('img-fluid', 'me-2');

            const span = document.createElement('span');
            span.innerHTML = file.name;

            const deleteButton = document.createElement('button');
            deleteButton.textContent = 'X';
            deleteButton.classList.add('image-remove-button');
            deleteButton.addEventListener('click', () => {
                div.remove();
                const files = Array.from(event.target.files);
                const index = files.indexOf(file);
                if (index !== -1) {
                    files.splice(index, 1);

                    const dataTransfer = new DataTransfer();
                    files.forEach((file) => dataTransfer.items.add(file));

                    event.target.files = dataTransfer.files;
                }

                if (imagesPreviewContainer.innerHTML === '') {
                    const i = document.createElement('i');
                    i.classList.add('mx-2');
                    i.innerHTML = 'No Uploaded images yet.';

                    imagesPreviewContainer.appendChild(i);
                }
            });

            div.appendChild(img);
            div.appendChild(span);
            div.appendChild(deleteButton);
            imagesPreviewContainer.appendChild(div);
        });
    });
</script>
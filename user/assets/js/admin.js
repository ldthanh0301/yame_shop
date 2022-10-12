const imageInput = document.getElementById('image');
const reviewImage = document.getElementById('review-image');
if(imageInput) {
    imageInput.onchange = function(e) {
        let files = Array.from(imageInput.files);
        let srcImages =files.map(file=>URL.createObjectURL(file));
        let row = document.createElement('row');
        row.className= 'row';

        imagesBox =srcImages.map(src =>`
            <div class='col-2'>
                <img src='${src}' class='img-fluid' alt='ảnh'>
            </div>`);

        
        row.innerHTML = imagesBox.join('');
        reviewImage.replaceChildren(row);
    }
}
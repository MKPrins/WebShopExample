var SELECTORS = {
    FILE_INPUT: '.product-image-input',
    IMAGE_PREVIEW: '.product-image-preview'
};

$(document).ready(function () {

    $(SELECTORS.FILE_INPUT).on('change', previewImage);

    function previewImage (event) {
        var file = $(SELECTORS.FILE_INPUT)[0].files[0];
        var reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = function () {
            $(SELECTORS.IMAGE_PREVIEW).attr('src', reader.result);
        };
        reader.onerror = function (error) {
            console.log('Error: ', error);
        };
    }

});

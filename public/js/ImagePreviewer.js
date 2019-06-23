var SELECTORS = {
    PRODUCT_FORM: '#product-form',
    FILE_INPUT: '.product-image-input',
    RESIZED_FILE_INPUT: '.product-image-resized-input',
    IMAGE_PREVIEW: '.product-image-preview',
};

$(document).ready(function () {

    // var _FormData = new FormData($(SELECTORS.PRODUCT_FORM)[0]);
    //
    // $(SELECTORS.PRODUCT_FORM).on('submit', function(event){
    //     event.preventDefault();
    //
    // });

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

    // function resizeImage (event) {
    //     console.log('RESIZE Image');
    //     var file = $(SELECTORS.FILE_INPUT)[0].files[0];
    //     console.log('file', file);
    //
    //     var reader = new FileReader();
    //     reader.onload = function (readerEvent) {
    //         console.log('Reader onLoad');
    //         console.log('readerEvent', readerEvent);
    //
    //         var image = new Image();
    //         image.onload = function (imageEvent) {
    //             console.log(imageEvent);
    //
    //             var canvas = document.createElement('canvas'),
    //                 max_size = 544,
    //                 width = image.width,
    //                 height = image.height;
    //
    //             if (width > height) {
    //                 if (width > max_size) {
    //                     height *= max_size / width;
    //                     width = max_size;
    //                 }
    //             } else {
    //                 if (height > max_size) {
    //                     width *= max_size / height;
    //                     height = max_size;
    //                 }
    //             }
    //
    //             canvas.width = width;
    //             canvas.height = height;
    //
    //             canvas.getContext('2d').drawImage(image, 0, 0, width, height);
    //             var dataUrl = canvas.toDataURL('image/jpeg');
    //             var resizedImage = dataURLToFile(dataUrl, 'test.png');
    //
    //             console.log('MARCO dataUrl', dataUrl);
    //             console.log('MARCO resizedImage', resizedImage);
    //
    //             _FormData.append('thumb', resizedImage);
    //
    //             // $(SELECTORS.RESIZED_FILE_INPUT)[0].files[0] = resizedImage;
    //             // console.log('MARCO $(SELECTORS.RESIZED_FILE_INPUT)[0].files', $(SELECTORS.RESIZED_FILE_INPUT)[0].files);
    //         };
    //
    //         image.src = readerEvent.target.result;
    //     };
    //     reader.readAsDataURL(file);
    // }
    //
    // function dataURLToFile (dataURL, fileName) {
    //     var BASE64_MARKER = ';base64,';
    //     if (dataURL.indexOf(BASE64_MARKER) == -1) {
    //         var parts = dataURL.split(',');
    //         var contentType = parts[0].split(':')[1];
    //         var raw = parts[1];
    //
    //         return new Blob([raw], {type: contentType});
    //     }
    //
    //     var parts = dataURL.split(BASE64_MARKER);
    //     var contentType = parts[0].split(':')[1];
    //     var raw = window.atob(parts[1]);
    //     var rawLength = raw.length;
    //
    //     var uInt8Array = new Uint8Array(rawLength);
    //
    //     for (var i = 0; i < rawLength; ++i) {
    //         uInt8Array[i] = raw.charCodeAt(i);
    //     }
    //
    //     var blob = new Blob([uInt8Array], {type: contentType});
    //     // blob.lastModifiedDate = new Date();
    //     // blob.name = fileName;
    //
    //     var file = new File([blob], fileName, {lastModified: 1534584790000});
    //
    //     return file;
    // }

});

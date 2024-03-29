(function($) {
    var counter = 0;

    var DEFAULTS = {
        url: 'server/upload.php',

        crop: {
            aspectRatio: null,
            minSize: null,
            maxSize: null,
            setSelect: null
        },

        savingMessage: 'Saving...',
        loadingMessage: 'Loading...',
        uploadingMessage: 'Uploading...',
        invalidResponseMessage: 'Invalid server response.',
        cameraErrorMessage: 'Could not access the camera. ',
        cameraFallbackMessage: 'Your browser does not support camera.',
        minCropHeightMessage: 'Crop selection requires a height of :size.',
        maxCropWidthMessage: 'Crop selection exceeds maximum width of :size',
        maxCropHeightMessage: 'Crop selection exceeds maximum height of :size.',
        minCropWidthMessage: 'Crop selection requires a minimum width of :size.',
    };

    window.ImgSelect = function(container, options) {
        this.options = $.extend({}, DEFAULTS, options || {});

        this._container  = container;
        this._alert      = container.find('.imgs-alert');
        this._crop       = container.find('.imgs-crop-container');
        this._camera     = container.find('.imgs-webcam-container');
        this._saveBtn    = container.find('.imgs-save');
        this._cancelBtn  = container.find('.imgs-cancel');
        this._captureBtn = container.find('.imgs-capture');

        this.init();
    }

    ImgSelect.prototype.init = function() {
        counter += 1;

        navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia ||
                                navigator.mozGetUserMedia;

        // Upload btn event
        this._container.find('.imgs-upload').append('<input type="file" name="file">')
                        .on('change', this.upload.bind(this));

        // Camera btn event
        this._container.find('.imgs-webcam').on('click', this.camera.bind(this));
    }

    ImgSelect.prototype.getData = function() {
        if (typeof this.options.data === 'function') {
            return this.options.data();
        }

        return this.options.data || {};
    }

    // Upload click event
    ImgSelect.prototype.upload = function(event) {
        var iframe, form, self = this,
        fileInput = $(event.target),
        fileInputClone = fileInput.clone();

        this.removeCrop();
        this.removeCamera();
        this.alert(this.options.uploadingMessage, 2);

        // Create & add iframe to body
        iframe = $('<iframe name="iframe-transport-'+counter+'" style="display:none;"></iframe>');
        iframe.appendTo('body');

        // Add load event
        iframe.on('load', function() {
            var response = null;

            try {
                response = iframe.contents().find('body').html();
                response = $.parseJSON(response);
            } catch (e) {}

            if (response) {
                self.uploadDone(response);
            } else {
                self.alert(self.options.invalidResponseMessage, 3);
            }

            window.setTimeout(function() {
                // Remove the iframe & form
                iframe.remove();
                form.remove();
                 // Add the file button back
                $(event.currentTarget).append(fileInputClone);
            }, 100);

        });

        // Create form
        form = $('<form style="display:none;"><form/>');
        form.prop('method', 'POST');
        form.prop('action', this.options.url);
        form.prop('target', iframe.prop('name'));
        form.prop('enctype', 'multipart/form-data');
        form.prop('encoding', 'multipart/form-data');
        form.append(fileInput);
        form.append('<input type="hidden" name="action" value="upload"/>');

        // Add custom data to the form
        $.each(this.getData(), function(name, value) {
            $('<input type="hidden"/>')
                .prop('name', 'data['+name+']')
                .val(value)
                .appendTo(form);
        });

        // Add & submit the form
        form.appendTo('body');
        form.submit();
    }

    // Camera click event
    ImgSelect.prototype.camera = function() {
        var self = this, captureCallback,

        saveImage = function(imageData) {
            self.alert(self.options.uploadingMessage, 2);
            $.ajax({
                url: self.options.url,
                type: 'POST',
                dataType: 'json',
                data: {
                    action: 'upload',
                    file: imageData,
                    data: self.getData(),
                }
            })
            .done(function(response) { self.uploadDone(response) })
            .fail(function() { self.alert(self.options.invalidResponseMessage, 3) });
        };

        this.removeCamera();
        this.removeCrop();
        this._camera.show();
        this.alert(0);

        self._cancelBtn.on('click', self.removeCamera.bind(self));

        if (!!navigator.getUserMedia && !!window.URL) {
            var video = $('<video autoplay style="display:none"></video>');
            this._camera.html(video);

            navigator.getUserMedia({video: true}, function (stream) {
                this._stream = stream;

                video.attr('src', window.URL.createObjectURL(stream));
                video.show();

                self._captureBtn.show();
                self._cancelBtn.show();

                self._captureBtn.on('click', function() {
                    var canvas = document.createElement('canvas'),
                        ctx = canvas.getContext('2d');

                    canvas.width  = video[0].videoWidth;
                    canvas.height = video[0].videoHeight;
                    ctx.drawImage(video[0], 0, 0);

                    self.removeCamera();

                    saveImage( canvas.toDataURL('image/png').replace('data:image/png;base64,', '') );
                });

            }, function(error) {
                self.alert(self.options.cameraErrorMessage + error.name, 3);
            });
        } else {
            self.alert(self.options.cameraFallbackMessage, 3);
        }
    }

    // Upload complete
    ImgSelect.prototype.uploadDone = function(response) {
        if (response.success) {
            this.alert(0);

            if (this.options.uploadComplete) {
                this.options.uploadComplete(response.data);
            }

            if (this.options.crop) {
                this.crop(response.data.url)
            }

        } else {
            this.alert(response.data || this.options.invalidResponseMessage, 3);
        }
    }

    // Show cropper
    ImgSelect.prototype.crop = function(imageUrl) {
        this.removeCrop();

        this._cancelBtn.on('click', this.removeCrop.bind(this));

        var self = this, img = new Image(),
        options = this.options.crop,
        coords,
        updateCoords = function(_coords) {
            coords = _coords;
        },
        jcrop = {
            onChange: updateCoords,
            onRelease: updateCoords
        };

        if (options.aspectRatio) jcrop.aspectRatio = options.aspectRatio;
        if (options.setSelect) jcrop.setSelect = options.setSelect;
        if (options.minSize) jcrop.minSize = options.minSize;
        if (options.maxSize) jcrop.maxSize = options.maxSize;

        self.alert(self.options.loadingMessage, 2);

        img.onload = function() {
            self.alert(0);
            self._cancelBtn.show();

            jcrop.trueSize = [img.width, img.height];

            var image = $('<img src="'+imageUrl+'?'+new Date().getTime()+'">').appendTo(self._crop);

            window.setTimeout(function() {
                image.Jcrop(jcrop);
            }, 100);

            self._crop.show();

            self._saveBtn.on('click', function() {

                if (!self.validateCrop(coords||{})) return;

                self._saveBtn.prop('disabled', true);
                self.alert(self.options.savingMessage, 2);

                $.ajax({
                    url: self.options.url,
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        action: 'crop',
                        image: imageUrl.substr(imageUrl.lastIndexOf('/') + 1, imageUrl.length),
                        coords: coords,
                        data: self.getData(),
                    }
                })
                .done(function(response) {
                    if (response.success) {
                        self.alert(0);
                        self.removeCrop();

                        if (self.options.cropComplete)
                            self.options.cropComplete(response.data);

                    } else {
                        self.alert(response.data || self.options.invalidResponseMessage, 3);
                    }
                })
                .fail(function() { self.alert(self.options.invalidResponseMessage, 3) })
                .always(function() { self._saveBtn.prop('disabled', false) });

            }).show();

        };

        img.src = imageUrl;
    }

    // Crop validation
    ImgSelect.prototype.validateCrop = function(coords) {
        var o = this.options.crop,
        error = function(message, size) {
            return this.alert(message.replace(':size', size), 3);
        };

        if (o.minSize) {
            if (o.minSize[0] && (coords.w||0) < o.minSize[0]) {
               return error(this.options.minCropWidthMessage, o.minSize[0]);
            }

            if (o.minSize[1] && (coords.h||0) < o.minSize[1]) {
                return error(this.options.minCropHeightMessage, o.minSize[1]);
            }
        }

        if (o.maxSize) {
            if (o.maxSize[0] && (coords.w||0) > o.maxSize[0]) {
                return error(this.options.maxCropWidthMessage, o.maxSize[0]);
            }

            if (o.maxSize[1] && (coords.h||0) > o.maxSize[1]) {
               return error(this.options.maxCropHeightMessage, o.maxSize[1]);
            }
        }

        return true;
    }

    // Remove camera
    ImgSelect.prototype.removeCamera = function() {
        try { this._stream.getTracks()[0].stop(); } catch (e) { }
        delete this._stream;
        this._camera.html('');
        this._captureBtn.off('click').hide();
        this._cancelBtn.off('click').hide();
    }

    // Remove crop
    ImgSelect.prototype.removeCrop = function() {
        $(this._crop).html('');
        this._saveBtn.off('click').hide();
        this._cancelBtn.off('click').hide();
    }

    ImgSelect.prototype.alert = function(message, type) {
        if (this.options.alert) {
            return this.options.alert(message, type);
        }

        if (!message) {
            return $(this._alert).hide();
        }

        $(this._alert).html(message)
            .removeClass((type==1?'alert-danger alert-warning':type==2?'alert-danger alert-success':'alert-warning alert-danger'))
            .addClass('alert-'+(type==1?'success':type==2?'warning':'danger'))
            .show();
    }
})(jQuery);

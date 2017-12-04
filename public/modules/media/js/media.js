$.ajaxSetup({
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
});
var media = new Vue({
    el: '#dinhtrong-media-modal',
    data: {
        assetUrl: baseUrl + '/uploads',
        baseUrl: baseUrl,
        fromPublic: '',
        directories: [],
        files: [],
        current: '',
        breadcrumbs: [],
        checkall: false,
        filesChecked: [],
        directoriesChecked: [],
        newFolderName: "new folder",
        allowMultile: false,
        canSelect: false,
        destination: null,
        inputName: "file"
    },
    filters: {
    },
    computed: {
    }
    ,
    methods: {
        load: function (path) {
            var that = this;
            this.checkall = false;
            this.filesChecked = [];
            this.directoriesChecked = [];
            this.fromPublic = this.assetUrl.replace(this.baseUrl, '');
            var data = {};
            if (typeof path !== 'undefiend') {
                data.dir = path;
            }
            $.get(baseUrl + '/nfladmin/directory', data, function (res) {
                that.directories = res.data.directories;
                that.files = res.data.files;
                that.current = res.data.current;

                var brc = [{
                        path: '/',
                        name: 'Home'
                    }];
                if (that.current !== '') {
                    var urlState = '';
                    var currentArr = that.current.split("/");
                    $.each(currentArr, function (index, value) {
                        if (value) {
                            urlState += '/' + value;
                            brc.push({
                                path: urlState,
                                name: value
                            });
                        }
                    });
                }
                that.breadcrumbs = brc;
                that.loadUploader();
            });
        },
        loadUploader: function () {
            var that = this;
            var uploader = new ss.SimpleUpload({
                button: 'upload-btn',
                url: baseUrl + '/nfladmin/file/upload', // server side handler
                progressUrl: baseUrl + '/nfladmin/file/progress', // enables cross-browser progress support (more info below)
                responseType: 'json',
                name: 'file',
                multiple: true,
                //allowedExtensions: ['jpg', 'jpeg', 'png', 'gif'], // for example, if we were uploading pics
                hoverClass: 'ui-state-hover',
                focusClass: 'ui-state-focus',
                disabledClass: 'ui-state-disabled',
                customHeaders: {
                    'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr("content")
                },
                data: {current: that.current},
                onSubmit: function (filename, extension) {
                    // Create the elements of our progress bar
                    var progress = document.createElement('div'), // container for progress bar
                            bar = document.createElement('div'), // actual progress bar
                            fileSize = document.createElement('div'), // container for upload file size
                            wrapper = document.createElement('div'), // container for this progress bar
                            //declare somewhere: <div id="dinhtrong-media-progress-box"></div> where you want to show the progress-bar(s)
                            progressBox = document.getElementById('dinhtrong-media-progress-box'); //on page container for progress bars

                    // Assign each element its corresponding class
                    progress.className = 'progress progress-striped';
                    bar.className = 'progress-bar progress-bar-success';
                    fileSize.className = 'size';
                    wrapper.className = 'wrapper';

                    // Assemble the progress bar and add it to the page
                    progress.appendChild(bar);
                    wrapper.innerHTML = '<div class="name">' + filename + '</div>'; // filename is passed to onSubmit()
                    wrapper.appendChild(fileSize);
                    wrapper.appendChild(progress);
                    progressBox.appendChild(wrapper); // just an element on the page to hold the progress bars    

                    // Assign roles to the elements of the progress bar
                    this.setProgressBar(bar); // will serve as the actual progress bar
                    this.setFileSizeBox(fileSize); // display file size beside progress bar
                    this.setProgressContainer(wrapper); // designate the containing div to be removed after upload
                },
                // Do something after finishing the upload
                // Note that the progress bar will be automatically removed upon completion because everything 
                // is encased in the "wrapper", which was designated to be removed with setProgressContainer() 
                onComplete: function (filename, response) {
                    if (!response) {
                        alert(filename + 'upload failed');
                        return false;
                    } else {
                        that.files.push(response);
                    }

                },
                onError: function () {
                    alert('Upload failed');
                }
            });
        },
        checkFile: function (file) {
            this.filesChecked.push(file);
        },
        checkDirectory: function (dir) {
            this.directoriesChecked.push(dir);
        },
        remove: function () {
            var message = null;
            if (this.filesChecked.length && this.directoriesChecked.length) {
                message = "Are you sure want to delete " + this.filesChecked.length + " files" +
                        " and " + this.directoriesChecked.length + " directories ?";
            } else if (this.filesChecked.length) {
                message = "Are you sure want to delete " + this.filesChecked.length + " files ?";
            } else if (this.directoriesChecked.length) {
                message = "Are you sure want to delete " + this.directoriesChecked.length + " directories ?";
            }
            if (message === null) {
                return false;
            } else if (confirm(message)) {
                var that = this;

                var data = {files: this.filesChecked, directories: this.directoriesChecked};

                var fileSortPaths = that.files.map(function (x) {
                    return x.sortPath;
                });
                $.each(this.filesChecked, function (index, file) {
                    that.files.splice(fileSortPaths.indexOf(file), 1);
                });

                var directorySortPath = that.directories.map(function (x) {
                    return x.sortPath;
                });
                $.each(this.directoriesChecked, function (index, dir) {
                    that.directories.splice(directorySortPath.indexOf(dir), 1);
                });

                $.post(baseUrl + '/nfladmin/directory/delete', data, function (res) {
                    that.filesChecked = [];
                    that.directoriesChecked = [];
                });
            }
        },
        loadCreateFolderModal: function () {
            $('#dinhtrong-media-new-folder-modal').modal('show');
        },
        hideCreateFolderModal: function () {
            $('#dinhtrong-media-new-folder-modal').modal('hide');
        },
        createNewFolder: function () {
            var data = {current: this.current, name: this.newFolderName};
            var that = this;
            $.post(baseUrl + '/nfladmin/directory/create', data, function (res) {
                that.directories.push(res);
                $('#dinhtrong-media-new-folder-modal').modal('hide');
            }).fail(function (response) {
                alert('Error: ' + response.responseText);
            })
                    ;
        },
        select: function () {
            var des = $(this.destination);
            des.html('');
            var that = this;
            $.each(this.filesChecked, function (index, file) {
                var isImage = file.match(/\.(jpeg|jpg|gif|png)$/);
                if (isImage) {
                    var html = "<div class='file-selected'>" +
                            "<input type='hidden' name='" + that.inputName + "' value='" + that.fromPublic + file + "' />" +
                            "<img src='" + that.assetUrl + file + "' class='thumbnail img-responsive' />" +
                            "<button onclick='removeFileSelected(this)' type='button' class='btn btn-danger btn-sm'>&Cross;</button>" +
                            "</div>";
                } else {
                    var html = "<div class='file-selected'>" +
                            "<input type='hidden' name='" + that.inputName + "' value='" + that.fromPublic + file + "' />" +
                            "<a href='" + that.assetUrl + file + "'' target='_blank'>" + file + "</a>" +
                            "<button onclick='removeFileSelected(this)' type='button' class='btn btn-danger btn-sm'>&Cross;</button>" +
                            "</div>";
                }
                des.append(html);
                $('#dinhtrong-media-modal').modal('hide');
            });
        }
    }
});

media.$watch('directoriesChecked', function (val) {
    if (this.directoriesChecked.length) {
        this.canSelect = false;
    }
});
media.$watch('filesChecked', function (val) {
    if ((this.filesChecked.length > 1 && !this.allowMultile) ||
            !this.filesChecked.length ||
            this.directoriesChecked.length) {
        this.canSelect = false;
    } else {
        this.canSelect = true;
    }
});

$('body').on('click','.media-selector', function () {
    var isMultile = typeof $(this).attr('multiple') !== typeof undefined ? true : false;
    var des = $(this).attr('des');
    media.destination = des;
    media.allowMultile = isMultile;
    media.inputName = (typeof $(this).attr('input-name') !== 'undefined') ? $(this).attr('input-name') : 'file';
    media.load();
    $('#dinhtrong-media-modal').modal('show');
});

var removeFileSelected = function (dom) {
    $(dom).parents('.file-selected').remove();
};
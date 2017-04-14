<div class="uploadplugin_wrapper">
    <!-- Chen upload images-->
    <!--BEGIN JQUERY UPLOAD PLUGIN-->
<!--    <ul class="nav nav-tabs" style="border-bottom: none;">-->
<!--        <li class="active"><a onclick="return false;"><h4>Upload Video File</h4></a></li>-->
<!--    </ul>-->
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div>Kiểu file upload: <strong style="color: #d58512;font-size: 120%">.mp4, .mp3 </strong></div>
        <div>Dung lượng tối đa: <strong style="color: #d58512;font-size: 120%">999 MB</strong></div>
    </div>
    <br><br>
    <br><br>
    <div class="clearfix"></div>
    <label>Chọn chất lượng</label>
    <?php  echo $form->dropDownList($modelFiles, 'quality', $modelFiles->getQualityList(), array('class' => 'form-control','style'=>'width:320px'));?>

    <!-- The file upload form used as target for the file upload widget -->
    <!-- Redirect browsers with JavaScript disabled to the origin page -->
    <noscript><input type="hidden" name="redirect" value="https://blueimp.github.io/jQuery-File-Upload/"></noscript>
    <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
    <div class="row fileupload-buttonbar">
        <div class="col-lg-12">
            <!-- The fileinput-button span is used to style the file input field as button -->
                <span class="btn btn-success fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>Chọn 1 file</span>
                    <input type="file" name="files" multiple>
                </span>
            <button type="submit" class="btn btn-primary start">
                <i class="glyphicon glyphicon-upload"></i>
                <span>Tải lên</span>
            </button>
        <!--    <button type="reset" class="btn btn-warning cancel">
                <i class="glyphicon glyphicon-ban-circle"></i>
                <span>Cancel</span>
            </button>-->
            <!-- The global file processing state -->
            <span class="fileupload-process"></span>
        </div>
        <!-- The global progress state -->
        <div class="col-lg-12 fileupload-progress fade">
            <!-- The global progress bar -->
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                <div class="progress-bar progress-bar-success" style="width:0%;"></div>
            </div>
            <!-- The extended global progress state -->
            <div class="progress-extended">&nbsp;</div>
        </div>
    </div>
    <!-- The table listing the files available for upload/download -->
    <table role="presentation" class="table table-striped preview_table">
        <tbody class="files"></tbody>
    </table>

    <br>
    <!-- The blueimp Gallery widget -->
    <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" data-filter=":even">
        <div class="slides"></div>
        <h3 class="title"></h3>
        <a class="prev">‹</a>
        <a class="next">›</a>
        <a class="close">×</a>
        <a class="play-pause"></a>
        <ol class="indicator"></ol>
    </div>
    <!-- The template to display files available for upload -->
    <script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td>
            <span class="preview"></span>
        </td>
        <td>
            <p class="name">{%=file.name%}</p>
            <strong class="error text-danger"></strong>
        </td>
        <td>
            <p class="size">Processing...</p>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
        </td>
        <td>
            {% if (!i && !o.options.autoUpload) { %}
                <button class="btn btn-primary start" disabled style="display: none;">
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Tải lên</span>
                </button>
            {% } %}
            {% if (!i) { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Hủy bỏ</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}


    </script>
    <!-- The template to display files available for download -->
    <script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade">
        <td>
            <span class="preview">
                {% if (file.thumbnailUrl) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                {% } %}
            </span>
        </td>
        <td>
            <p class="name">
                {% if (file.url) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                {% } else { %}
                    <span>{%=file.name%}</span>
                {% } %}
            </p>
            {% if (file.error) { %}
                <div><span class="label label-danger">Error</span> {%=file.error%}</div>
            {% } %}
        </td>
        <td>
            <span class="size">{%=o.formatFileSize(file.size)%}</span>
        </td>
        <td>
            {% if (file.deleteUrl) { %}
               <span class="glyphicon glyphicon-ok"></span>  <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>Xóa</span>
                </button>
                <input type="hidden" name ="AMediaFiles[file_name][]" value="{%=file.name%}">
                <input type="hidden" name ="AMediaFiles[file_size][]" value="{%=file.size%}">
            {% } else { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Hủy bỏ</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}


    </script>
    <!--SCRIPT & CSS -->
    <!--CSS -->
    <!-- Generic page styles -->
    <link rel="stylesheet" href="upload_plugin/css/style.css">
    <!-- blueimp Gallery styles -->
    <link rel="stylesheet" href="upload_plugin/css/blueimp-gallery.min.css">
    <!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
    <link rel="stylesheet" href="upload_plugin/css/jquery.fileupload.css">
    <link rel="stylesheet" href="upload_plugin/css/jquery.fileupload-ui.css">
    <!-- CSS adjustments for browsers with JavaScript disabled -->
    <noscript>
        <link rel="stylesheet" href="upload_plugin/css/jquery.fileupload-noscript.css">
    </noscript>
    <noscript>
        <link rel="stylesheet" href="upload_plugin/css/jquery.fileupload-ui-noscript.css">
    </noscript>
    <!--CSS -->
    <!--SCRIPT-->
    <!--<script src="upload_plugin/js/jquery.min.1.11.js"></script>-->
    <!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->

    <!--<script src="js/jquery.min.1.11.js"></script>-->
    <script src="upload_plugin/js/vendor/jquery.ui.widget.js"></script>

    <!-- The Templates plugin is included to render the upload/download listings -->
    <script src="upload_plugin/js/blueimp/tmpl.min.js"></script>
    <!-- The Load Image plugin is included for the preview images and image resizing functionality -->
    <script src="upload_plugin/js/blueimp/load-image.all.min.js"></script>
    <!-- The Canvas to Blob plugin is included for image resizing functionality -->
    <script src="upload_plugin/js/blueimp/canvas-to-blob.min.js"></script>
    <!-- Bootstrap JS is not required, but included for the responsive demo navigation -->
    <!--<script src="upload_plugin/js/blueimp/bootstrap.min.js"></script>-->
    <!-- blueimp Gallery script -->
    <script src="upload_plugin/js/blueimp/jquery.blueimp-gallery.min.js"></script>
    <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
    <script src="upload_plugin/js/jquery.iframe-transport.js"></script>
    <!-- The basic File Upload plugin -->
    <script src="upload_plugin/js/jquery.fileupload.js"></script>
    <!-- The File Upload processing plugin -->
    <script src="upload_plugin/js/jquery.fileupload-process.js"></script>
    <!-- The File Upload image preview & resize plugin -->
    <script src="upload_plugin/js/jquery.fileupload-image.js"></script>
    <!-- The File Upload audio preview plugin -->
    <script src="upload_plugin/js/jquery.fileupload-audio.js"></script>
    <!-- The File Upload video preview plugin -->
    <script src="upload_plugin/js/jquery.fileupload-video.js"></script>
    <!-- The File Upload validation plugin -->
    <script src="upload_plugin/js/jquery.fileupload-validate.js"></script>
    <!-- The File Upload user interface plugin -->
    <script src="upload_plugin/js/jquery.fileupload-ui.js"></script>
    <!-- The main application script -->
    <script src="upload_plugin/js/main.js"></script>
    <!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->
    <!--[if (gte IE 8)&(lt IE 10)]>
    <script src="upload_plugin/js/cors/jquery.xdr-transport.js"></script>
    <![endif]-->
    <!--SCRIPT-->
    <!--END JQUERY UPLOAD PLUGIN-->
    <!-- Source code in https://github.com/blueimp/jQuery-File-Upload-->
    <!--End chen khung upload -->
    <!-- form -->
</div>



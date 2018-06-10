<div id="image_upload_modal" class="modal">
    <div class="modal-background"></div>
    <div class="modal-card">
        <form id="image_upload_form" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="directory" value="/images/" />
            <header class="modal-card-head">
                <p class="modal-card-title">Image Upload</p>
                <button class="delete" aria-label="close" onclick="onImageUploadCloseClick(); return false;"></button>
            </header>
            <section class="modal-card-body">
                <div class="field">
                    <label class="label">File Name</label>
                    <div class="control">
                        <input class="input" type="input" placeholder="File Name" name="name" value="" required>
                    </div>
                </div>
                <div class="file has-name is-fullwidth">
                    <label class="file-label">
                        <input id="image_upload_file" class="file-input" type="file" name="file" required>
                        <span class="file-cta">
                            <span class="file-icon">
                                <i class="fas fa-upload"></i>
                            </span>
                            <span class="file-label">
                                Choose an image..
                            </span>
                        </span>
                        <span id="image_upload_name" class="file-name"></span>
                    </label>
                </div>
            </section>
            <footer class="modal-card-foot">
                <button class="button is-success" onclick="onImageUploadSaveClick(this); return false;">Upload</button>
                <button class="button" onclick="onImageUploadCloseClick(); return false;">Cancel</button>
            </footer>
        </form>
    </div>
</div>
<div id="file_upload_modal" class="modal">
    <div class="modal-background"></div>
    <div class="modal-card">
        <form id="file_upload_form" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="directory" value="/files/" />
            <header class="modal-card-head">
                <p class="modal-card-title">File Upload</p>
                <button class="delete" aria-label="close" onclick="onFileUploadCloseClick(); return false;"></button>
            </header>
            <section class="modal-card-body">
                <div class="field">
                    <label class="label">File Name</label>
                    <div class="control">
                        <input class="input" type="input" placeholder="File Name" name="name" value="" required>
                    </div>
                </div>
                <div class="file has-name is-fullwidth">
                    <label class="file-label">
                        <input id="file_upload_file" class="file-input" type="file" name="file" required>
                        <span class="file-cta">
                            <span class="file-icon">
                                <i class="fas fa-upload"></i>
                            </span>
                            <span class="file-label">
                                Choose an file..
                            </span>
                        </span>
                        <span id="file_upload_name" class="file-name"></span>
                    </label>
                </div>
            </section>
            <footer class="modal-card-foot">
                <button class="button is-success" onclick="onFileUploadSaveClick(this); return false;">Upload</button>
                <button class="button" onclick="onFileUploadCloseClick(); return false;">Cancel</button>
            </footer>
        </form>
    </div>
</div>
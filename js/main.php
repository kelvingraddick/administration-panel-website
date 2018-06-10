<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/additional-methods.min.js"></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
<script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
<script src="<?php echo $_ENV["PROTOCOL"].$_SERVER['SERVER_NAME']; ?>/admin/js/main.js"></script>
<script>
    $(document).ready(function() {
        var currentPageLinkIdCookie = getCookie("current_page_link_id");
        if (currentPageLinkIdCookie) {
            $("#" + currentPageLinkIdCookie)[0].onclick();
        } else if ($("#link_admins")[0]) {
            $("#link_admins")[0].onclick();
        }
    });

    function onNavigationClick(page_path, element) {
        $("#page").html('<div class="loading">Loading...</div>');
        $("#page").load('<?php echo $_ENV["PROTOCOL"].$_SERVER['SERVER_NAME'].'/admin/'; ?>' + page_path);
        if (element) {
            $("a").removeClass("is-active");
            $(element).addClass('is-active');
        }
        setCookie("current_page_link_id", element.getAttribute('id'), 1);
        return false;
    }

    function onRecordDeleteClick(page_path, record_id, button) {
        if (confirm("Are you sure you want to delete this?")) {
            $(button).addClass('is-loading');
            $.post(page_path + "/delete.php", { id: record_id })
            .done(function(data) {
                var response = JSON.parse(data);
                if (response.success) {
                    alert("Deletion was successful.");
                    onNavigationClick(page_path);
                } else {
                    alert(response.error_message);
                }
            })
            .fail(function() {
                alert("There was a problem. Please try again.");
            })
            .always(function() {
                $(button).removeClass('is-loading');
            });
        }
    }

    function onFormSaveClick(page_path, button) {
        var form = $(button).closest('form');
        form.validate();
        if (form.valid()) {
            $(button).addClass('is-loading');
            $.post(page_path + "/submit.php", form.serialize())
            .done(function(data) {
                var response = JSON.parse(data);
                if (response.success) {
                    alert("Save was successful.");
                    onNavigationClick(page_path);
                } else {
                    alert(response.error_message);
                }
            })
            .fail(function() {
                alert("There was a problem. Please try again.");
            })
            .always(function() {
                $(button).removeClass('is-loading');
            });
        }
        return false;
    }

    var currentImageUploadField;
    var currentImageUploadImage;

    function onImageUploadOpenClick(button) {
        var container = $(button).closest('div');
        currentImageUploadField = container.find('input');
        currentImageUploadImage = container.find('img');
        $("#image_upload_modal").show();
    }

    function onImageUploadSaveClick(button) {
        var form = $(button).closest('form');
        form.validate();
        if (form.valid()) {
            $(button).addClass('is-loading');
            $.ajax({
                url: "<?php echo $_ENV["PROTOCOL"].$_SERVER['SERVER_NAME']; ?>/admin/utility/upload.php",
                type: "POST",
                data: new FormData(form[0]),
                async: false,
                cache: false,
                contentType: false,
                processData: false
            })
            .done(function(data) {
                var response = JSON.parse(data);
                if (response.success) {
                    currentImageUploadField.val(response.url);
                    currentImageUploadImage.attr("src", response.url);
                    onImageUploadCloseClick();
                    alert("Save was successful.");
                } else {
                    alert(response.error_message);
                }
            })
            .fail(function() {
                alert("There was a problem. Please try again.");
            })
            .always(function() {
                $(button).removeClass('is-loading');
            });
        }
        return false;
    }

    function onImageUploadCloseClick() {
        $("#image_upload_modal").hide();
    }

    var imageUploadFile = document.getElementById("image_upload_file");
    if (imageUploadFile) {
        imageUploadFile.onchange = function() {
            if (imageUploadFile.files.length > 0) {
                document.getElementById("image_upload_name").innerHTML = imageUploadFile.files[0].name;
            }
        };
    }

    var currentFileUploadField;
    var currentFileUploadFile;

    function onFileUploadOpenClick(button) {
        var container = $(button).closest('div');
        currentFileUploadField = container.find('input');
        currentFileUploadFile = container.find('img');
        $("#file_upload_modal").show();
    }

    function onFileUploadSaveClick(button) {
        var form = $(button).closest('form');
        form.validate();
        if (form.valid()) {
            $(button).addClass('is-loading');
            $.ajax({
                url: "<?php echo $_ENV["PROTOCOL"].$_SERVER['SERVER_NAME']; ?>/admin/utility/upload.php",
                type: "POST",
                data: new FormData(form[0]),
                async: false,
                cache: false,
                contentType: false,
                processData: false
            })
            .done(function(data) {
                var response = JSON.parse(data);
                if (response.success) {
                    currentFileUploadField.val(response.url);
                    currentFileUploadFile.attr("src", response.url);
                    onFileUploadCloseClick();
                    alert("Save was successful.");
                } else {
                    alert(response.error_message);
                }
            })
            .fail(function() {
                alert("There was a problem. Please try again.");
            })
            .always(function() {
                $(button).removeClass('is-loading');
            });
        }
        return false;
    }

    function onFileUploadCloseClick() {
        $("#file_upload_modal").hide();
    }

    var fileUploadFile = document.getElementById("file_upload_file");
    if (fileUploadFile) {
        fileUploadFile.onchange = function() {
            if (fileUploadFile.files.length > 0) {
                document.getElementById("file_upload_name").innerHTML = fileUploadFile.files[0].name;
            }
        };
    }

    function setCookie(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays*24*60*60*1000));
        var expires = "expires="+ d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

    function getCookie(cname) {
        var name = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
        for(var i = 0; i <ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return undefined;
    }

    particlesJS.load('particles', '<?php echo $_ENV["PROTOCOL"].$_SERVER['SERVER_NAME']; ?>/admin/js/particles.configuration.json', function() {
        //console.log('callback - particles.js config loaded');
    });
</script>
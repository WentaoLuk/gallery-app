function uploadFile() {
    var form = new FormData();
    form.append('file', document.querySelector('#imageFile').files[0]);
    form.append('upload', true);

    var upload = new XMLHttpRequest();
    upload.open('POST', 'upload.php'); //send "post" request to upload.php
    upload.onreadystatechange = function () {//An EventHandler that is called whenever the readyState attribute changes. 
        //meaning all is well

        if (this.readyState == 4 && this.status == 200) {
            //before showing susccess, we need to create the process to upload  the pic.
            if (this.responseText == 1) {
                document.querySelector('#uploadError').innerText = "Image uploaded successfully.";
                setTimeout(window.location.reload(), 1500);
            } else {
                document.querySelector('#uploadError').innerText =
                    this.responseText.includes("Error") ? this.responseText : "Empty or invalid file type!";
            }

        }
    };
    upload.send(form);
}

/**
 * This function will make sure everytime when user re-open the Upload tab, 
 * the error message will be cleared.
 */
function clearError() {
    document.querySelector('#uploadError').innerText = "";
}

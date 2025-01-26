"use strict";

function previewImage(event) {
  const imageInput = event.target;
  const imagePreview = document.getElementById("imagePreview");

  if (imageInput.files && imageInput.files[0]) {
    const reader = new FileReader();

    reader.onload = function (e) {
      imagePreview.src = e.target.result;
      imagePreview.style.display = "block";
    };

    reader.readAsDataURL(imageInput.files[0]);
  }
}

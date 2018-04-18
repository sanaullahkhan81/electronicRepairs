var wrapper_collected = document.getElementById("signature-pad_collected");
var clearButton_collected = wrapper_collected.querySelector("[data-action=clear_collected]");
var changeColorButton_collected = wrapper_collected.querySelector("[data-action=change-color_collected]");
var undoButton_collected = wrapper_collected.querySelector("[data-action=undo_collected]");
var savePNGButton_collected = wrapper_collected.querySelector("[data-action=save-png_collected]");
var saveJPGButton_collected = wrapper_collected.querySelector("[data-action=save-jpg_collected]");
var saveSVGButton_collected = wrapper_collected.querySelector("[data-action=save-svg_collected]");
var canvas_collected = wrapper_collected.querySelector("canvas");
var signaturePad_collected = new SignaturePad(canvas_collected, {
  // It's Necessary to use an opaque color when saving image as JPEG;
  // this option can be omitted if only saving as PNG or SVG
  backgroundColor: 'rgb(255, 255, 255)'
});

// Adjust canvas coordinate space taking into account pixel ratio,
// to make it look crisp on mobile devices.
// This also causes canvas to be cleared.
function resizeCanvas_collected() {
  // When zoomed out to less than 100%, for some very strange reason,
  // some browsers report devicePixelRatio as less than 1
  // and only part of the canvas is cleared then.
  var ratio =  Math.max(window.devicePixelRatio || 1, 1);

  // This part causes the canvas to be cleared
  canvas_collected.width = 265;//canvas.offsetWidth * ratio;
  canvas_collected.height = 110;//canvas.offsetHeight * ratio;
  canvas_collected.getContext("2d").scale(1, 1);

  // This library does not listen for canvas changes, so after the canvas is automatically
  // cleared by the browser, SignaturePad#isEmpty might still return false, even though the
  // canvas looks empty, because the internal data of this library wasn't cleared. To make sure
  // that the state of this library is consistent with visual state of the canvas, you
  // have to clear it manually.
  signaturePad_collected.clear();
}

// On mobile devices it might make more sense to listen to orientation change,
// rather than window resize events.
window.onresize = resizeCanvas_collected;
resizeCanvas_collected();

function download_collected(dataURL, filename) {
  var blob = dataURLToBlob_collected(dataURL);
  var fd = new FormData();
    fd.append("signature", blob);

    // Submit Form and upload file
    $.ajax({
        url:"home/save_signature",
        data: fd,// the formData function is available in almost all new browsers.
        type:"POST",
        contentType:false,
        processData:false,
        cache:false,
        error:function(err){
            console.error(err);
        },
        success:function(data){
            if(data != 'false'){
                $('#signature_image_collected').attr('src', '/uploads/'+data);
                $('#sig_img_name_collected').val(data);
                $('#signature_image_collected').show();
                $('#signature-pad_collected').hide();
            }
        },
        complete:function(){
            console.log("Request finished.");
        }
    });
  /*var url = window.URL.createObjectURL(blob);

  var a = document.createElement("a");
  a.style = "display: none";
  a.href = url;
  a.download = filename;

  document.body.appendChild(a);
  a.click();

  window.URL.revokeObjectURL(url);*/
}

// One could simply use Canvas#toBlob method instead, but it's just to show
// that it can be done using result of SignaturePad#toDataURL.
function dataURLToBlob_collected(dataURL) {
  // Code taken from https://github.com/ebidel/filer.js
  var parts = dataURL.split(';base64,');
  var contentType = parts[0].split(":")[1];
  var raw = window.atob(parts[1]);
  var rawLength = raw.length;
  var uInt8Array = new Uint8Array(rawLength);

  for (var i = 0; i < rawLength; ++i) {
    uInt8Array[i] = raw.charCodeAt(i);
  }

  return new Blob([uInt8Array], { type: contentType });
}

clearButton_collected.addEventListener("click", function (event) {
  signaturePad_collected.clear();
});

undoButton_collected.addEventListener("click", function (event) {
  var data = signaturePad_collected.toData();

  if (data) {
    data.pop(); // remove the last dot or line
    signaturePad_collected.fromData(data);
  }
});

changeColorButton_collected.addEventListener("click", function (event) {
  var r = Math.round(Math.random() * 255);
  var g = Math.round(Math.random() * 255);
  var b = Math.round(Math.random() * 255);
  var color = "rgb(" + r + "," + g + "," + b +")";

  signaturePad_collected.penColor = color;
});

savePNGButton_collected.addEventListener("click", function (event) {
  if (signaturePad_collected.isEmpty()) {
    alert("Please provide a signature first.");
  } else {
    var dataURL = signaturePad_collected.toDataURL();
    download_collected(dataURL, "signature.png");
  }
});

saveJPGButton_collected.addEventListener("click", function (event) {
  if (signaturePad_collected.isEmpty()) {
    alert("Please provide a signature first.");
  } else {
    var dataURL = signaturePad_collected.toDataURL("image/jpeg");
    download_collected(dataURL, "signature.jpg");
  }
});

saveSVGButton_collected.addEventListener("click", function (event) {
  if (signaturePad_collected.isEmpty()) {
    alert("Please provide a signature first.");
  } else {
    var dataURL = signaturePad_collected.toDataURL('image/svg+xml');
    download_collected(dataURL, "signature.svg");
  }
});

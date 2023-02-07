window.onload = function () {
  var cameraId = "";
  var selectInputContent = "";
  var scanningStarted = false;
  var modalElement = document.getElementById("model-content-area");

  var qr_action = document.getElementById("qr_action");
  var qr_input_id = document.getElementById("qr_input_id");
  var qr_input_class = document.getElementById("qr_input_class");

  const html5QrCode = new Html5Qrcode("reader");

  function is_url(myURL) {
    var pattern = new RegExp(
      "^(https?:\\/\\/)" + // protocol
      "((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.?)+[a-z]{2,}|" + // domain name
      "((\\d{1,3}\\.){3}\\d{1,3}))" + // ip (v4) address
      "(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*" + //port
      "(\\?[;&amp;a-z\\d%_.~+=-]*)?" + // query string
        "(\\#[-a-z\\d_]*)?$",
      "i"
    );
    return pattern.test(myURL);
  }

  function listCameras() {
    modalElement.innerHTML = "Please wait...";
    modal.style.display = "block";
    Html5Qrcode.getCameras()
      .then((devices) => {
        if (devices && devices.length) {
          selectInputContent = "";
          selectInputContent +=
            '<div class="select-box"><h1>Select Camera</h1><ul class="select-box__list">';
          for (var i = 0; i < devices.length; i++) {
            selectInputContent +=
              "<li><label class='select-box__option' for='0' aria-hidden='aria-hidden' data-camid='" +
              devices[i].id +
              "' >" +
              devices[i].label +
              "</label></li>";
          }
          selectInputContent += '</ul"></div>';
          modalElement.innerHTML = selectInputContent;
          modal.style.display = "block";
        }
      })
      .catch((err) => {
        modalElement.innerHTML = "<p>Browser " + err + "</p>";
        modal.style.display = "block";
      });
  }

  document.addEventListener("click", function (e) {
    if (e.target && e.target.className == "select-box__option") {
      modal.style.display = "none";
      modalElement.innerHTML = "";
      cameraId = e.target.dataset.camid;
      if (scanningStarted) {
        html5QrCode
          .stop()
          .then((ignore) => {
            console.log("QR Code scanning stopped.");
          })
          .catch((err) => {
            console.log("Unable to stop scanning.");
          });
      }
      scanningStarted = false;
      modalElement.innerHTML =
        "<p>Camera selected. Click the QR Code Button to start scanning.</p>";
      modal.style.display = "block";
    }
  });

  function startScanning(cameraId) {
    scanningStarted = true;
    modalElement.innerHTML = "Focus on QR Code until the corners turn green";
    modal.style.display = "block";
    html5QrCode
      .start(
        cameraId, // retreived in the previous step.
        {
          fps: 100, // sets the framerate to 10 frame per second
          qrbox: 250, // sets only 250 X 250 region of viewfinder to
        },
        (qrCodeMessage) => {
          // console.log(`QR Code detected: ${qrCodeMessage}`);
          if (qr_action) {
            if (qr_action.value == "url") {
              if (is_url(qrCodeMessage)) {
                modal.style.display = "none";
                modalElement.innerHTML = "";
                window.location = qrCodeMessage;
              } else {
                modalElement.innerHTML = "<p>Invalid URL.</p>";
                modal.style.display = "block";
              }
            } else if (qr_action.value == "input") {
              var inputElement = document.getElementById(qr_input_id.value);
              if (inputElement) {
                modal.style.display = "none";
                modalElement.innerHTML = "";
                inputElement.value = qrCodeMessage;
              } else {
                modalElement.innerHTML = "<p>Input ID not found.</p>";
                modal.style.display = "block";
              }
            }
          }
          // window.location = "https://www.google.com";
        },
        (errorMessage) => {}
      )
      .catch((err) => {});
  }

  var permissionBtn = document.getElementById("permission_btn");
  if (permissionBtn) {
    permissionBtn.addEventListener("click", function (e) {
      listCameras();
    });
  }

  var swtichCameraBtn = document.getElementById("switch_camera_btn");
  if (swtichCameraBtn) {
    swtichCameraBtn.addEventListener("click", function (e) {
      if (selectInputContent) {
        modalElement.innerHTML = selectInputContent;
        modal.style.display = "block";
      }
    });
  }

  var scanningBtn = document.getElementById("start_scanning_btn");
  if (scanningBtn) {
    scanningBtn.addEventListener("click", function (e) {
      if (scanningStarted == false) {
        startScanning(cameraId);
      }
    });
  }

  var stopBtn = document.getElementById("stop_scanning_btn");
  if (stopBtn) {
    stopBtn.addEventListener("click", function (e) {
      if (cameraId) {
        scanningStarted = false;
        html5QrCode
          .stop()
          .then((ignore) => {
            console.log("QR Code scanning stopped.");
          })
          .catch((err) => {
            console.log("Unable to stop scanning.");
          });
      }
    });
  }

  var modal = document.getElementById("myModal");
  var btn = document.getElementById("myBtn");
  var span = document.getElementsByClassName("close")[0];
  if (span) {
    span.onclick = function () {
      modal.style.display = "none";
      modalElement.innerHTML = "";
    };
  }

  window.onclick = function (event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  };
};

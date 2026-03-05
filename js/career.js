document.addEventListener("DOMContentLoaded", function() {

    const form = document.getElementById("cvUploadForm");
    if(!form) return;
  
    const loadingIcon = document.getElementById("cvLoadingIcon");
    const submitBtn = form.querySelector(".cv-submit-btn");
  
    const SCRIPT_URL = "https://script.google.com/macros/s/AKfycbw3aQRnrVfV8Nia6QtWu3xOQddVsL83MY0IF6hc-MdfhICTK5Jcl3V4cdLHZMPdaps6qw/exec";
  
    form.addEventListener("submit", function(e){
      e.preventDefault();
  
      const fileInput = document.getElementById("cvFileInput");
      const file = fileInput.files[0];
  
      if(!file){
        alert("Silakan pilih file terlebih dahulu.");
        return;
      }
  
      loadingIcon.classList.remove("d-none");
      submitBtn.disabled = true;
  
      const reader = new FileReader();
  
      reader.onload = function() {
  
        const base64 = reader.result.split(',')[1];
  
        const data = new URLSearchParams();
        data.append("job_id", document.getElementById("cv_job_id").value);
        data.append("fileName", file.name);
        data.append("mimeType", file.type);
        data.append("file", base64);
  
        fetch(SCRIPT_URL, {
          method: "POST",
          body: data
        })
        .then(res => res.json())
        .then(res => {
  
          loadingIcon.classList.add("d-none");
          submitBtn.disabled = false;
  
          if(res.success){
            alert("CV berhasil dikirim!");
            location.reload();
          } else {
            alert(res.message);
          }
        })
        .catch(() => {
          loadingIcon.classList.add("d-none");
          submitBtn.disabled = false;
          alert("Terjadi kesalahan.");
        });
      };
  
      reader.readAsDataURL(file);
    });
  
  });
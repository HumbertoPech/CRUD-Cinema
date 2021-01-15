const fileInput = document.querySelector('#file-js input[type=file]');
fileInput.onchange = () => {
  if (fileInput.files.length > 0) {
    const fileName = document.querySelector('#file-js .file-name');
    fileName.textContent = fileInput.files[0].name;
  }
}

flatpickr("#release", {
    altInput: true,
    altFormat: "d/F/Y",
    dateFormat: "Y-m-d",
    locale: "es",
  });

  
flatpickr("#duration", {
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:i:ss",
    minTime: "00:00:00",
    maxTime: "06:00:00",
    time_24hr: true,
    defaultDate: "00:00:00"
  });

let actorSelector = new Selectr('#actorsMovies', {
    defaultSelected: true,
    multiple:true,
    placeholder: "Seleccionar actor",
    });

let directorSelector = new Selectr('#directorsMovies', {
    defaultSelected: true,
    multiple:true,
    placeholder: "Seleccionar director",
    });

window.addEventListener('keydown',function(e){if(e.keyIdentifier=='U+000A'||e.keyIdentifier=='Enter'||e.keyCode==13){if(e.target.nodeName=='INPUT'){e.preventDefault();return false;}}},true);

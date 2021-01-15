
document.addEventListener('click', function (event) {

  if (!event.target.matches('.close-delete')) return;
  event.preventDefault();

  document.getElementById('delete-form').setAttribute('action', '');
  document.getElementById('delete-modal').classList.toggle('is-active');
  document.documentElement.classList.toggle('is-clipped');

}, false);

document.getElementById('submit-delete').addEventListener("click", function(event) {
  event.preventDefault();
  document.getElementById('delete-form').submit();
});

document.getElementById('show-search').addEventListener("click", function(event) {
  event.preventDefault();
  let divSearch = document.getElementById('is-search');
  divSearch.classList.toggle('is-hidden-touch');
});

function deleteItem(event) {
  event.preventDefault();
  let route = event.currentTarget.getAttribute('data-route');
  document.getElementById('delete-form').setAttribute('action', route);
  document.getElementById('delete-modal').classList.toggle('is-active');
  document.documentElement.classList.toggle('is-clipped');
}

let dateFiltter = flatpickr(".fecha", {
  altInput: true,
  altFormat: "d/F/Y",
  dateFormat: "Y-m-d",
  locale: "es",
  wrap:true,
  mode: "range",
  allowInput: true,
  onChange: function(selectedDates, dateStr, instance) {
    document.getElementById('date1').value = "";
    document.getElementById('date2').value = "";
    if(selectedDates[0] !== undefined){
      document.getElementById('date1').value = dateISO(selectedDates[0]);
    }
    if(selectedDates[1] !== undefined){
      document.getElementById('date2').value = dateISO(selectedDates[1]);
    }
  },
});

let durationFilter = flatpickr(".timeD", {
  enableTime: true,
  noCalendar: true,
  dateFormat: "H:i:ss",
  minTime: "00:00:00",
  maxTime: "06:00:00",
  time_24hr: true,
  //defaultDate: "00:00:00"
});

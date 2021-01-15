document.addEventListener('DOMContentLoaded', function () {

  // Get all "navbar-burger" elements
  var $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

  // Check if there are any navbar burgers
  if ($navbarBurgers.length > 0) {

    // Add a click event on each of them
    $navbarBurgers.forEach(function ($el) {
      $el.addEventListener('click', function () {

        // Get the target from the "data-target" attribute
        var target = $el.dataset.target;
        var $target = document.getElementById(target);

        // Toggle the class on both the "navbar-burger" and the "navbar-menu"
        $el.classList.toggle('is-active');
        $target.classList.toggle('is-active');

      });
    });
  }

});

document.addEventListener('DOMContentLoaded', () => {
  (document.querySelectorAll('.notification .delete') || []).forEach(($delete) => {
    $notification = $delete.parentNode;
    $delete.addEventListener('click', () => {
      if($notification.parentNode != null){
        $notification.parentNode.removeChild($notification);
      }
    });
  });
});

document.querySelectorAll('.navbar-link').forEach(function(navbarLink){
  navbarLink.addEventListener('click', function(){
    navbarLink.nextElementSibling.classList.toggle('is-hidden-touch');
    navbarLink.children[0].children[0].classList.toggle('fa-chevron-up');
    navbarLink.children[0].children[0].classList.toggle('fa-chevron-down');
  })
});

function dateISO(date) {
  year = date.getFullYear();
  month = date.getMonth()+1;
  dt = date.getDate();

  if (dt < 10) {
    dt = '0' + dt;
  }
  if (month < 10) {
    month = '0' + month;
  }
  return year+'-' + month + '-'+dt;
}

var form = document.querySelector(".createForm");
if (form) {
  form.addEventListener("submit", function(e){
      var submitButton = document.querySelector(".submitButton");
      if (submitButton) {
        submitButton.setAttribute('disabled', true);
      }
  });
}

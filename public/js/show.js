if (document.getElementById('button-delete')) {
    document.getElementById('button-delete').addEventListener("click", function(event) {
      event.preventDefault();
      document.getElementById('delete-modal').classList.toggle('is-active');
      document.documentElement.classList.toggle('is-clipped');
    });
  }
  
  document.querySelectorAll('.close-delete').forEach(function(closeDeleteModal){
    closeDeleteModal.addEventListener('click', function(event){
      event.preventDefault();
      document.getElementById('delete-modal').classList.toggle('is-active');
      document.documentElement.classList.toggle('is-clipped');
    })
  });

  if (document.getElementById('submit-delete')) {
    document.getElementById('submit-delete').addEventListener("click", function(event) {
      event.preventDefault();
      document.getElementById('delete-form').submit();
    });
  }
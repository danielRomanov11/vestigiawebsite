document.addEventListener('DOMContentLoaded', function() {
  var popup = document.getElementById('forgotPasswordPopup');
  var link = document.getElementById('forgotPasswordLink');
  var span = document.getElementsByClassName('close')[0];

  link.onclick = function(event) {
    event.preventDefault();
    popup.style.display = 'block';
  }

  span.onclick = function() {
    popup.style.display = 'none';
  }

  window.onclick = function(event) {
    if (event.target == popup) {
      popup.style.display = 'none';
    }
  }
});

// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

/*** select photo */
function readURL(input) {
  if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
          $('#blah')
              .attr('src', e.target.result);
      };
      reader.readAsDataURL(input.files[0]);
  }
}
/*************************/
// Get the modal
var modalete = document.getElementById("myModalete");

// Get the button that opens the modal
var btn = document.getElementById("myBtnreport");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("closereport")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modalete.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modalete.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modalete) {
    modalete.style.display = "none";
  }
}
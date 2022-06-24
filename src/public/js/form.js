// booking form

const form = document.querySelector("#form-div");
const bookingBtn = document.querySelector("#booking-btn");


form.style.display="none";

function appear(){
    form.style.display="block";
};

function disAppear(){
    form.style.display="none";
};

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == form) {
      form.style.display = "none";
    }
}
const form = document.querySelector("#form-div");
const bookingBtn = document.querySelector("#booking-btn");

form.style.display="none";

bookingBtn.addEventListener("click", appear)

function appear(){
    form.style.display="block";
};

function disAppear(){
    form.style.display="none";
};
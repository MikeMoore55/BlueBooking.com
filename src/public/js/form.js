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

const start = document.querySelector(".checkIn-input").value;
const end = document.querySelector(".checkOut-input").value;

document.querySelector("#error-meg").style.display="none";

if (start >= end) {
    document.querySelector("#error-meg").style.display="block";
    document.querySelector("#error-meg").style.color="red";
}
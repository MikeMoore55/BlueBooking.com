const compareForm = document.querySelector("#new-book-div");
const BookBtn = document.querySelector("#book-btn");

compareForm.style.display="none";

function newBook(){
    compareForm.style.display="block";
}

function hideNewBook(){
    compareForm.style.display="none";
}
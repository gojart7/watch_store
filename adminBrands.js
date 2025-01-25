"use strict";

const addButton = document.getElementById("addProd");
const addForm = document.getElementById("addForm");

function toggleForm() {
  if (addForm.style.display === "none") {
    addForm.style.display = "block";
    addButton.textContent = "Close";
    addButton.classList.add("close-state");
  } else {
    addForm.style.display = "none";
    addButton.textContent = "Add";
    addButton.classList.remove("close-state");
  }
}

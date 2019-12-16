<?php
//We need to use sessions, so start with session starting
session_start();
//if use not logged in, redirect to login page
if (!isset($_SESSION['loggedin'])) {
  header('Location: login.html');
}
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
  <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
  <link rel="stylesheet" type="text/css" href="queryresult.css">
  <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
</head>
<body>
  <div id="navbar">
    <nav class="is-link navbar" role="navigation" aria-label="main navigation">
      <div class="navbar-brand">
        <a id="title" class="navbar-item is-size-4" href="..">Mr. Mullins' Inventory</a>
        <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
          <span aria-hidden="true"></span>
          <span aria-hidden="true"></span>
          <span aria-hidden="true"></span>
        </a>
      </div>
      <div class="navbar-menu">
        <div class="navbar-start">
          <a class="navbar-item" href=/images/room_map.jpg target="_blank" title="Open Room Map in New Tab">Map</a>
          <a class="navbar-item" href=/login_landing.php>Teacher Login</a>
        </div>
        <div class="navbar-end">
          <div class="searchbar">
            <form action="query.php" method="POST">
              <input id="search" type="text" placeholder="Type here" name="searchreq" class="input"style="font-family:'Lato'">
              <input id="submit" type="submit" value="Search" class="button">
            </form>
          </div>
        </div>
      </div>
    </nav>
  </div>
  <div class="container">
    <div class="tile is-ancestor">
      <div class="tile is-parent">
        <div class="tile is-child box">
          <button class="button is-link" id="editBtn" style="width:10em; margin:1px;">Edit Item</button>
          <div id="editModal" class="modal">
            <div class="modal-background"></div>
            <div class="modal-card">
              <header class="modal-card-head">
                <p class="modal-card-title">Edit</p>
                <button id="closeEditModal" class="delete" aria-label="close"></button>
              </header>
              <section class="modal-card-body">
                <h1>To edit, insert an Item ID.</h1>
                <form id="editForm" action="edit_item.php" method="POST">
                  <input id="idsearch" class="input" placeholder="ItemId" name="editid" style="width:12em;">
                  <input id="submit" class="button is-success" value="Submit" style="width:6em;" type="submit">
                </form>
              </section>
              <footer class="modal-card-foot">
                <button id="cancelEditModal" class="button">Cancel</button>
              </footer>
            </div>
          </div>

          <button class="button is-link" id="addBtn" style="width:10em;margin:1px; ">Add Item</button>
          <div id="addModal" class="modal">
            <div class="modal-background"></div>
            <div class="modal-card">
              <header class="modal-card-head">
                <p class="modal-card-title">Add</p>
                <button id="closeAddModal" class="delete" aria-label="close"></button>
              </header>
              <section class="modal-card-body">
                <form id="addForm" action="additem.php" method="POST">
                  Item ID: <input type="text" name="itemid"  placeholder="Item ID" class="input">
                  Item Name: <input type="text" name="itemname"  placeholder="Item Name" class="input">
                  Item Quantity: <input type="text" name="itemqty"  placeholder="Item Quantity" class="input">
                  Zone:<br> <div class="select">
                    <select name = "itemzone">
                      <option>Enter a Zone</option>
                      <option value="Red">Red</option>
                      <option value="Green">Green</option>
                      <option value="Blue">Blue</option>
                      <option value="Purple">Purple</option>
                      <option value="Yellow">Yellow</option>
                    </select>
                  </div><br>
                  Subsection: <input type="text" name="itemsub"  placeholder="Item Subsection" class="input">
                  <input type="submit" id="submit" value="Insert" class="button is-success">
                </form>
              </section>
              <footer class="modal-card-foot">
                <button id="cancelAddModal" class="button">Cancel</button>
              </footer>
            </div>
          </div>

          <button class="button is-link" id="removeBtn" style="width:10em;margin:1px;">Remove Item</button>
          <div id="removeModal" class="modal">
            <div class="modal-background"></div>
            <div class="modal-card">
              <header class="modal-card-head">
                <p class="modal-card-title">Remove</p>
                <button id="closeRemModal" class="delete" aria-label="close"></button>
              </header>
              <section class="modal-card-body">
                <h1>To remove, insert an Item ID.</h1>
                <form id="removeForm" action="remove_item.php" method="POST">
                  <input id="idsearch" class="input" placeholder="ItemId" name="remid" style="width:12em;">
                  <input id="submit" class="button is-warning" value="Submit" style="width:6em;" type="submit">
                </form>
              </section>
              <footer class="modal-card-foot">
                <button id="cancelRemModal" class="button">Cancel</button>
              </footer>
            </div>
          </div>
        </div>
        <div class="tile is-parent is-10">
          <div class="tile is-child box">
            <p class="title">Website statistics coming soon!</p>
          </div>
        </div>
    </div>
  </div>

<script type='text/javascript'>
document.onload = function() {
//get modal
var editModal   = document.getElementById("editModal");
var addModal    = document.getElementById("addModal");
var removeModal = document.getElementById("removeModal");
//get opening button
var editBtn   = document.getElementById("editBtn");
var addBtn    = document.getElementById("addBtn");
var removeBtn = document.getElementById("removeBtn");
//Get all forms
var editForm = document.getElementById("editForm");
var addForm = document.getElementById("addForm");
var removeForm = document.getElementById("removeForm");
}

//Click edit item button, open edit item modal
editBtn.onclick = function() {
  editModal.style.display = "block";
  console.log("Edit Item");
}

//Click add item button, open add item Modal
addBtn.onclick = function() {
  addModal.style.display = "block";
  console.log("Add Item");
}

//Click remove item button, open remove item modal
removeBtn.onclick = function() {
  removeModal.style.display = "block";
  console.log("Remove Item");
}

var closeBtnR  = document.getElementById("closeRemModal");
var cancelBtnR = document.getElementById("cancelRemModal");
var closeBtnA  = document.getElementById("closeAddModal");
var cancelBtnA = document.getElementById("cancelAddModal");
var closeBtnE = document.getElementById("closeEditModal");
var cancelBtnE = document.getElementById("cancelEditModal");

function closeModal() {
  editModal.style.display   = "none";
  addModal.style.display    = "none";
  removeModal.style.display = "none";
  editForm.reset();
  removeForm.reset();
  addForm.reset();
}

closeBtnE.onclick  = () => { closeModal(); }
cancelBtnE.onclick = () => { closeModal(); }
closeBtnA.onclick  = () => { closeModal(); }
cancelBtnA.onclick = () => { closeModal(); }
closeBtnR.onclick  = () => { closeModal(); }
cancelBtnR.onclick = () => { closeModal(); }
</script>
</body>
</html>

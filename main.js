function myFunction() {
  var x = document.getElementById("myTopNav");  // Ensure this matches the ID in your HTML
  if (x.className === "topNav") {
    x.className += " responsive";  // Adds "responsive" class to open the menu
  } else {
    x.className = "topNav";  // Removes "responsive" class to close the menu
  }
}

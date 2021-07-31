window.onload = function(){
  var searchBar = document.getElementById("Search");
  document.getElementById('body').onkeyup = function(e) {
    if (e.keyCode === 13 && searchBar.selected) {
      document.getElementById('form').submit(); // your form has an id="form"
    }
    return true;
   }
}


window.onload = function(){


  var input = document.getElementById('upload');
  var infoArea = document.getElementById('upload-label');
  input.addEventListener( 'change', showFileName );

  function showFileName( event ) {
    var input = event.srcElement
    infoArea.textContent = "";
    if(input.files.length === 0){
      infoArea.textContent = "Upload New Image";
    }

    for(var i=0; i<input.files.length;i++){
      var infoAreaText = infoArea.textContent;
      if(i===0){
      infoArea.textContent = 'File name: ' + input.files[i].name;
      }
      else{
        infoArea.textContent = infoAreaText+ " & " + input.files[i].name;
      }
    }

  }
}

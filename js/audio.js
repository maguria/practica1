window.onload=ini;

function ini(){
    
   var audio=document.getElementsByTagName("audio");
    
   for(var i=0;i<audio.length;i++) {
      audio[i].addEventListener('play',manejaPlay); 
      audio[i].addEventListener('pause',manejaPause);
   }
    
}

function manejaPlay(){
    
    var imgDiv=document.getElementById('imagen');
    imgDiv.innerHTML='<h3>Reproduciendo...</h3>';
    var rutaImagen=this.getAttribute('name');
    var imagen=document.createElement('img');
    imagen.setAttribute('src',rutaImagen);
    imagen.setAttribute('width','100%');
    imgDiv.appendChild(imagen);
   
}

function manejaPause(){
    var imgDiv=document.getElementById('imagen');
    imgDiv.innerHTML="";
  
}




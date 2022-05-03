document.getElementById("btn1").onchange=function(e){
    let reader=new FileReader();
    reader.readAsDataURL(e.target.files[0]);
    reader.onload=function(){
        let preview = document.getElementById("areaImagen");
        imagen=document.createElement('img');
        imagen.src=reader.result;
        imagen.style.width="200px";
        preview.innerHTML="";
        preview.append(imagen);
    }
}

document.getElementById("btn1").addEventListener('click',
    function(){
        document.getElementById("areaImagen").style.padding="30px";
    }
)

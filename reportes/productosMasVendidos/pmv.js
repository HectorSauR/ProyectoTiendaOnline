

document.querySelector('.NProducto').addEventListener("change", (e) =>{

if (e.target.value<0){
  alert("NO PUEDES INGRESAR NUMEROS NEGATIVOS");
  e.target.value="";
  return;
 
}
})


document.querySelector(".categorias").addEventListener("change", (e) =>   {
    var cantidad_datos = document.querySelector('.NProducto').value;

    document.querySelector(".estatus").value="";
    
    var id = document.querySelector(".categorias").value;
  
    var object = {
      "id" : id
    }
  
    fetch("./pmvfetch.php",{
      method: "POST",
      body : JSON.stringify(object),
      headers : {
        'Content-Type': 'application/json'
      }
    })
    .then(response => response.json())
    .then(datos => {
       //console.log(datos);
       

       datos.sort((a , b)=>{
          
        if(a.CANTIDAD<b.CANTIDAD){
            return -1
        }

        if(a.CANTIDAD>b.CANTIDAD){
            return 1
        }
        
       })
       //console.log(datos);

       var tablael = document.querySelector('.ProductosMasVendidos');
        var ctablaelm = document.querySelector('tbody');

        var tablap=document.querySelector('.ProductosMasVendidos');
        var ctablap=document.createElement("tbody");
         
        tablael.removeChild(ctablaelm);


        console.log(cantidad_datos);

        console.log(datos.length);
       if (cantidad_datos == "" && datos.length < 5){
        
        console.log('aushdiashd')
       
        datos.forEach(element => {
            
         var fila =document.createElement('tr');
 
         var dato = document.createElement('td');
         dato.innerText = element['ID_PRODUCTO'];
         fila.appendChild(dato);
 
         
          dato = document.createElement('td');
         dato.innerText = element['NOMBRE'];
         fila.appendChild(dato);
 
          
          dato = document.createElement('td');
         dato.innerText = element['STOCK'];
         fila.appendChild(dato);
 
          
          dato = document.createElement('td');
         dato.innerText = element['PRECIO_COMPRA'];
         fila.appendChild(dato);
 
          
          dato = document.createElement('td');
         dato.innerText = element['PRECIO'];
         fila.appendChild(dato);
 
         dato = document.createElement('td');
         dato.innerText = element['ventrealizadas'];
         fila.appendChild(dato);
         
          dato = document.createElement('td');
         dato.innerText = element['CANTIDAD'];
         fila.appendChild(dato);
 
         ctablap.appendChild(fila);
 
         tablap.appendChild(ctablap);
         
        });
       }else if (cantidad_datos == "" && datos.length >=5){


        for (let i = 0; i < 5; i++) {
            
            var fila =document.createElement('tr');
 
            var dato = document.createElement('td');
            dato.innerText = datos[i]['ID_PRODUCTO'];
            fila.appendChild(dato);
    
            
             dato = document.createElement('td');
            dato.innerText = datos[i]['NOMBRE'];
            fila.appendChild(dato);
    
             
             dato = document.createElement('td');
            dato.innerText = datos[i]['STOCK'];
            fila.appendChild(dato);
    
             
             dato = document.createElement('td');
            dato.innerText = datos[i]['PRECIO_COMPRA'];
            fila.appendChild(dato);
    
             
             dato = document.createElement('td');
            dato.innerText = datos[i]['PRECIO'];
            fila.appendChild(dato);
    
            dato = document.createElement('td');
            dato.innerText = datos[i]['ventrealizadas'];
            fila.appendChild(dato);
            
             dato = document.createElement('td');
            dato.innerText = datos[i]['CANTIDAD'];
            fila.appendChild(dato);
    
            ctablap.appendChild(fila);
    
            tablap.appendChild(ctablap);
            
            
        }
       }else if(cantidad_datos != ""){
             
           for (let i = 0; i < cantidad_datos; i++) {
            var fila =document.createElement('tr');
 
            var dato = document.createElement('td');
            dato.innerText = datos[i]['ID_PRODUCTO'];
            fila.appendChild(dato);
    
            
             dato = document.createElement('td');
            dato.innerText = datos[i]['NOMBRE'];
            fila.appendChild(dato);
    
             
             dato = document.createElement('td');
            dato.innerText = datos[i]['STOCK'];
            fila.appendChild(dato);
    
             
             dato = document.createElement('td');
            dato.innerText = datos[i]['PRECIO_COMPRA'];
            fila.appendChild(dato);
    
             
             dato = document.createElement('td');
            dato.innerText = datos[i]['PRECIO'];
            fila.appendChild(dato);
    
            dato = document.createElement('td');
            dato.innerText = datos[i]['ventrealizadas'];
            fila.appendChild(dato);
            
             dato = document.createElement('td');
            dato.innerText = datos[i]['CANTIDAD'];
            fila.appendChild(dato);
    
            ctablap.appendChild(fila);
    
            tablap.appendChild(ctablap);
            
               
           }
       }
  

      
      })
  })



  document.querySelector(".estatus").addEventListener("change", (e) =>   {
    var cantidad_datos = document.querySelector('.NProducto').value;
    document.querySelector(".categorias").value="";
    var id_status = document.querySelector(".estatus").value;


    var object = {
        "ids" : id_status
      }
    
  
      fetch("./pmvfetch2.php",{
        method: "POST",
        body : JSON.stringify(object),
        headers : {
          'Content-Type': 'application/json'
        }
      })
      .then(response => response.json())
      .then(datos => {
         //console.log(datos);
         
  
         datos.sort((a , b)=>{
            
          if(a.CANTIDAD<b.CANTIDAD){
              return -1
          }
  
          if(a.CANTIDAD>b.CANTIDAD){
              return 1
          }
          
         })
         //console.log(datos);
          var tablael = document.querySelector('.ProductosMasVendidos');
          var ctablaelm = document.querySelector('tbody');

          tablael.removeChild(ctablaelm);

         var tablap=document.querySelector('.ProductosMasVendidos');
         var ctablap=document.createElement("tbody");

         
         if (cantidad_datos == "" && datos.length < 5){
        
            console.log('aushdiashd')
           
            datos.forEach(element => {
                
             var fila =document.createElement('tr');
     
             var dato = document.createElement('td');
             dato.innerText = element['ID_PRODUCTO'];
             fila.appendChild(dato);
     
             
              dato = document.createElement('td');
             dato.innerText = element['NOMBRE'];
             fila.appendChild(dato);
     
              
              dato = document.createElement('td');
             dato.innerText = element['STOCK'];
             fila.appendChild(dato);
     
              
              dato = document.createElement('td');
             dato.innerText = element['PRECIO_COMPRA'];
             fila.appendChild(dato);
     
              
              dato = document.createElement('td');
             dato.innerText = element['PRECIO'];
             fila.appendChild(dato);
     
             dato = document.createElement('td');
             dato.innerText = element['ventrealizadas'];
             fila.appendChild(dato);
             
              dato = document.createElement('td');
             dato.innerText = element['CANTIDAD'];
             fila.appendChild(dato);
     
             ctablap.appendChild(fila);
     
             tablap.appendChild(ctablap);
             
            });
           }else if (cantidad_datos == "" && datos.length >=5){
    
    
            for (let i = 0; i < 5; i++) {
                
                var fila =document.createElement('tr');
     
                var dato = document.createElement('td');
                dato.innerText = datos[i]['ID_PRODUCTO'];
                fila.appendChild(dato);
        
                
                 dato = document.createElement('td');
                dato.innerText = datos[i]['NOMBRE'];
                fila.appendChild(dato);
        
                 
                 dato = document.createElement('td');
                dato.innerText = datos[i]['STOCK'];
                fila.appendChild(dato);
        
                 
                 dato = document.createElement('td');
                dato.innerText = datos[i]['PRECIO_COMPRA'];
                fila.appendChild(dato);
        
                 
                 dato = document.createElement('td');
                dato.innerText = datos[i]['PRECIO'];
                fila.appendChild(dato);
        
                dato = document.createElement('td');
                dato.innerText = datos[i]['ventrealizadas'];
                fila.appendChild(dato);
                
                 dato = document.createElement('td');
                dato.innerText = datos[i]['CANTIDAD'];
                fila.appendChild(dato);
        
                ctablap.appendChild(fila);
        
                tablap.appendChild(ctablap);
                
                
            }
           }else if(cantidad_datos != ""){
                 
               for (let i = 0; i < cantidad_datos; i++) {
                var fila =document.createElement('tr');
     
                var dato = document.createElement('td');
                dato.innerText = datos[i]['ID_PRODUCTO'];
                fila.appendChild(dato);
        
                
                 dato = document.createElement('td');
                dato.innerText = datos[i]['NOMBRE'];
                fila.appendChild(dato);
        
                 
                 dato = document.createElement('td');
                dato.innerText = datos[i]['STOCK'];
                fila.appendChild(dato);
        
                 
                 dato = document.createElement('td');
                dato.innerText = datos[i]['PRECIO_COMPRA'];
                fila.appendChild(dato);
        
                 
                 dato = document.createElement('td');
                dato.innerText = datos[i]['PRECIO'];
                fila.appendChild(dato);
        
                dato = document.createElement('td');
                dato.innerText = datos[i]['ventrealizadas'];
                fila.appendChild(dato);
                
                 dato = document.createElement('td');
                dato.innerText = datos[i]['CANTIDAD'];
                fila.appendChild(dato);
        
                ctablap.appendChild(fila);
        
                tablap.appendChild(ctablap);
                
                   
               }
           }
         

         
        })
  })





  document.querySelector(".pdf_reporte").addEventListener("click", (e) =>{
    var doc = new jsPDF({
      orientation: 'landscape',
      format:'a2',
      precision:3,
      
    });

  
    var elementHTML = $('.tabla-consulta').html();
var specialElementHandlers = {
'#elementH': function (element, renderer) {
return true;
}
};
doc.fromHTML(elementHTML, 30, 30, {
'width': 170,
'elementHandlers': specialElementHandlers,


});


// Save the PDF
doc.save('document.pdf');
  })



document.querySelector(".excel_reporte").addEventListener("click", (e) =>{
  
  $('.ProductosMasVendidos').tblToExcel({
    
      complete:function () {
        // do something
      }

    });
    
  })


// const validate = new window.JustValidate("#dota2-torneo", {
//   tooltip: {
//     position: "left",
//   },
//   errorFieldCssClass: "is-invalid",
//   focusInvalidField: true,
//   errorLabelCssClass: "is-label-invalid",
// });


// validate.addField("#nameTeam", [
//     {
//       rule: "required",
//       errorMessage: "Ingresa nombre del equipo",
//     },
    
//   ])
//   .addField("#NameCapitan", [
//     {
//       rule: "required",
//       errorMessage: "Ingres nombre del capitan",
//     },
    
//   ])
//   .addField("#TelCapitan", [
//     {
//       rule: "required",
//       errorMessage: "Ingresa tu número telefónico",
//     },
    
//   ])
//   .addField("#NamePlayer2", [
//     {
//       rule: "required",
//       errorMessage: "Ingresa nombre completo",
//     },
    
//   ])
//   .addField("#TelPlayer2", [
//     {
//       rule: "required",
//       errorMessage: "Ingresa tu número telefónico",
//     },
    
//   ])
//   .addField("#NamePlayer3", [
//     {
//       rule: "required",
//       errorMessage: "Ingresa nombre completo",
//     },
   
//   ])
//   .addField("#TelPlayer3", [
//     {
//       rule: "required",
//       errorMessage: "Ingresa tu número telefónico",
//     },
    
//   ])
//   .addField("#NamePlayer4", [
//     {
//       rule: "required",
//       errorMessage: "Ingresa nombre completo",
//     },
    
//   ])
//   .addField("#TelPlayer4", [
//     {
//       rule: "required",
//       errorMessage: "Ingresa tu número telefónico",
//     },
   
//   ])
//   .addField("#NamePlayer5", [
//     {
//       rule: "required",
//       errorMessage: "Ingresa nombre completo",
//     },
    
//   ])
//   .addField("#TelPlayer5", [
//     {
//       rule: "required",
//       errorMessage: "Ingresa tu número telefónico",
//     },
   
//   ])
//   .addField("#comprobante", [
//     {
//       rule: "required",
//       errorMessage: "Suba su comprobante",
//     },
//     {
//       rule: "files",
//       value: ["jpg", "jpeg", "png"],
//       errorMessage: "Suba su comprobante",
//     },
  
//   ])
//   .addField("#datos-personales", [
//     {
//       rule: "required",
//       errorMessage: "Debes aceptar los términos y condiciones",
//     },
//   ])
//   .addField("#deacuerdo", [
//     {
//       rule: "required",
//       errorMessage: "Debes aceptar los términos y condiciones",
//     },
//   ])




//   validate
//   .onFail((errors) => {
//     console.log(errors);
    
//     for (const clave in errors) {
//       if (errors.hasOwnProperty(clave)) {
//         console.log(clave, errors[clave]);
//       }
//       const errorSpanId = clave.slice(1) + "-error";
//       const errorSpan = document.getElementById(errorSpanId);
//       if (errorSpan) {
//         errorSpan.innerHTML = errors[clave].errorMessage;
//       }
//     }
//   })
//   .onSuccess(() => {
   



//   });





 



  const formulario = document.getElementById("dota2-torneo");

  formulario.addEventListener("submit", function (event) {


  event.preventDefault(); 
  


 let loadingContainer = document.querySelector(".loading-container");

     loadingContainer.style.display = "flex"; 
     loadingContainer.style.visibility = "visible";
 

  const data = new FormData(formulario);

  fetch('inscriptions.php', {

     method: 'POST',
     body: data,
     
  })
  .then(function(response) {

   
      if(response.ok) {

          return response.text()

     } else {

          throw "intentelo mas tarde , error en el servidor";
     }

  })

  .then(function(server) {

     loadingContainer.style.display = "none";
     loadingContainer.style.visibility = "hidden";


    const response = JSON.parse(server);

  
     const rpta = document.getElementById('error-server');

     if(response.status == "ok") {

        
        
         rpta.classList.remove('danger-fetch');
         rpta.classList.add('success-fetch');
         

         rpta.textContent = response.description;

  
          

     } else {
        


         rpta.classList.remove('success-fetch');
         rpta.classList.add('danger-fetch');

         rpta.textContent = response.description;

     }



})
  .catch(function(err) {

       loadingContainer.style.display = "none";
          loadingContainer.style.visibility = "hidden";

      alertify.error(err);
  });



})

  
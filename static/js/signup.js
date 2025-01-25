  // addresses loader 
  fetch('http://clsonline.org/assets/php/addresses.php')
  .then(response => response.json())
  .then(data => {
    let jsonData = data; // store the parsed JSON data in a variable
    address = jsonData.data
    let myDiv = document.getElementById('address');


    for(let i = 0 ; i<address.length ; i++)
    {

        var componet =
         `
        <option value="${address[i].ID}">${address[i].NAME}</option>
         ` ;


        myDiv.innerHTML += componet ;  
    }

  })
  .catch(error => console.error('ERROR HAPPEND WHILE loading addresses ( ' + error + ') '))

  // clear values 

  var myForm = document.getElementById("signup_form");

  for (let i = 0; i < myForm.elements.length; i++) 
  {
    if (myForm.elements[i].type == 'reset' )
    {
      continue; 
    }
    
    if (myForm.elements[i].type == 'tel' )
    {
      continue; 
    }
   myForm.elements[i].value = ''; 
  }

function signup(event)
{

  event.preventDefault(); 
  var myForm = document.getElementById("signup_form");

  for (let i = 0; i < myForm.elements.length; i++) 
  {
    const element = myForm.elements[i];
    if (!element.checkValidity())
     {
     alert( "( " + element.name +" ) " + element.validationMessage);
     return ;
    }
    if(element.type === 'tel')
    {
        element.value ='0';
    }
  }

  var formData = new FormData(myForm); 


fetch("http://clsonline.org/assets/php/signup.php", { method: "POST", body: formData } )
.then(
  response =>
   {
      if (!response.ok)
      {
        alert('Please contact the support team!');
        return; 
      }
      return response.json();
  }
)
.then( data => 
{

    if ( data.data.message == 'SUCCESS')
      {
        window.location.href = "login.php";
        alert('The account has been created , Welcome!');
      }
      else
      {
        alert( data.data.message);
      }
      

})
.catch(error => 
{
  alert('here Please contact the support team!');
  console.log(error);
});

  

}


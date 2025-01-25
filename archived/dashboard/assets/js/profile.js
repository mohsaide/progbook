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
        <option value="${address[i].ID}">${address[i].NAME} </option>
         ` ;


        myDiv.innerHTML += componet ;  
    }

  })
  .catch(error => console.error('ERROR HAPPEND WHILE loading addresses ( ' + error + ') '))



  // save fun

function save_profile(event)
{   
  event.preventDefault(); 
  var myForm = document.getElementById("personal_from");
  var formData = new FormData(myForm); 
  

  for (let i = 0; i < myForm.elements.length; i++) 
  {
    const element = myForm.elements[i];
    if (!element.checkValidity())
     {
      if(element.name =='phone' && element.value =='' )
      {
          continue ;
      }
     alert( "( " + element.name +" ) " + element.validationMessage)
     return ;
    }
  }


     
    fetch("http://clsonline.org/dashboard/assets/php/set_user_info.php", {
        method: "POST",
        body: formData
      })
      .then(response => {
         
        if (!response.ok)
        {
          alert('Please contact support team!');
          return;
        }
       return response.json();
      })
      .then
      ( data => 
        {
          if (data.data.message =='UNAUTHORIZED')
          {
            window.location.href = "http://clsonline.org/assets/html/401.php";
          }
          else
          {
              location.reload();
              return;
          }

        }
      )
      .catch(error => {
        alert('Please contact support team!');
        return;
      });

    
}


function Myclear2(event)
{
  document.getElementById("file-input").value='';
}



function update_image(event) {
  event.preventDefault();
  const myForm = document.getElementById("UploadImg");
  const formData = new FormData(myForm);

  for (let i = 0; i < myForm.elements.length; i++) {
    const element = myForm.elements[i];
    if (!element.checkValidity()) {
      alert("(" + element.name + ") " + element.validationMessage);
      return;
    }
  }

  const imageFile = formData.get("image");

  const image = new Image();
  image.src = URL.createObjectURL(imageFile);

  image.onload = function () {
    const width = this.width;
    const height = this.height;

    if (width === height) {
      fetch("http://clsonline.org/dashboard/assets/php/set_user_img.php", {
        method: "POST",
        body: formData,
      })
        .then((response) => {
          return response.json();
        })
        .then( data => {
            
        var status = data.status ;
        if (status == '200_SUCCESS')
        {

          location.reload();
          return;
        
        }
        else if ( status ==='404_Not_Found' )
        {
            window.location.href = "http://clsonline.org/assets/html/404.php";
            return;
        }
        else if ( status ==='400_Bad_Request' )
        {
            window.location.href = "http://clsonline.org/assets/html/500.php";
            return;
        }
        else if ( status ==='401_UNAUTHORIZED' )
        {
            window.location.href = "http://clsonline.org/assets/html/401.php";
            return;
        }
        else if ( status ==='500_Internal_Server_Error' )
        {
            window.location.href = "http://clsonline.org/assets/html/500.php";
            return;
        }
          
        })
        .catch((error) => {
           window.location.href =
              "http://clsonline.org/assets/html/500.php";
          return;
        });
    } else {
      location.reload();
      alert("Please upload a square image!");
      return;
    }
  };
}

function reset(event)
{
    event.preventDefault(); 
    var myForm = document.getElementById('reset_form');
    for (let i = 0; i < myForm.elements.length; i++) 
    {

      const element = myForm.elements[i];
      if(element.value =='')
      {
        var reason = document.getElementById('reason');
        reason.innerHTML= 'Please enter the ELEMENTNAME.'.replace( 'ELEMENTNAME.', element.name ) ;
        var message = document.getElementById('success_message');
        message.style.display ='none' ;
        var message = document.getElementById('fail_message');
        message.style.display ='block' ;
        return;
      }
      if (!element.checkValidity())
       {
        var reason = document.getElementById('reason');
        reason.innerHTML= "( " + element.name +" ) " + element.validationMessage ;
        var message = document.getElementById('success_message');
        message.style.display ='none' ;
        var message = document.getElementById('fail_message');
        message.style.display ='block' ;
       return ; 
      }
    }

    var myForm = document.getElementById("reset_form");
    var formData = new FormData(myForm); 

    fetch("http://clsonline.org/dashboard/assets/php/reset.php", {
  method: "POST",
  body: formData
})
.then(response => {
  if (!response.ok) {

    var reason = document.getElementById('reason');
    reason.innerHTML='Please contact cls support team!' ;
    var message = document.getElementById('success_message');
    message.style.display ='none' ;
    var message = document.getElementById('fail_message');
    message.style.display ='block' ;
    var myForm = document.getElementById("reset_form");
    for (let i = 0; i < myForm.elements.length; i++) 
    {
     myForm.elements[i].value = ''; 
    }
    return;
   
  }
  return response.json();
})
.then(data => {
  if ( data.data.message== 'UNAUTHORIZED' )
  {
      
    window.location.href = "http://clsonline.org/assets/html/401.php";
    return;

  }
  else if ( data.data.message == 'DONE' )
  {
      
    var message = document.getElementById('fail_message');
    message.style.display ='none' ;
    var message = document.getElementById('success_message');
    message.style.display ='block' ;
    var myForm = document.getElementById("reset_form");
    for (let i = 0; i < myForm.elements.length; i++) 
    {
     myForm.elements[i].value = ''; 
    }
    return;

  }
  else
  { 
    var reason = document.getElementById('reason');
    reason.innerHTML= data.data.message ;
    var message = document.getElementById('success_message');
    message.style.display ='none' ;
    var message = document.getElementById('fail_message');
    message.style.display ='block' ;
    var myForm = document.getElementById("reset_form");
    for (let i = 0; i < myForm.elements.length; i++) 
    {
     myForm.elements[i].value = ''; 
    }
    return;

  }

})
.catch(error => {

  var reason = document.getElementById('reason');
  reason.innerHTML='Please contact cls support team!' ;
  var message = document.getElementById('success_message');
  message.style.display ='none' ;
  var message = document.getElementById('fail_message');
  message.style.display ='block' ;
  var myForm = document.getElementById("reset_form");
  for (let i = 0; i < myForm.elements.length; i++) 
  {
   myForm.elements[i].value = ''; 
  }
  return;

});
    
}




function send(event)
{

    event.preventDefault(); 
    if (document.getElementById('support_message').value === '')
    {
      var message = document.getElementById('support_success_message');
      message.style.display ='none' ;
      message = document.getElementById('support_fail_message');
      message.style.display ='block' ;
      return;
    }
    else
    {
     
     var formData = new FormData(); 
     formData.set("secret_code", "SECRET_TOKEN"); 
     formData.set("sys_src", '1');
     formData.set("message", '[ ' + sessionStorage.getItem('email') + ' ] needs some supporting.\n' + document.getElementById('support_message').value );
     formData.set("subject", "Suppoting" );
     formData.set("to", "mhmd_arafat"); // no needed
     
      
        fetch("http:///clsonline.org/assets/php/mailing.php", {
          method: "POST",
          body: formData
        })
        .then(response => {
          

          if (response['status']==200)
          {
           document.getElementById('support_message').value=''; 
           
            var message = document.getElementById('support_fail_message');
            message.style.display ='none' ;
            message = document.getElementById('support_success_message');
            message.style.display ='block' ;
            
            return; 
  
          }
          else
          {

            var message = document.getElementById('support_success_message');
            message.style.display ='none' ;
            document.getElementById('support_fail_message').innerHTML = '<strong>Success!</strong> Please contact support team!';
            var message = document.getElementById('support_fail_message');
            message.style.display ='block' ;
            return;    
  
          }
         
        })
        .catch(error => {
      
          var message = document.getElementById('support_success_message');
            message.style.display ='none' ;
            document.getElementById('support_fail_message').innerHTML = '<strong>Success!</strong> Please contact support team!';
            var message = document.getElementById('support_fail_message');
            message.style.display ='block' ;
            return;

        });


    }


}


function Myclear(event)
{
      event.preventDefault(); 
      var message = document.getElementById('support_success_message');
      message.style.display ='none' ;
      var message = document.getElementById('support_fail_message');
      message.style.display ='none' ;
      var message = document.getElementById('success_message');
      message.style.display ='none' ;
      var message = document.getElementById('fail_message');
      message.style.display ='none' ;

      var myForm = document.getElementById("reset_form");
      for (let i = 0; i < myForm.elements.length; i++) 
      {
       myForm.elements[i].value = ''; 
      }
      

      var myForm = document.getElementById("support_form");
      for (let i = 0; i < myForm.elements.length; i++) 
      {
       myForm.elements[i].value = ''; 
      }
  
}



function rate(event)
{
    
    event.preventDefault();
    var feedbackForm = document.getElementById('feedback_area');
    var formData = new FormData(feedbackForm);
    
    fetch("http://clsonline.org/dashboard/assets/php/rate.php",
    {
      method: "POST",
      body: formData
    }
    )
    .then(response => 
    {
     
          return response.json();
    }
    )
    .then(
        data =>
    {
        var status = data.status ;
        
        if (status == '200_SUCCESS')
        {
          alert('Thanks for rating.')
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
            // window.location.href = "http://clsonline.org/assets/html/500.php";
            return;
        }
        else if ( status ==='401_UNAUTHORIZED' )
        {
            window.location.href = "http://clsonline.org/assets/html/401.php";
            return;
        }
        else if ( status ==='500_Internal_Server_Error' )
        {
            
            // window.location.href = "http://clsonline.org/assets/html/500.php";
            return;
        }
    } 
     )
   

}
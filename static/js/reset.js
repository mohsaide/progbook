  // clear values 

  var myForm = document.getElementById("autoreset_from");

  for (let i = 0; i < myForm.elements.length; i++) 
  {
   myForm.elements[i].value = ''; 
  }


function AutoRset(event) {
  // The password or password you’ve entered is incorrect.
    event.preventDefault(); 


  
    for (let i = 0; i < myForm.elements.length; i++) 
    {

      const element = myForm.elements[i];
      if(element.value =='')
      {
        alert( 'Please enter the ELEMENTNAME.'.replace( 'ELEMENTNAME.', element.name ) );
        return;
      }
      if (!element.checkValidity())
       {
       alert( "( " + element.name +" ) " + element.validationMessage)
       return ;
      }
    }



var formData = new FormData(myForm); 


fetch("http://clsonline.org/assets/php/reset.php", {
method: "POST",
body: formData
})
.then(response => {
if (!response.ok) {

    
    setTimeout(function() {
        document.getElementById('typeEmail').value =''; 
        var res_box = document.getElementById('response_box');
        res_box.style.backgroundColor = 'red'; 
        res_box.style.display = 'block'; 
        res_box.innerHTML = 'Please contact CLS support team.' ; 
            
          }, 1000);
     return;     

}
return response.json();
})
.then(data =>
     {

        if (data.data.success_flag ==1 ) {

            setTimeout(function() {
            document.getElementById('typeEmail').value =''; 
            var res_box = document.getElementById('response_box');
            res_box.style.backgroundColor = 'green'; 
            res_box.style.display = 'block'; 
            res_box.innerHTML = 'New Password has sent to your inbox.' ; 
                
              }, 1000);
               
        }
        else
        {
    
            setTimeout(function() {
                var res_box = document.getElementById('response_box');
                res_box.style.backgroundColor = 'red'; 
                res_box.style.display = 'block'; 
                res_box.innerHTML = 'Email is not existed.' ; 
                    
                  }, 1000);
    
        }

     }
)
.catch(error => {

    setTimeout(function() {

        document.getElementById('typeEmail').value =''; 
        var res_box = document.getElementById('response_box');
        res_box.style.backgroundColor = 'red'; 
        res_box.style.display = 'block'; 
        res_box.innerHTML = 'Please contact CLS support team.' ; 
            
          }, 1000);


});

    
}
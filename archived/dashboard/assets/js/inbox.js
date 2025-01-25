


window.onload = function load_active_friend_list()
{
   const myDiv = document.getElementById("chat-history");
   myDiv.style.opacity = 0 ; 
    const urlParams = new URLSearchParams(window.location.search);
    var userid = urlParams.get('userid');
    if ( userid === null)   document.getElementById( '0' ).classList.add('active'); ;
    
    
  fetch('http://clsonline.org/dashboard/assets/php/friends.php')
      .then(response => response.json())
      .then(data => {
        let jsonData = data; 
        let status = jsonData.status ;

        if (status == '200_SUCCESS')
        {
        
             if ( jsonData.data.metaData.counter == 0)
              {
                return ;
              }
              else
              {
                let myDiv = document.getElementById('friendsList');
                const friends = data.data.metaData.friends;
                var active_flag = '';
                friends.forEach((item) => {
                     
                     if (item.id === userid)
                     {
                      active_flag=' active';
                     }
                     else
                     {
                      active_flag=' ';   
                     }

                 
                    var componet =
                    `<li class="clearfix friend` + active_flag +  `" id='${item.id}'' onclick='window.location.href = "http://clsonline.org/dashboard/assets/html/inbox.php?userid=${item.id}";' ">
                    <img src="../../../assets/img/user/${item.image}"  alt="avatar">
                    <div class="about">
                        <div class="name">${item.name}</div>
                        <div class="status"> <i class="fa fa-circle ${item.status}"></i> ${item.status} </div>                                            
                    </div>
                </li>`;
                
                myDiv.innerHTML += componet ;  


                });
              }
              

        
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
      .catch(error => {
          window.location.href = "http://clsonline.org/assets/html/500.php";
          return;

          }
          )
   myDiv.scrollTop = myDiv.scrollHeight - myDiv.clientHeight;      
   myDiv.style.opacity = 1 ; 



}


function send(event)
{
    event.preventDefault();
    const urlParams = new URLSearchParams(window.location.search);
    if (document.getElementById('plain_text').value === '')
    {
        alert("Empty Message can't be sent.");
        return;
    }
    
    const formData = new FormData();
    formData.append('msg', document.getElementById('plain_text').value );
    formData.append('friend_id', urlParams.get('userid') );
    
    
        fetch("http://clsonline.org/dashboard/assets/php/send_msg.php", {
        method: "POST",
        body: formData
      })
      .then(response => {
       return response.json();
      })
      .then
      ( data => 
        {
            
        let jsonData = data; 
        let status = jsonData.status ;

        if (status == '200_SUCCESS')
        {
            location.reload();
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
         
         

        }
      )
      .catch(error => {
        alert('Please contact support team!');
        return;
      });
    
    
}





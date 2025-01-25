function load(type)
{

    if(type ==='con')
    {
        var listItems = document.querySelectorAll(".con_type");
        listItems.forEach(function(item) {
        listItems.forEach
        (
            function(ii) 
            {
                ii.classList.remove("active_con");
            }
        )
        
        });
        document.getElementById("con").classList.add("active_con");
        

      fetch('http://clsonline.org/dashboard/assets/php/people.php?type=con')
      .then(response => response.json())
      .then(data => {
        let jsonData = data; 
        let status = jsonData.status ;

        if (status == '200_SUCCESS')
        {

        let users = jsonData.data.users ; 
        let myDiv = document.getElementById('user_cards');
        myDiv.innerHTML = '';
        for(let i = 0 ; i< users.length ; i++)
        {
           
    
            var componet =
             `
                <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
              <div class="card">
                <img
                  src="http://clsonline.org/assets/img/user/${users[i].image}"
                  class="card-img-top ratio ratio-1x1"
                />
                <div class="card-body">
                  <h5 class="card-title"> <a class='text-primary' href='http://clsonline.org/dashboard/assets/html/profile.php?UserId=${users[i].user_id}'>  ${users[i].name}  </a></h5>
                  <p class="card-text">
                     ${users[i].role}
                  </p>
                  <a href="#" id='${users[i].user_id}' onclick='contact(event , this.id)' class="btn btn-primary">Contact</a>
                  <a href="#"  id='${users[i].user_id}' onclick='block(event , this.id)'  class="btn btn-primary">Block</a>
                  <a href="#"  id='${users[i].user_id}' onclick='unadd(event , this.id)'  class="btn btn-primary">Unadd</a>
                </div>
              </div>
            </div>
            
             ` ;
    
    
            myDiv.innerHTML += componet ;  
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

  
    
    }
    else if (type =='uncon')
    {
        var listItems = document.querySelectorAll(".con_type");
        listItems.forEach(function(item) {
        listItems.forEach
        (
            function(ii) 
            {
                ii.classList.remove("active_con");
            }
        )
        
        });
        document.getElementById("uncon").classList.add("active_con");
        
        
      fetch('http://clsonline.org/dashboard/assets/php/people.php?type=uncon')
      .then(response => response.json())
      .then(data => {
        let jsonData = data; 
        let status = jsonData.status ;

        
        if (status == '200_SUCCESS')
        {

        let users = jsonData.data.users ; 
        let myDiv = document.getElementById('user_cards');
        myDiv.innerHTML = '';
        for(let i = 0 ; i< users.length ; i++)
        {
           
    
            var componet =
             `
                <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
              <div class="card">
                <img
                  src="http://clsonline.org/assets/img/user/${users[i].image}"
                  class="card-img-top ratio ratio-1x1"
                />
                <div class="card-body">
                <h5 class="card-title"> <a class='text-primary' href='http://clsonline.org/dashboard/assets/html/profile.php?UserId=${users[i].user_id}'>  ${users[i].name}  </a></h5>
                  <p class="card-text">
                     ${users[i].role}
                  </p>
                  <a href="#"  id='${users[i].user_id}' onclick='add(event , this.id)' class="btn btn-primary">Add</a>
                </div>
              </div>
            </div>
            
             ` ;
    
    
            myDiv.innerHTML += componet ;  
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
        
    
      
    }
    else if (type =='block')
    {
        var listItems = document.querySelectorAll(".con_type");
        listItems.forEach(function(item) {
        listItems.forEach
        (
            function(ii) 
            {
                ii.classList.remove("active_con");
            }
        )
        
        });
        document.getElementById("block").classList.add("active_con"); 
        
        
      fetch('http://clsonline.org/dashboard/assets/php/people.php?type=block')
      .then(response => response.json())
      .then(data => {
        let jsonData = data; 
        let status = jsonData.status ;
        
        if (status == '200_SUCCESS')
        {

        let users = jsonData.data.users ; 
        let myDiv = document.getElementById('user_cards');
        myDiv.innerHTML = '';
        for(let i = 0 ; i< users.length ; i++)
        {
           
    
            var componet =
             `
                <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
              <div class="card">
                <img
                  src="http://clsonline.org/assets/img/user/${users[i].image}"
                  class="card-img-top ratio ratio-1x1"
                />
                <div class="card-body">
                <h5 class="card-title"> <a class='text-primary' href='http://clsonline.org/dashboard/assets/html/profile.php?UserId=${users[i].user_id}'>  ${users[i].name}  </a></h5>
                  <p class="card-text">
                     ${users[i].role}
                  </p>
                  <a href="#"  id='${users[i].user_id}' onclick='unblock(event , this.id)' class="btn btn-primary">Unblock</a>
                </div>
              </div>
            </div>
            
             ` ;
    
    
            myDiv.innerHTML += componet ;  
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

    }
    else
    {
         window.location.href = "http://clsonline.org/assets/html/500.php";
          return;
    }
}

function unblock(event , id)
{
    event.preventDefault();
    
    var formData = new FormData();
    formData.append("userid", id );
    formData.append("type", 'UNBLOCK' );

    
    fetch("http://clsonline.org/dashboard/assets/php/action.php", {
      method: "POST",
      body: formData
    })
    .then(response => {
     
          return response.json();
    })
    .then( data =>
    {
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
     
    }
        )
    .catch(error => {
      console.error(error);
    });
}

function add(event , id)
{
    event.preventDefault();
    
    var formData = new FormData();
    formData.append("userid", id );
    formData.append("type", 'ADD' );

    
    fetch("http://clsonline.org/dashboard/assets/php/action.php", {
      method: "POST",
      body: formData
    })
    .then(response => {
     
          return response.json();
    })
    .then( data =>
    {
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
     
    }
        )
    .catch(error => {
      console.error(error);
    });
    
}

function unadd(event , id)
{
    event.preventDefault();
    
    var formData = new FormData();
    formData.append("userid", id );
    formData.append("type", 'UNADD' );

    
    fetch("http://clsonline.org/dashboard/assets/php/action.php", {
      method: "POST",
      body: formData
    })
    .then(response => {
     
          return response.json();
    })
    .then( data =>
    {
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
     
    }
        )
    .catch(error => {
      console.error(error);
    });
    
}

function block(event , id)
{
    event.preventDefault();
    
    var formData = new FormData();
    formData.append("userid", id );
    formData.append("type", 'BLOCK' );

    
    fetch("http://clsonline.org/dashboard/assets/php/action.php", {
      method: "POST",
      body: formData
    })
    .then(response => {
     
          return response.json();
    })
    .then( data =>
    {
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
     
    }
        )
    .catch(error => {
      console.error(error);
    });
    
}

function contact(event , id)
{
    event.preventDefault();
    window.location.href = "http://clsonline.org/dashboard/assets/html/inbox.php?userid="+id;
    
}












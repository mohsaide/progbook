// testimonials loader 
fetch('http://clsonline.org/assets/php/testimonials.php')
  .then(response => response.json())
  .then(data => {
    let jsonData;
    jsonData = data; // store the parsed JSON data in a variable
    users = jsonData.data
    let myDiv = document.getElementById('rates_id');
    for(let i = 0 ; i<users.length ; i++)
    {

        var componet =
         `<div class="swiper-slide">
        <div class="testimonial-wrap">
        <div class="testimonial-item">
            <div class="d-flex align-items-center">
            <img src="assets/img/user/${users[i].IMAGE}" class="testimonial-img flex-shrink-0" >
            <div>
                <h3>${users[i].NAME}</h3>
                <h4>${users[i].ROLE}</h4>
                <div class="stars">
                ${'<span style="color: gold; font-size: larger;">✮</span>'.repeat(users[i].RATE)}
                </div>
            </div>
            </div>
            <p>
            <i class="bi bi-quote quote-icon-left"></i>
            ${users[i].FEEDBACK}
            <i class="bi bi-quote quote-icon-right"></i>
            </p>
        </div>
        </div>
    </div><!-- End testimonial item -->` ;

    myDiv.innerHTML += componet ;     
    }


  })
  .catch(error => console.error('ERROR HAPPEND WHILE loading testimials  ( ' + error + ') '));


// stats loader
fetch('http://clsonline.org/assets/php/stats.php')
  .then(response => response.json())
  .then(data => {
    jsonData = data; // store the parsed JSON data in a variable
    users = jsonData.data
    let myDiv = document.getElementById('stats_counter');
    for(let i = 0 ; i<users.length ; i++)
    {

        var componet =
        `<div class="stats-item d-flex align-items-center">
        <h1 class="bold mx-3" style="color:#008374; font-family: 'Changa', sans-serif;">${users[i].COUNT}</h1>\
        <p><strong class="h2">${users[i].ITEM}</strong> ${users[i].DESCR}.</p>
         </div>`;

    myDiv.innerHTML += componet ;  

    }})
  .catch(error => console.error('ERROR HAPPEND WHILE loading stats  ( ' + error + ') '));



  // faq loader 
  fetch('http://clsonline.org/assets/php/faq.php')
  .then(response => response.json())
  .then(data => {
    let jsonData = data; // store the parsed JSON data in a variable
    users = jsonData.data
    let myDiv = document.getElementById('faqlist');

    var sign_faq =
    `<div class="accordion-item">
    <h3 class="accordion-header">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sign-faq-item">
        <span class="num">◆</span>
        Please sign in to see more.
      </button>
    </h3>
    <div id="sign-faq-item" class="accordion-collapse collapse" data-bs-parent="#faqlist">
      <div class="accordion-body">
        <a href="/assets/html/login.php" class="link" style="color: black; " id="#faq_link">Click here</a>
      </div>
    </div>
    </div>`;


    for(let i = 0 ; i<users.length ; i++)
    {

        var componet =
         `<div class="accordion-item">\
        <h3 class="accordion-header">\
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#${'FAQ_ITEM_'.concat(i+1)}">\
            <span class="num">${i+1}.</span>
            ${users[i].QUESTION}
          </button>
        </h3>
        <div id="${'FAQ_ITEM_'.concat(i+1)}" class="accordion-collapse collapse" data-bs-parent="#faqlist">
          <div class="accordion-body">
          ${users[i].ANSWER}
          </div>
        </div>
        </div>` ;

    // TO SHOW JUST 4 ELEMENTS
    myDiv.innerHTML += componet ;  
    if(i==4)break ;   

    }

    myDiv.innerHTML += sign_faq ; 

  })
  .catch(error => console.error('ERROR HAPPEND WHILE loading testimials ( ' + error + ') '));


  // team members loader 
  fetch('http://clsonline.org/assets/php/team.php')
  .then(response => response.json())
  .then(data => {
    let jsonData = data; // store the parsed JSON data in a variable
    members = jsonData.data
    let myDiv = document.getElementById('team_members');

    for(let i = 0 ; i<members.length ; i++)
    {

        var componet =
         `
         <div class="col-xl-4 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="300">
         <div class="member">
           <img src="assets/img/team/${members[i].IMAGE}" class="img-fluid" alt="">
           <h4>${members[i].NAME}</h4>
           <span>${members[i].ROLE}</span>
           <div class="social">
             <a href="${members[i].TWITER}" target='_blank'><i class="bi bi-twitter"></i></a>
             <a href="${members[i].FACEBOOK}" target='_blank'><i class="bi bi-facebook"></i></a>
             <a href="${members[i].INSTGRAM}" target='_blank'><i class="bi bi-instagram"></i></a>
             <a href="${members[i].LINKEDIN}" target='_blank'><i class="bi bi-linkedin"></i></a>
           </div>
         </div>
       </div>
         ` ;


        myDiv.innerHTML += componet ;  
    }

  })
  .catch(error => console.error('ERROR HAPPEND WHILE loading team ( ' + error + ') '));
  
  
  
  function buy(event , id)
  {
      event.preventDefault(); 
      document.getElementById('message').value = 'I want to subscribe in ' + id ;
      
      window.location.href = "index.php#contact";

  }
  
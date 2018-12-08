$('.form').find('input, textarea').on('keyup blur focus', function (e) {
  
  var $this = $(this),
      label = $this.prev('label');

	  if (e.type === 'keyup') {
			if ($this.val() === '') {
          label.removeClass('active highlight');
        } else {
          label.addClass('active highlight');
        }
    } else if (e.type === 'blur') {
    	if( $this.val() === '' ) {
    		label.removeClass('active highlight'); 
			} else {
		    label.removeClass('highlight');   
			}   
    } else if (e.type === 'focus') {
      
      if( $this.val() === '' ) {
    		label.removeClass('highlight'); 
			} 
      else if( $this.val() !== '' ) {
		    label.addClass('highlight');
			}
    }

});

$('.tab a').on('click', function (e) {
  
  e.preventDefault();
  
  $(this).parent().addClass('active');
  $(this).parent().siblings().removeClass('active');
  
  target = $(this).attr('href');

  $('.tab-content > div').not(target).hide();
  
  $(target).fadeIn(600);
  
});

$(".toggle-password").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});



function getTheTours() {
  var firstName = document.getElementById("fname").value.toString();
  var lastName = document.getElementById("lname").value.toString();
  var password = document.getElementById("pwd").value.toString();
  var age = document.getElementById("age").value.toString();

  // Check browser support
  if (typeof(Storage) !== "undefined" && firstName != "" && lastName != "" && age != "") {
    // Store
    localStorage.clear();
    localStorage.setItem('firstName', firstName);
    localStorage.setItem('lastName', lastName);
    localStorage.setItem('age', age);
    localStorage.setItem('flag', 0);
  //  window.open("http://www-student.cse.buffalo.edu/museum/tours/testmaster/index.html", "_self");
    window.location.href='index.html';
    // Retrieve
  } else {
    //alert("Sorry, your browser does not support Web Storage...");
  }

}

function loginAsAdmin(){
       //$.fn.loginAsAdmin();

        var adminEmail = document.getElementById("adminEmail").value.toString();
        var adminPwd = document.getElementById("adminPwd").value.toString();



        $.ajax({
          type: 'POST',
          data:{'adminEmail':adminEmail,'adminPwd':adminPwd},
          dataType:'json',
          url: '/museum/tours/api/login.php',
          success: function(data){
             alert("success");
             localStorage.setItem('adminTab',adminEmail);
           // localStorage.setItem('age', age);

           window.location.href='index.html',true;
          },
          error: function(xhr, status, error) {
            alert(status);
            alert(error);
          }
          });

        /*if(adminEmail == "ahunt@buffalo.edu" && adminPwd=="alan"){
            localStorage.setItem('adminTab',adminEmail);
           // localStorage.setItem('age', age);

           window.location.href='index.html',true;


        }else{
          alert("Invalid username or password !");
        }*/

   }


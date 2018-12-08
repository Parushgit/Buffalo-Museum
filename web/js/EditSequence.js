var currId = 0;//current tour id
var slideIndex = 1;
//alert('on page load');

$(document).ready(function() {
     
     if(!("adminTab" in localStorage)){
            $("#adminTab").hide();
        }


        if(!("adminTab" in localStorage) && !("age" in localStorage)){
            window.location.href='login.html';
        }

     var currSeq= JSON.parse(localStorage.getItem('seqStr'));



     $.fn.loadSequences= function(){ 
       
        var mapsStr = JSON.parse(localStorage.getItem('mapsStr'));
        var seqStr = JSON.parse(localStorage.getItem('seqStr'));
        
        var coord = seqStr.cord;
        var splits = coord.split("-");
        
        var thtml ="";
        for (i = 0; i < mapsStr.length; i++) {
           if (seqStr.img !== undefined && seqStr.img===mapsStr[i]){
            slideIndex=i+1;
            thtml+="<div class='mySlides slidesfade' style='padding:10%''>"
            thtml+="<div class='imgcontain' class='img-container'><img class='mapImg' src='"+mapsStr[i]+ "' style='width:100%'>"

              thtml+=" <div id='pins'>"
              thtml+=" <div class='pin pin-1'"
              thtml+="style='top:"+splits[0]+"%;left:"+splits[1]+"%'></div></div>"
              
             thtml+="</div>"
             thtml+= "</div>"
           }else{
              thtml+="<div class='mySlides slidesfade' style='padding:10%''>"
              thtml+="<div class='imgcontain' class='img-container'><img class='mapImg' src='"+mapsStr[i]+ "' style='width:100%'>"
             thtml+="</div>"
             thtml+= "</div>"

           }
        }

        thtml+= "<a id='prev' class='prev' >&#10094;</a>"
        thtml+="<a id='next' class='next' >&#10095;</a>"
     
         //alert(thtml);
        $("#slidecontainer").html(thtml);

     }


      $.fn.reassignPin= function(path,coord){ 
         
        $("#slidecontainer").html('');

        currSeq.img=path;
        currSeq.cord=coord;

       //// alert(path);
        var mapsStr = JSON.parse(localStorage.getItem('mapsStr'));

        var thtml ="";

        var splits = coord.split("-");

        for (i = 0; i < mapsStr.length; i++) {
           if (path !== undefined && path===mapsStr[i]){

            thtml+="<div class='mySlides slidesfade' style='padding:10%''>"
            thtml+="<div class='imgcontain' class='img-container'><img class='mapImg' src='"+mapsStr[i]+ "' style='width:100%'>"

              thtml+=" <div id='pins'>"
              thtml+=" <div class='pin pin-1'"
              thtml+="style='top:"+splits[0]+"%;left:"+splits[1]+"%'></div></div>"
              
             thtml+="</div>"
             thtml+= "</div>"
           }else{
              thtml+="<div class='mySlides slidesfade' style='padding:10%''>"
              thtml+="<div class='imgcontain' class='img-container'><img class='mapImg' src='"+mapsStr[i]+ "' style='width:100%'>"
             thtml+="</div>"
             thtml+= "</div>"

           }
        }

        thtml+= "<a id='prev' class='prev' >&#10094;</a>"
        thtml+="<a id='next' class='next' >&#10095;</a>"

        $("#slidecontainer").html(thtml);
        ////slideIndex=1
        $.fn.showSlides(slideIndex);



      $( "#prev" ).click(function() {
           $.fn.plusSlides(-1);
      });

       $( "#next" ).click(function() {
           $.fn.plusSlides(1);
      });

       $('.mapImg').click(function(e) {
       var offset_t = $(this).offset().top - $(window).scrollTop();
       var offset_l = $(this).offset().left - $(window).scrollLeft();

        var left = Math.round( (e.clientX - offset_l) );
        var top = Math.round( (e.clientY - offset_t) );


        var target = event.target;
         

        var leftPercent = left / $(this).parent().width() * 100;
        var topPercent = top / $(this).parent().height() * 100;

        leftPercent=leftPercent.toFixed(2);
        topPercent=topPercent.toFixed(2);

       // var path = $(".mapImg").attr("src");
        var path = $(this).attr("src")
       
        $.fn.reassignPin(path,topPercent+"-"+leftPercent);
      });

      } 


       $.fn.resetSequence= function(){ 

           $.fn.loadSequences();


          var seqStr = JSON.parse(localStorage.getItem('seqStr'));
          var coord = seqStr.cord;
          currSeq.path=seqStr.img;
          currSeq.cord=seqStr.cord;

           $.fn.showSlides(slideIndex);

          $( "#prev" ).click(function() {
           $.fn.plusSlides(-1);
          });

           $( "#next" ).click(function() {
               $.fn.plusSlides(1);
          });

           $('.mapImg').click(function(e) {
           var offset_t = $(this).offset().top - $(window).scrollTop();
           var offset_l = $(this).offset().left - $(window).scrollLeft();

            var left = Math.round( (e.clientX - offset_l) );
            var top = Math.round( (e.clientY - offset_t) );


            var target = event.target;
             

            var leftPercent = left / $(this).parent().width() * 100;
            var topPercent = top / $(this).parent().height() * 100;

           // var path = $(".mapImg").attr("src");
            var path = $(this).attr("src")
            //alert($(this).attr("src"));
           /// alert(path);


           /// alert("Left: " + leftPercent + " Top: " + topPercent);

            $.fn.reassignPin(path,topPercent+"-"+leftPercent);
          });



       }


//all description functions
     $.fn.loadDesc = function(){ 

        var desc=currSeq.text;
        $("#descArea").val(desc);

    }

    $.fn.saveDesc = function(){ 

        var retVal = "true";
       
        var desc= $("#descArea").val();
        if(desc == ''){
          alert("Please enter a valid description");
          retVal="false";
        } 
        else{
          currSeq.text[0]=desc.replace(/[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '');
        } 
        //alert(currSeq.desc);

        return retVal;
    }

    $.fn.cancelDesc = function(){ 

        var origSeq= JSON.parse(localStorage.getItem('seqStr'));
        var desc=origSeq.text;
        currSeq.text[0]=desc;

        $("#descArea").val(desc);
    }
    
     $.fn.loadSequences();
     $.fn.loadDesc();

     $( "#saveDesc" ).click(function() {
           $.fn.saveDesc();
      });

     $( "#cancelDesc" ).click(function() {
           $.fn.cancelDesc();
      });

// all question functions 




      $.fn.deleteAllques = function(){ 

          var con = confirm("Are you sure want to delete all questions ?");

          if(con){
             currSeq.questions=[];
             $("#allques").html('');
          }
         
      }


      $( "#allqdelete").click(function() {
           //alert("before calling");
           $.fn.deleteAllques();
      });


       $( "#allqcancel").click(function() {
           //alert("before calling");
          $.fn.loadAllques();
      });

       $( "#nqadd").click(function() {
           //alert("before calling");
          $.fn.addNewQuestion();
      });

       $( "#allqsave").click(function() {
           //alert("before calling");
          $.fn.allQuestionsSave();
      });



     $.fn.checkRadioButton=function(i){

         var retVal = "true";


         
         if (!$("input[name='answercrad"+i+"']:checked").val()) {
             retVal = "false";
             alert("Please choose a correct answer for this question");
             $("input[name='answercrad"+i+"']").focus();
          }else{
             currSeq.questions[i].correct_answer=$("input[name='answercrad"+i+"']:checked").val();
          }
          


          return retVal;
      } 
      

      $.fn.updateCurrentQues=function(i){
          //alert("in update current");
          var retVal = "true";

          if(!($("#ques"+i).is(":hidden"))){
              retVal= $.fn.updateCurrentQuesText(i);
              if(retVal=="false") return retVal;
              retVal=$.fn.updateAnswerSection(i);
              if(retVal=="false") return retVal;


          }

          return retVal;
          //alert(currSeq.questions[n].question)
          
      }


      
      

       $.fn.deletecurranswer=function(i,j){
           
            var con=confirm("Are you sure you want to delete the answer?")

            if(con){
                $("#answerc"+i+j).hide();
            }
           
            
      }

       $.fn.resetthisanswer=function(i,j){
          //alert("indeletecurranswer");

          var origSeq= JSON.parse(localStorage.getItem('seqStr'));

          var origAnswers = origSeq.questions[i].answers;
          var currAnswers = currSeq.questions[i].answers;

          currSeq.questions[i].answers[j]=origSeq.questions[i].answers[j];
          $.fn.loadanswer(origSeq.questions[i].answers[j],i,j);
          
            //alert( $("#answers"+i).html());
      }
      
       $.fn.updatecurranswer=function(i,j){
          var retVal = "true";

          var answerText =  $("#answerctext"+i+j).val();
          if(answerText == ''){
            retVal = "false";
            alert("Please enter a valid answer text");
             $("#answerctext"+i+j).focus();
          }else{
            currSeq.questions[i].answers[j]=answerText.replace(/[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '');

          } 
          return retVal;
       }

     $.fn.updateCurrentQuesText = function(i){ 

        var qText= $("#quesArea"+i).val();
        var retVal = "true";
        if(!($("#ques"+i).is(":hidden"))){
             if(qText == ''){
              retVal = "false";
              alert("Please enter a valid question text");
              $("#quesArea"+i).focus();
             } 
             else {
              currSeq.questions[i].question=qText.replace(/[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '');
            }
        } 
      
        return retVal;
        //alert(currSeq.desc);
    }

    $.fn.cancelCurrentQuesText = function(i){ 

        var origSeq= JSON.parse(localStorage.getItem('seqStr'));
        var ques=origSeq.questions[i];
        currSeq.questions[i].question=ques.question;
        $("#quesArea"+i).val('');
        $("#quesArea"+i).val(ques.question);
    }
     

      $.fn.cancelCurrentQues=function(i){

           //alert("defining funct");
           var con = confirm("Are you sure you want to reset this question ?")

           if(con){
                var origSeq= JSON.parse(localStorage.getItem('seqStr'));
                var ques = origSeq.questions;
                currSeq.questions[i]=origSeq.questions[i];

                $("#ques"+i).html('');
                  
                $.fn.loadquestion(ques,i);
           }

          
          
      }

       $.fn.deleteCurrentQues=function(i){

           var con = confirm("Are you sure you want to delete the question ?")
            
           if(con){
             $("#ques"+i).hide();
           }
          
      }

       $.fn.resetAnswerSection=function(i){
          
           var con = confirm("Are you sure you want to reset the answer section ?")

           if(con){

             var origSeq= JSON.parse(localStorage.getItem('seqStr'));
             currSeq.questions[i].answers = origSeq.questions[i].answers;

             $("#answersection"+i).html('');


             var answers = currSeq.questions[i].answers;
             var qhtml=""

            for(j=0;j<answers.length;j++){
                   qhtml+="<div id='answerc"+i+j+"'>"
                   qhtml+="</div>"
                }
              
             $("#answersection"+i).html(qhtml);

             for(j=0;j<answers.length;j++){
               $.fn.loadanswer(answers[j],i,j);
              }
           }

           
          

       }

       $.fn.updateAnswerSection=function(i){

          var retVal = "true";

          var answers = currSeq.questions[i].answers;
          
          var vans=0;
          for(j=0;j<answers.length;j++){
              if(!($("#answerc"+i+j).is(":hidden"))){
                vans++;
                retVal= $.fn.updatecurranswer(i,j);
                if(retVal=="false")return retVal;
              }
          }  

          if(vans==0){
             retVal = "false";
             alert("Please add atleast one answer choice for this question");
             $("#quesArea"+i).focus();
             return retVal;
          }
          retval=$.fn.checkRadioButton(i);



          return retVal;

       }

        


      $.fn.loadanswer = function(answer,i,j){


             var qhtml=""

              qhtml+="<input id='answercrad"+i+j+"' name='answercrad"+i+"' type='radio' name='choice' value='"+j+"'><h2>"+(j+1)+"</h2><br/>"
                 qhtml+="<button type='button' onclick='resetthisanswer("+i+","+j+")'>Reset this answer</button>"
                 qhtml+="<button type='button' onclick='deletecurranswer("+i+","+j+")'>Delete this answer</button>"
                 qhtml+="<button type='button' onclick='updatecurranswer("+i+","+j+")'>Save this answer</button><br/>"
                 qhtml+="<textarea id='answerctext"+i+j+"' rows='2' cols='100'>"+answer
                 qhtml+="</textarea>"
           
             $("#answerc"+i+j).html('');
             $("#answerc"+i+j).html(qhtml);

             var corr = currSeq.questions[i].correct_answer;

             $("#answercrad"+i+corr).prop("checked", true);

      }

      $.fn.loadNewAnswer = function(answer,i,j){


             var qhtml=""

              qhtml+="<input id='answercrad"+i+j+"' name='answercrad"+i+"' type='radio' name='choice' value='"+j+"'><h2>"+(j+1)+"</h2><br/>"
                 qhtml+="<button type='button' onclick='deletecurranswer("+i+","+j+")'>Delete this answer</button>"
                 qhtml+="<button type='button' onclick='updatecurranswer("+i+","+j+")'>Save this answer</button><br/>"
                 qhtml+="<textarea id='answerctext"+i+j+"' rows='2' cols='100'>"+answer
                 qhtml+="</textarea>"
           
             $("#answerc"+i+j).html('');
             $("#answerc"+i+j).html(qhtml);

      }

      $.fn.addNewAnswer=function(i){
             var len = currSeq.questions[i].answers.length;
             currSeq.questions[i].answers.push("");


             var qhtml = ""

             qhtml+="<div id='answerc"+i+len+"'>"  
             qhtml+="</div>"

             $("#answersection"+i).append(qhtml);

             $.fn.loadNewAnswer(currSeq.questions[i].answers[len],i,len);
              

        } 


      $.fn.loadquestion = function(ques,i){

        var qhtml=""

        qhtml+="<h2> Question</h2>"
        qhtml+="<div style='width:100%;padding:2%'>"
              qhtml+="<span>"
              qhtml+="<button type='button' onclick='cancelCurrentQues("+i+")'>Reset this question</button>"
              qhtml+="<button type='button' onclick='deleteCurrentQues("+i+")'>Delete this question</button>"
              qhtml+="<button type='button' onclick='updateCurrentQues("+i+")'>Save this question</button>"
              qhtml+="</span>"
              qhtml+=" <br/> <br/>"
              qhtml+="<div><h2> Question Text</h2><br/>"
              qhtml+="<button type='button' onclick='cancelCurrentQuesText("+i+")'>Reset Question Text</button>"
              qhtml+="<button type='button' onclick='updateCurrentQuesText("+i+")'>Save this question text</button>"
              qhtml+="<textarea id='quesArea"+i+"' rows='2' cols='100'>"+ques[i].question+"</textarea>"
              qhtml+="</div>"
              qhtml+="<form id='answers"+i+"'' action='#'>"
              qhtml+="<h2> Answers Section</h2>"
              qhtml+="<button type='button' onclick='resetAnswerSection("+i+")'>Reset Answer Section</button>"
              qhtml+="<button type='button' onclick='updateAnswerSection("+i+")'>Save the answer section</button>"
              qhtml+="<div id='answersection"+i+"'>"



              var answers = ques[i].answers;


              for(j=0;j<answers.length;j++){
                 qhtml+="<div id='answerc"+i+j+"'>"
                 qhtml+="</div>"
              }
              
               qhtml+="</div>"
              qhtml+="<button type='button' onclick='addNewAnswer("+i+")'>Add answer choice</button>"
              qhtml+="</form>"

              qhtml+=" </div>"

              $("#ques"+i).html('');
              $("#ques"+i).html(qhtml);

               for(j=0;j<answers.length;j++){

                  $.fn.loadanswer(answers[j],i,j);
               }

      }
      
      
      $.fn.loadNewQuestion = function(ques,i){

        var qhtml=""
        qhtml+="<h2> Question</h2>"
        qhtml+="<div style='width:100%;padding:2%'>"
              qhtml+="<span>"
              qhtml+="<button type='button' onclick='deleteCurrentQues("+i+")'>Delete this question</button>"
              qhtml+="<button type='button' onclick='updateCurrentQues("+i+")'>Save this question</button>"
              qhtml+="</span>"
              qhtml+=" <br/> <br/>"
              qhtml+="<div><h2> Question Text</h2><br/>"
              qhtml+="<button type='button' onclick='updateCurrentQuesText("+i+")'>Save this question text</button>"
              qhtml+="<textarea id='quesArea"+i+"' rows='2' cols='100'>"+ques[i].question+"</textarea>"
              qhtml+="</div>"
              qhtml+="<form id='answers"+i+"'' action='#'>"
              qhtml+="<h2> Answers Section</h2>"
              qhtml+="<button type='button' onclick='updateAnswerSection("+i+")'>Save the answer section</button>"
              qhtml+="<div id='answersection"+i+"'>"



              var answers = ques[i].answers;


              for(j=0;j<answers.length;j++){
                 qhtml+="<div id='answerc"+i+j+"'>"
                 qhtml+="</div>"
              }
              
              qhtml+="</div>"
              qhtml+="<button type='button' onclick='addNewAnswer("+i+")'>Add answer choice</button>"
              qhtml+="</form>"

              qhtml+=" </div>"

              $("#ques"+i).html('');
              $("#ques"+i).html(qhtml);

               for(j=0;j<answers.length;j++){

                  $.fn.loadNewAnswer(answers[j],i,j);
               }

      }
      

      $.fn.loadAllques = function(){ 
       
           var origSeq= JSON.parse(localStorage.getItem('seqStr'));
           var ques = origSeq.questions;
           currSeq.questions = origSeq.questions;

           var qhtml="";

           for( i=0;i<ques.length;i++){
              qhtml+="<div id='ques"+i+"'>"
              
              qhtml+="</div>"
           }
        
            $("#allques").html('');
            $("#allques").html(qhtml);

            for( i=0;i<ques.length;i++){
               $.fn.loadquestion(ques,i);
            } 

  }


    $.fn.loadAllques();

      
      $.fn.addNewQuestion = function(){ 

        var len = currSeq.questions.length;
        var newQuestion = {
                          "question": "",
                          "answers": [""],
                          "correct_answer": "0",
                          "hidden":"false"
                        }

        currSeq.questions.push(newQuestion);

        var qhtml =""
        qhtml+="<div id='ques"+len+"'> "
        qhtml+="</div>"


        $("#allques").append(qhtml);

        $.fn.loadNewQuestion(currSeq.questions,len);
             
           
       } 


       $.fn.allQuestionsSave=function(){
          //alert("in update current");
          var retVal = "true";
           

           
           for(y=0;y<currSeq.questions.length; y++){
                
               if(!($("#ques"+y).is(":hidden"))){

                  retVal=$.fn.updateCurrentQues(y);
                  if(retVal =="false") return retVal;
               } 
               
           }

           return retVal;
        
          //alert(currSeq.questions[n].question)
          
      }

     $.fn.saveSequenceToEditedTour=function() {

        var retVal = $.fn.saveDesc();

         if(retVal == "false"){
            return;
         }
        
         retVal=$.fn.allQuestionsSave();

      
        if(retVal=="true"){

         var eQues = [];
         for(x=0;x<currSeq.questions.length;x++){

             if(!($("#ques"+x).is(":hidden"))){
                var eQue={};
                eQue.question=currSeq.questions[x].question;
                eQue.answers=[];
                eQue.correct_answer=currSeq.questions[x].correct_answer;

                for(y=0;y<currSeq.questions[x].answers.length;y++){
                     
                   if(!($("#answerc"+x+y).is(":hidden"))){
                       eQue.answers.push(currSeq.questions[x].answers[y]);
                   } 

                }  
                
                eQues.push(eQue);

             } 
         }



        currSeq.questions=eQues;

        var editT = JSON.parse(localStorage.getItem("editedTour"));
        var seqNumber = JSON.parse(localStorage.getItem("seqNumber"));

        editT.items[seqNumber] = currSeq;


        localStorage.setItem("editedTour", JSON.stringify(editT));
        
         window.location='edittour.html';
        }

     }
    

    $.fn.cancelChangesToSequence = function(){ 
       
       var con = confirm("Are you sure you want to cancel all changes to the sequence ?");

       if(con){
         window.location='edittour.html';
       }

    }


    

     $.fn.resetChangesToSequence = function(){ 

         var con = confirm("Are you sure you want to reset all changes to the sequence ?");

         if(con){
         window.location.reload();

         }
     }

     

      $.fn.showSlides = function(n){ 
            var i;
            var slides = document.getElementsByClassName("mySlides slidesfade");
            var dots = document.getElementsByClassName("dot");
            if (n > slides.length) {slideIndex = 1}    
            if (n < 1) {slideIndex = slides.length}
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";  
            }
           // for (i = 0; i < dots.length; i++) {
             //   dots[i].className = dots[i].className.replace(" active", "");
            //}
            slides[slideIndex-1].style.display = "block";  
            //dots[slideIndex-1].className += " active";
      }


      $.fn.showSlides(slideIndex);
      $.fn.plusSlides = function(n){ 
        $.fn.showSlides(slideIndex += n);
      }
      $.fn.currentSlide = function(n){ 
        $.fn.showSlides(slideIndex += n);
      }

      $( "#prev" ).click(function() {
           $.fn.plusSlides(-1);
      });

       $( "#next" ).click(function() {
           $.fn.plusSlides(1);
      });

       $('.mapImg').click(function(e) {
       var offset_t = $(this).offset().top - $(window).scrollTop();
       var offset_l = $(this).offset().left - $(window).scrollLeft();

        var left = Math.round( (e.clientX - offset_l) );
        var top = Math.round( (e.clientY - offset_t) );


        var target = event.target;
         

        var leftPercent = left / $(this).parent().width() * 100;
        var topPercent = top / $(this).parent().height() * 100;

        leftPercent=leftPercent.toFixed(2);
        topPercent=topPercent.toFixed(2);

       // var path = $(".mapImg").attr("src");
        var path = $(this).attr("src")
       // alert($(this).attr("src"));
     ///   alert(path);


      //  alert("Left: " + leftPercent + " Top: " + topPercent);

        $.fn.reassignPin(path,topPercent+"-"+leftPercent);
      });
     

});


///showSlides(slideIndex);

function plusSlides(n) {
  $.fn.showSlides(slideIndex += n);
}

function currentSlide(n) {
  $.fn.showSlides(slideIndex = n);
}


function updateCurrentQues(n){
  $.fn.updateCurrentQues(n);
}

function cancelCurrentQues(n){
  $.fn.cancelCurrentQues(n);
}

function deleteCurrentQues(n){
  $.fn.deleteCurrentQues(n);
}

function cancelCurrentQuesText(n){
  $.fn.cancelCurrentQuesText(n);
}
function updateCurrentQuesText(n){
  $.fn.updateCurrentQuesText(n);
}

function deletecurranswer(i,j){
  $.fn.deletecurranswer(i,j);
}

function updatecurranswer(i,j){
  $.fn.updatecurranswer(i,j);
}

function resetthisanswer(i,j){
  $.fn.resetthisanswer(i,j);
}


function addNewAnswer(i){
  $.fn.addNewAnswer(i);
}


function resetAnswerSection(i){
  $.fn.resetAnswerSection(i);
}

function updateAnswerSection(i){
  $.fn.updateAnswerSection(i);
}


function allQuestionsSave(i){
  $.fn.allQuestionsSave(i);
}


function resetSequence(){
  $.fn.resetSequence();
}


function saveSequenceToEditedTour(){

  $.fn.saveSequenceToEditedTour();
}

function cancelChangesToSequence(){

  $.fn.cancelChangesToSequence();
}


function resetChangesToSequence(){

  $.fn.resetChangesToSequence();
}


 function logout(){

         var con = confirm("Are you sure you want to logout ?");
         if(con){
          localStorage.clear();
          window.location.href='login.html';

         }

      }





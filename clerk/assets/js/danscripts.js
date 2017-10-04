
 $(document).ready(function(){
   $('#nextbtn').click(function(){

     $('#nextbtn').attr("disabled", "disabled");
     setTimeout(function() {
         $('#nextbtn').removeAttr("disabled");
     }, 3000);
   });
 });

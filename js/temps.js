$(document).ready(function() {

	function ajaxOK(data){

}

    
    
    setInterval(function(){
 $.ajax({
   
    type: 'POST',
    url: 'temps.php',
    success: ajaxOK
  });




}, 3000);
    
    
});
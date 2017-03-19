//set default degree (360*5)
var degree = 1800;
//number of clicks = 0
var clicks = 0;

$(document).ready(function(){

function ajaxOK(data){
alert('le gage vous a été attribué, pour le consulter, allez sur la page moncompte');
window.location.reload(true);
console.log("refresh");
}
	
	/*WHEEL SPIN FUNCTION*/
	$('#spin').click(function(){
		
		//add 1 every click
		clicks ++;
		
		/*multiply the degree by number of clicks
	  generate random number between 1 - 360, 
    then add to the new degree*/
		var newDegree = degree*clicks;
		var extraDegree = Math.floor(Math.random() * (360 - 1 + 1)) + 1;
		totalDegree = newDegree+extraDegree;
		
		/*let's make the spin btn to tilt every
		time the edge of the section hits 
		the indicator*/
		$('#wheel .sec').each(function(){
			var t = $(this);
			var noY = 0;
			
			var c = 0;
			var n = 700;	
			var interval = setInterval(function () {
				c++;				
				if (c === n) { 
					clearInterval(interval);				
				}	
					
				var aoY = t.offset().top;
				$("#txt").html(aoY);
				//console.log(aoY);
				
				
				/*23.7 is the minumum offset number that 
				each section can get, in a 30 angle degree.
				So, if the offset reaches 23.7, then we know
				that it has a 30 degree angle and therefore, 
				exactly aligned with the spin btn*/
				if(aoY < 23.89){
					console.log('<<<<<<<<');
					$('#spin').addClass('spin');
					setTimeout(function () { 
						$('#spin').removeClass('spin');
					}, 100);	
				}
			}, 10);
			
			$('#inner-wheel').css({
				'transform' : 'rotate(' + totalDegree + 'deg)'			
			});
		 
			noY = t.offset().top;
			
		});
		var param = "";
		if(extraDegree<30 || extraDegree>=330){
		param = "param1=rouge"; 
		}
		if(extraDegree>=30 && extraDegree<90){
		param ="param1=orange";
	}
		if(extraDegree>=90 && extraDegree<150){
		param = "param1=jaune";
	
		}
		if(extraDegree>=150 && extraDegree<210){
		param = "param1=bleuf";
	}
		if(extraDegree>=210 && extraDegree<270){
		param = "param1=bleu";
		}
		if(extraDegree>=270 && extraDegree<330){
		param = "param1=bleuc";
		}
		
	$.ajax({
   
    type: 'POST',
    url: 'attributgage.php',
    data: param,
    success: ajaxOK
  });
	console.log(param);
	});
	
	
	
});//DOCUMENT READY

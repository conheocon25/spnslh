$(document).ready(function(){
				$('#ExchangeAjax').click( function(){
					alert('sfasdfasdf');
					$.ajax({
						type: "POST", 
						async: false,
						url: "http://saigonlandhouse.com/?cmd=ExchangeAjax&Value=+ $('#Value').val() + "&Exchange=" + $('#Exchange').val(),						
						dataType: 'json',			
						success: function(data){
							alert(data);							
						}
					});
				});
			});
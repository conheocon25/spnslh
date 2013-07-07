/*<![CDATA[*/
			$(document).ready(function() {
				$("#refreshCaptcha").click(function() {						
					
					$.ajax({
					  url: 'http://saigonlandhouse.com/RefreshCaptcha',
					  success: function(data) {
						$('#PicCaptcha').attr("src","/data/captcha.jpg");						
					  }
					});
				});				
			});
/*]]>*/
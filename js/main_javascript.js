function search_domain()
{
	
	var domain=document.getElementById('search_domain_input').value;
	if(domain == '')
	{
		alert('Domain name should not be empty');
	}
	else if(domain.indexOf('.') != -1)
	{
		alert('Your domain name should not contain . characters');
	}
	else if(domain.indexOf('/') != -1)
	{
		alert('Your domain name should not contain / characters');
	}
	else if(domain.indexOf(' ') != -1)
	{
		alert('Your domain name should not contain whitespaces');
	}
	else
	{
		$('#ajax_loader').show();
		
		$.ajax({
			url: 'search_domain.php',
			type: 'post',
			data: {'domain_name':domain} ,
			
			success: function (response) {
				$('#ajax_loader').hide();
				if(response!='false')
				{
					document.getElementById('search_domain_input').value='';
					var input = $('#domain_name_input');
					input.val(response+'.360marketing.in');
					input.trigger('input');
					document.getElementById('search_result').innerHTML="<h2>Congratulations, "+response+".360marketing.in is available </h2><button type='button' class='btn btn-success' data-toggle='modal' data-target='#signup-overlay'>Order Now</button>";
				}
				else
				{
					document.getElementById('search_result').innerHTML='<h2>Sorry, '+domain+'.360marketing.in is not available</h2>';
				}
			},
			error: function () {
				alert("error");
			}
		});
	}
}
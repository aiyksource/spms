$(function(){	
	$('#org_category').on('keyup', function(){	
		var searchTerm = $('#org_category').val();

		if(window.XMLHttpRequest)
		{
			xmlhttp = new window.XMLHttpRequest(); 
		}
		else
		{
			xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
		}

		parameters = 'searchTerm=' + searchTerm;

		xmlhttp.open('POST', 'getCategories.php', true);
		xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xmlhttp.send(parameters);

		xmlhttp.onreadystatechange = function() {
			if(xmlhttp.readyState == '4' && xmlhttp.status == '200')
			{
				response = xmlhttp.responseText;
				$('#ul_categoriesDisplay').html(response);
			}
		}
	});
});
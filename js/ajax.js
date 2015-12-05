$(function(){	

	//ajax for categories suggestion in the new organization page
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

	//ajax for the left hand side search text field keyup event
	$('#iiwrap-lhs-search').on('keyup', function(){	
		var searchTerm = $('#iiwrap-lhs-search').val();
		
		if(window.XMLHttpRequest)
		{
			xmlhttp = new window.XMLHttpRequest(); 
		}
		else
		{
			xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
		}

		parameters = 'searchTerm=' + searchTerm;

		xmlhttp.open('POST', 'lhs_search.php', true);
		xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xmlhttp.send(parameters);

		xmlhttp.onreadystatechange = function() {
			if(xmlhttp.readyState == '4' && xmlhttp.status == '200')
			{
				response = xmlhttp.responseText;
				$('#divResponse').html(response);
			}
		}
	});

	//ajax for the home dashboard link
	$('#addMember_DbLink').on('click', function(){	
		if(window.XMLHttpRequest)
		{
			xmlhttp = new window.XMLHttpRequest(); 
		}
		else
		{
			xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
		}

		parameters = 'searchTerm=' + 'searchTerm';

		xmlhttp.open('POST', 'addMember.php', true);
		xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xmlhttp.send(parameters);

		xmlhttp.onreadystatechange = function() {
			if(xmlhttp.readyState == '4' && xmlhttp.status == '200')
			{
				response = xmlhttp.responseText;
				$('#iiwrap-rhs').html(response);
				$('.sub-db').children().removeClass('active_DbLink');
				$('#addMember_DbLink').addClass('active_DbLink');
			}
		}
	});

	//ajax for the create organization dashboard link
	$('#addOrganization_DbLink').on('click', function(){	
		if(window.XMLHttpRequest)
		{
			xmlhttp = new window.XMLHttpRequest(); 
		}
		else
		{
			xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
		}

		parameters = 'searchTerm=' + 'searchTerm';

		xmlhttp.open('POST', 'addOrganization.php', true);
		xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xmlhttp.send(parameters);

		xmlhttp.onreadystatechange = function() {
			if(xmlhttp.readyState == '4' && xmlhttp.status == '200')
			{
				response = xmlhttp.responseText;
				$('#iiwrap-rhs').html(response);
				$('.sub-db').children().removeClass('active_DbLink');
				$('#addOrganization_DbLink').addClass('active_DbLink');
			}
		}
	});

	//ajax for the create new category dashboard link
	$('#newCat_DbLink').on('click', function(){	
		if(window.XMLHttpRequest)
		{
			xmlhttp = new window.XMLHttpRequest(); 
		}
		else
		{
			xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
		}

		parameters = 'searchTerm=' + 'searchTerm';

		xmlhttp.open('POST', 'add_org_category.php', true);
		xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xmlhttp.send(parameters);

		xmlhttp.onreadystatechange = function() {
			if(xmlhttp.readyState == '4' && xmlhttp.status == '200')
			{
				response = xmlhttp.responseText;
				$('#iiwrap-rhs').html(response);
				$('.sub-db').children().removeClass('active_DbLink');
				$('#newCat_DbLink').addClass('active_DbLink');
			}
		}
	});
});
function showHideEntry(id) {
	var data = document.getElementById(id);
	if (data.style.display == 'block') {
		data.style.display = 'none';
	} else {
		data.style.display = 'block';
	}
}

function getElementsByClassName(node, classname) {
	var a = [];
	var re = new RegExp('\\b' + classname + '\\b');
	var els = node.getElementsByTagName("*");
	for(var i=0,j=els.length; i<j; i++)
		if(re.test(els[i].className))a.push(els[i]);
	return a;
}

function hideElementsByClassName(node, classname) {
	var re = new RegExp('\\b' + classname + '\\b');
	var els = node.getElementsByTagName("*");

	for(var i=0,j=els.length; i<j; i++)
		if(re.test(els[i].className)) els[i].style.display = 'none';
}

function showEntry(id) {
	var main_div = document.getElementById('main');
	hideElementsByClassName(main_div,'popup');
	document.getElementById(id).style.display = 'block';

}


function updateIfNeeded(ts) {
	new Ajax.Request('/update.php', {
		method: 'get',
		parameters: 'timestamp='+ts,
		onSuccess: function(transport) {
			var statusbar = $('status_bar');
			if (transport.responseText.match(/changed/)) {
				date = new Date();
				ts = date.getTime();
				var b = document.getElementById('status_bar');
				b.innerHTML = transport.responseText;
				SmartyAjax.update('Services', '', 'get', 'f=display_table_services_count');
				SmartyAjax.update('hosts_down_problem', '', 'get', 'f=display_table_hosts&view=hosts_problems');
				SmartyAjax.update('services_problem', '', 'get', 'f=display_table_services_host&host=all');
			}
		}
	});

	setTimeout("updateIfNeeded(ts)",30000);
}

//lets go
date = new Date();
ts = date.getTime();
setTimeout("updateIfNeeded(ts)",30000);



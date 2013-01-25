
var working = false;
var xml = make_xml();
var files = new Array();

function $ (el) { return document.getElementById(el); }
function $$ (t) { return document.getElementsByTagName(t); }
function change_status (status) {
	$('bidders').style.visibility = status == '3' ? 'visible' : 'hidden';	
}
function add_comment (auction_id) {
	var comment = window.encodeURI($('body').value);
	if (comment.length > 4) {
		xml.open('post', '../add-comments/');
		xml.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		xml.onreadystatechange = function () {
			if (xml.readyState == 4) {
				$('comment-list').innerHTML = xml.responseText;
				$('body').value = '';
				window.location.hash = 'comments';
			}
		}
		xml.send('auction_id=' + auction_id + '&comments=' + comment);
	} else {
		alert('Please enter a comment at least 5 characters in length.');	
	}
	return false;
}
function create_uploader (current_field) {
	file_name = current_field.value.split('\\');
	file_name = file_name[file_name.length - 1];
	files[file_name] = [{'name': file_name}];
	var new_field = document.createElement('input');
	new_field.type = 'file';
	new_field.name = 'file[]';
	new_field.onchange = function (e) {
		create_uploader(this);	
	}
	$('fields').appendChild(new_field);
	current_field.style.display = 'none';
	var new_file = document.createElement('li');
	$('files').appendChild(new_file);
	var new_file_name = document.createElement('span');
	new_file_name.innerHTML = file_name;
	new_file.appendChild(new_file_name);
	var remove_file = document.createElement('a');
	remove_file.innerHTML = 'Remove';
	remove_file.href = '#';
	remove_file.onclick = function () {
		files.splice(file_name);
		$('files').removeChild(new_file);
		$('fields').removeChild(current_field);
	}
	new_file.appendChild(remove_file);
	var line = document.createElement('br');
	line.clear = 'all';
	new_file.appendChild(line);
}
function make_xml () {
	if (typeof XMLHttpRequest == 'undefined') {
		objects = Array(
			'Microsoft.XMLHTTP',
			'MSXML2.XMLHTTP',
			'MSXML2.XMLHTTP.3.0',
			'MSXML2.XMLHTTP.4.0',
			'MSXML2.XMLHTTP.5.0'
		);
		for (i in objects) {
			try {
				return new ActiveXObject(objects[i]);
			} catch (e) {}
		}
	} else {
		return new XMLHttpRequest();
	}
}

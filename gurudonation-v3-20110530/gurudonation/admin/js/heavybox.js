
// Developed & Maintained by WebStar
////////////////////////////////////////////////////


var heavybox = false, overlay = false, frame = false, title_bar = false, width = '500', height = '500', dragging = false;

function hb_$ (el) { return document.getElementById(el); }

function hb_$$ (t) { return document.getElementsByTagName(t); }

function hb_user_agent (s) { return (Math.max(navigator.userAgent.toLowerCase().indexOf(s), 0)); }

function hb_deploy (url, method, header) {

	overlay = document.createElement('div');

	overlay.className = 'heavybox-overlay';

	hb_$$('body')[0].appendChild(overlay);

	heavybox = document.createElement('div');

	heavybox.id = 'heavybox';

	heavybox.style.zIndex = '3';

	if (method == 'fullscreen') {

		heavybox.style.width = (document.documentElement.clientWidth - 90) + 'px';

		heavybox.style.height = (document.documentElement.clientHeight - 80) + 'px';

		heavybox.style.top = '40px';

		heavybox.style.left = '40px';

		fullscreen = true;

	} else if (method.match(',')) {

		method = method.split(',');

		heavybox.style.width = parseInt(method[0]) + 'px';

		heavybox.style.height = parseInt(method[1]) + 'px';

		heavybox.style.top = (document.documentElement.clientHeight / 2) - (method[1] / 2) + 'px';

		heavybox.style.left = (document.documentElement.clientWidth / 2) - (method[0] / 2) + 'px';

		fullscreen = false;

	} else {

		heavybox.style.width = '500px';

		heavybox.style.height = '500px';

		heavybox.style.top = (document.documentElement.clientHeight / 2) - (height / 2) + 'px';

		heavybox.style.left = (document.documentElement.clientWidth / 2) - (width / 2) + 'px';

		fullscreen = false;

	}

	hb_$$('body')[0].appendChild(heavybox);

	title_bar = document.createElement('div');

	title_bar.className = 'title';

	if (!fullscreen) {

		title_bar.onmousedown = function (e) {

			hb_drag_object(e);

		}

		title_bar.style.cursor = 'move';

	}

	heavybox.appendChild(title_bar);

	title = document.createElement('span');

	title.className = 'title-text';

	title.innerHTML = header ? header : 'Image box';

	title_bar.appendChild(title);

	close_btn = document.createElement('a');

	close_btn.className = 'close';

	close_btn.href = '#';

	close_btn.title = 'Close Window';

	close_btn.onclick = function () {

		hb_withdraw();

		return false;

	}

	title.appendChild(close_btn);

	frame = document.createElement('iframe');

	frame.frameborder = '0';

	frame.scrolling = 'auto';

	frame.src = url;

	frame.className = 'frame';

	frame.style.width = (parseInt(heavybox.style.width) - 12) + 'px';

	frame.style.height = (parseInt(heavybox.style.height) - 52) + 'px';

	heavybox.appendChild(frame);

}

function hb_withdraw () {

	if (heavybox) { heavybox.parentNode.removeChild(heavybox); }

	if (overlay) { overlay.parentNode.removeChild(overlay);	}

}

function hb_coordinates (e, flip) {

	if(flip) {

		if (hb_user_agent('msie')) { return event.clientY + document.body.scrollTop; } else { return e.pageY; }

	} else {

		if (hb_user_agent('msie')) { return event.clientX + document.body.scrollTop; } else { return e.pageX; }

	}

}

function hb_drag_object (e, resize) {

	function hb_drag (e) { 

		if (dragging) {

			if (!resize) {

				heavybox.style.top = (object_x = hb_coordinates(e, 1) + start_y - mouse_y + 'px'); 

				heavybox.style.left = (object_y = hb_coordinates(e) + start_x - mouse_x + 'px'); 

			} else {

				if ((hb_coordinates(e) + start_x - mouse_x) >= (parseInt(heavybox.style.left) + 100)) {

					new_width = mouse_x - start_x;

					heavybox.style.width = new_width + 'px';

					frame.style.width = new_width + 'px';

				}

				if ((hb_coordinates(e) + start_x - mouse_x) >= (parseInt(heavybox.style.top) + 100)) {

					new_height = mouse_y - start_y;

					heavybox.style.height = new_height + 'px';

					frame.style.height = new_height - 40 + 'px';

				}

			}

		} 

	}

	var start_x = parseInt(heavybox.style.left), start_y = parseInt(heavybox.style.top);

	var mouse_x  = hb_coordinates(e), mouse_y = hb_coordinates(e, 1);

	var object_x, object_y;

	var dragging = true;

	document.onmousemove = hb_drag;

	document.onmouseup = function () {

		dragging = false;

	}

}

function hb_load_handler (e) {

	var links = hb_$$('a');

	for (var i = 0; i < links.length; i++) {

		var subject = links[i];

		if (links[i].rel.match('heavybox')) {

			links[i].onclick = function () {

				var method = '';

				if (this.rel.match(/\[/g) && this.rel.match(/\]/g)) {

					method = this.rel;

					method = method.replace('heavybox', '');

					method = method.replace('[', '');

					method = method.replace(']', '');

				}

				title = false;

				if (this.title) { title = this.title; }

				hb_deploy(this.href, method, title);

				return false;

			}

		}

	}

}

window.onload = hb_load_handler;
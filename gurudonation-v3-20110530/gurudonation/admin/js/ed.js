/*****************************************/
// Author: Webstar
// Last Modified Date: 14/9/2010
/******************************************/

var textarea;
var content;

function edToolbar(obj) {
    document.write("<div class=\"toolbar\">");
	document.write("<img class=\"button\" src=\"imgs/bold.gif\" name=\"btnBold\" onClick=\"doAddTags('[b]','[/b]','" + obj + "')\">");
   	document.write("<img class=\"button\" src=\"imgs/italic.gif\" name=\"btnItalic\" onClick=\"doAddTags('[i]','[/i]','" + obj + "')\">");
	document.write("<img class=\"button\" src=\"imgs/underline.gif\" name=\"btnUnderline\" onClick=\"doAddTags('[u]','[/u]','" + obj + "')\">");
	document.write("<img class=\"button\" src=\"imgs/strikethrough.gif\" name=\"btnStrikethrough\" onClick=\"doAddTags('[s]','[/s]','" + obj + "')\">");
	document.write("<img class=\"button\" src=\"imgs/colored.gif\" name=\"btnColored\" onClick=\"doAddTags('[color=red]','[/color]','" + obj + "')\">");
	document.write("<img class=\"button\" src=\"imgs/link.gif\" name=\"btnLink\" onClick=\"doURL('" + obj + "')\">");
	document.write("<img class=\"button\" src=\"imgs/picture.gif\" name=\"btnPicture\" onClick=\"doImage('" + obj + "')\">");
	document.write("<img class=\"button\" src=\"imgs/ordered.gif\" name=\"btnList\" onClick=\"doList('[LIST=1]','[/LIST]','" + obj + "')\">");
	document.write("<img class=\"button\" src=\"imgs/unordered.gif\" name=\"btnList\" onClick=\"doList('[LIST]','[/LIST]','" + obj + "')\">");
	document.write("<img class=\"button\" src=\"imgs/quote.gif\" name=\"btnQuote\" onClick=\"doAddTags('[quote]','[/quote]','" + obj + "')\">"); 
	document.write("<img class=\"button\" src=\"imgs/youtube.gif\" name=\"btnYoutube\" onClick=\"doAddTags('[youtube]YouTubeIDHere','[/youtube]','" + obj + "')\">");
    document.write("</div>");

}

function doImage(obj)
{
textarea = document.getElementById(obj);
var url = prompt('Enter the Image URL:','http://');
var scrollTop = textarea.scrollTop;
var scrollLeft = textarea.scrollLeft;

	if (document.selection) 
			{
				textarea.focus();
				var sel = document.selection.createRange();
				sel.text = '[img]' + url + '[/img]';
			}
   else 
    {
		var len = textarea.value.length;
	    var start = textarea.selectionStart;
		var end = textarea.selectionEnd;
		
        var sel = textarea.value.substring(start, end);
	    //alert(sel);
		var rep = '[img]' + url + '[/img]';
        textarea.value =  textarea.value.substring(0,start) + rep + textarea.value.substring(end,len);
		
			
		textarea.scrollTop = scrollTop;
		textarea.scrollLeft = scrollLeft;
	}

}

function doURL(obj)
{
textarea = document.getElementById(obj);
var url = prompt('Enter the URL:','http://');
var scrollTop = textarea.scrollTop;
var scrollLeft = textarea.scrollLeft;

	if (document.selection) 
			{
				textarea.focus();
				var sel = document.selection.createRange();
				
			if(sel.text==""){
					sel.text = '[url]'  + url + '[/url]';
					} else {
					sel.text = '[url=' + url + ']' + sel.text + '[/url]';
					}			

			
			}
   else 
    {
		var len = textarea.value.length;
	    var start = textarea.selectionStart;
		var end = textarea.selectionEnd;
		
        var sel = textarea.value.substring(start, end);
		
		if(sel==""){
				var rep = '[url]' + url + '[/url]';
				} else
				{
				var rep = '[url=' + url + ']' + sel + '[/url]';
				}
	    //alert(sel);
		
        textarea.value =  textarea.value.substring(0,start) + rep + textarea.value.substring(end,len);
		
			
		textarea.scrollTop = scrollTop;
		textarea.scrollLeft = scrollLeft;
	}
}

function doAddTags(tag1,tag2,obj)
{
textarea = document.getElementById(obj);
		if (document.selection) 
			{
				textarea.focus();
				var sel = document.selection.createRange();
				sel.text = tag1 + sel.text + tag2;
			}
   else 
    {  
		var len = textarea.value.length;
	    var start = textarea.selectionStart;
		var end = textarea.selectionEnd;
		
		
		var scrollTop = textarea.scrollTop;
		var scrollLeft = textarea.scrollLeft;

		
        var sel = textarea.value.substring(start, end);
	   	var rep = tag1 + sel + tag2;
        textarea.value =  textarea.value.substring(0,start) + rep + textarea.value.substring(end,len);
		
		textarea.scrollTop = scrollTop;
		textarea.scrollLeft = scrollLeft;
		
		
	}
}

function doList(tag1,tag2,obj){
textarea = document.getElementById(obj);
		if (document.selection) 
			{
				textarea.focus();
				var sel = document.selection.createRange();
				var list = sel.text.split('\n');
		
				for(i=0;i<list.length;i++) 
				{
				list[i] = '[*] One\n[*] Two' + list[i];
				}
				sel.text = tag1 + '\n' + list.join("\n") + '\n' + tag2;
			} else
			{

		var len = textarea.value.length;
	    var start = textarea.selectionStart;
		var end = textarea.selectionEnd;
		var i;
		
		var scrollTop = textarea.scrollTop;
		var scrollLeft = textarea.scrollLeft;

		
        var sel = textarea.value.substring(start, end);
		
		var list = sel.split('\n');
		
		for(i=0;i<list.length;i++) 
		{
		list[i] = '[*] One\n[*] Two' + list[i];
		}
       
		
		var rep = tag1 + '\n' + list.join("\n") + '\n' +tag2;
		textarea.value =  textarea.value.substring(0,start) + rep + textarea.value.substring(end,len);
		
		textarea.scrollTop = scrollTop;
		textarea.scrollLeft = scrollLeft;
 }
}
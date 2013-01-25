//====================================================================================================
//	Function Name	:	IsEmpty
//	Purpose			:	checks whether a field has value or is blank, it returns false if a field
//						is empty otherwise true.
//	Parameters		:	fld	-	field name to be checked
//					    msg -   error message to be displayed
//----------------------------------------------------------------------------------------------------
function validateNotEmpty( strValue ) 
{
	var strTemp = strValue;
	strTemp = trimAll(strTemp);
	if(strTemp.length > 0)
	{
		return true;
	}
	return false;
}

function trimAll( strValue ) 
{
	var objRegExp = /^(\s*)$/;
	//check for all spaces
	if(objRegExp.test(strValue)) 
	{
		strValue = strValue.replace(objRegExp, '');
		if( strValue.length == 0)
			return strValue;
	}
	//check for leading & trailing spaces
	objRegExp = /^(\s*)([\W\w]*)(\b\s*$)/;
	if(objRegExp.test(strValue)) 
	{
	//remove leading and trailing whitespace characters
		strValue = strValue.replace(objRegExp, '$2');
	}
	return strValue;
}

function IsEmpty(fld,msg)
{
	strTemp = trimAll(fld.value);
	if(strTemp.length > 0)
	{
		return true;
	}
	else
	{
		alert(msg);
		try {fld.focus();}catch(e){return true;}
		return false;
	}
}


//====================================================================================================
//	Function Name	:	IsEmail
//	Purpose			:	checks Email validity. Email must have character @ followed by one or more
//						dots. It returns flase if Email is invalid otherwise true.
//	Parameters		:	fld	-	field name to be checked
//					    msg -   error message to be displayed
//----------------------------------------------------------------------------------------------------
/*function IsEmail(fld,msg)
{
	var regex = /^[\w]+(\.[\w]+)*@([\w]+\.)+[a-zA-Z]{2,7}$/ ;
	if(!regex.test(fld.value))
	{
		alert(msg);
		fld.focus();
		return false;
	}
	return true;
}*/
function IsEmail(fld,msg)
{

	var emailStr = fld.value;

	if (emailStr.toString() == "") 
	{
		alert ("Please Enter Email address");
			fld.focus()
			return false;

	}
	else if (emailStr != "")
	{	
	var checkTLD=1;
	var knownDomsPat=/^(com|net|org|edu|int|mil|gov|arpa|biz|aero|name|coop|info|pro|museum)$/;
	var emailPat=/^(.+)@(.+)$/;
	var specialChars="\\(\\)><@,;:\\\\\\\"\\.\\[\\]";
	var validChars="\[^\\s" + specialChars + "\]";
	var quotedUser="(\"[^\"]*\")";
	var ipDomainPat=/^\[(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})\]$/;
	var atom=validChars + '+';
	var word="(" + atom + "|" + quotedUser + ")";
	var userPat=new RegExp("^" + word + "(\\." + word + ")*$");
	var domainPat=new RegExp("^" + atom + "(\\." + atom +")*$");
	var matchArray=emailStr.match(emailPat);
	
	if (matchArray==null) {
	alert("Email address seems incorrect (check @ and .'s)");
	fld.focus()
	return false;
	}
	var user=matchArray[1];
	var domain=matchArray[2];
	for (i=0; i<user.length; i++) {
	if (user.charCodeAt(i)>127) {
	alert("Email's username contains invalid characters.");
	fld.focus()
	return false;
	   }
	}
	for (i=0; i<domain.length; i++) {
	if (domain.charCodeAt(i)>127) {
	alert("Email's domain name contains invalid characters.");
	fld.focus()
	return false;
	   }
	}
	if (user.match(userPat)==null) {
	alert("Email's username doesn't seem to be valid.");
	fld.focus()
	return false;
	}
	
	var IPArray=domain.match(ipDomainPat);
	if (IPArray!=null) {
	for (var i=1;i<=4;i++) {
	if (IPArray[i]>255) {
	alert("Email's Destination IP address is invalid!");
	fld.focus()
	return false;
	   }
	}
	//return true;
	}
	var atomPat=new RegExp("^" + atom + "$");
	var domArr=domain.split(".");
	var len=domArr.length;
	for (i=0;i<len;i++) {
	if (domArr[i].search(atomPat)==-1) {
	alert("Email's domain name does not seem to be valid.");
	fld.focus()
	return false;
	   }
	}
	

	if (len<2) {
	alert("Email address is missing a hostname!");
	fld.focus()
	return false;
	}
	//return true;

	}

	return true;
      
}

//====================================================================================================
//	Function Name	:	IsValidString
//	Purpose			:	checks if field value contains only alphanumeric and '_' charactes. Also checks
//						that alphabetical chars. and '_' must have to be come first and followed by
//						numbers. It returns false if above conditions will not satisfy otherwise true.
//	Parameters		:	fld	-	field name to be checked
//					    msg -   error message to be displayed
//----------------------------------------------------------------------------------------------------
function IsValidString(fld,msg)
{
	var regex = /^[_]*[a-zA-Z_]+[a-zA-Z0-9_]+$/;
	if(!regex.test(fld.value))
	{
		alert(msg);
		fld.focus();
		return false;
	}
	return true;
}

//====================================================================================================
//	Function Name	:	IsLen
//	Purpose			:	checks if field value has number of characters between two specified limits.
//						It returns false if no. of chars. is < min. length or > max. length
//						otherwise true.
//	Parameters		:	fld	   - field name to be checked
//						minlen - minimum length of a field
//						maxlen - maximum length of a field
//					    msg    -   error message to be displayed
//----------------------------------------------------------------------------------------------------
function IsLen(fld, minlen, maxlen, msg)
{
	if(fld.value.length < minlen || fld.value.length > maxlen)
	{
		alert(msg);
		fld.focus();
		return false;
	}
	return true;
}



//====================================================================================================
//	Function Name	:	IsCurrency
//	Purpose			:	checks if Currency value is in proper format i.e. ',' must be after 1(at first place)
//						or 3 digits also dot '.' must be followed by ',' . '$' is optinal as a first char.
//						It returns false if above condition will not satisfy otherwise true.
//	Parameters		:	fld	-  field name to be checked
//					    msg -  error message to be displayed
//----------------------------------------------------------------------------------------------------
function IsCurrency(fld,msg)
{
    val = fld.value.replace(/\s/g, "");

	regex = /^\$?\d{1,3}(,?\d{3})*(\.\d{1,2})?$/;

    if(!regex.test(val)) {
         alert(msg);
		 fld.focus();
		 return false;
    }
	return true;
}


//====================================================================================================
//	Function Name	:	IsPhone
//	Purpose			:	checks if phone field has following characters : 0-9, '-', '+', '(' , ')' .
//						It returns false if there are other than above characters otherwise true .
//	Parameters		:	fld1	-  area code to be checked
//					:	fld2	-  city code to be checked
//					:	fld3	-  actual phone no to be checked
//					    msg -  error message to be displayed
//----------------------------------------------------------------------------------------------------
function IsPhone(fld1,fld2,fld3,msg)
{
	var regex = /^[\d\-+()]+$/;

	var phone = "(" + fld1.value + ")" + fld2.value + "-" + fld3.value;
	if(!regex.test(phone))
	{
		alert(msg);
		fld1.focus();
		return false;
	}
	return true;
}


//====================================================================================================
//	Function Name	:	IsContact
//	Purpose			:	checks if all contact information is blank or not.
//	Parameters		:	fld1 -  field name to be checked
//						fld2 -  field name to be checked
//						fld3 -  field name to be checked
//						fld4 -  field name to be checked
//						fld5 -  field name to be checked
//						fld6 -  field name to be checked
//					    msg  -  error message to be displayed
//----------------------------------------------------------------------------------------------------
function IsContact(fld1,fld2,fld3,fld4,fld5,fld6,msg)
{
	var err,args;
	err=0;
	args=IsContact.arguments;
	if(args.length==3)
	{
		if((fld1.value.length==0) &&  (fld2.value.length==0))
			err=1;
			msg=args[2];
	}
	if(args.length==4)
	{
		if((fld1.value.length==0) &&  (fld2.value.length==0) &&  (fld3.value.length==0))
			err=1;
			msg=args[3];
	}
	if(args.length==5)
	{
		if((fld1.value.length==0) &&  (fld2.value.length==0) &&  (fld3.value.length==0) && (fld4.value.length==0))
			err=1;
			msg=args[4];
	}
	if(args.length==6)
	{
		if((fld1.value.length==0) &&  (fld2.value.length==0) &&  (fld3.value.length==0) && (fld4.value.length==0) && (fld5.value.length==0))
			err=1;
			msg=args[5];
	}
	if(args.length==7)
	{
		if((fld1.value.length==0) &&  (fld2.value.length==0) &&  (fld3.value.length==0) && (fld4.value.length==0) && (fld5.value.length==0) && (fld6.value.length==0))
			err=1;
			msg=args[5];
	}

	if(err==1)
	{
			alert(msg);
			fld1.focus();
			return false;
	}
	return true;
}


//====================================================================================================
//	Function Name	:	IsZip
//	Purpose			:	checks if zip field value is of length 5 or 9 . (for U.S. zip code).
//						It returns false if it contains alphabetic chars. or length is not as
//						specified.
//	Parameters		:	fld	-  field name to be checked
//					    msg -  error message to be displayed
//----------------------------------------------------------------------------------------------------
function IsZip(fld,msg)
{
	var num = /^[\d]+$/;

	if(!num.test(fld.value) || (fld.value.length !=5 && fld.value.length !=9))
	{
		alert(msg);
		fld.focus();
		return false;
	}
	return true;
}

//====================================================================================================
//	Function Name	:	IsDate
//	Purpose			:	checks if date is valid according to month selected.
//						i.e. Feb must have 28 or 29 days and also April, June, Sept. and Nov. have
//						30 days. It returns false if above condition will not satisfy otherwise true.
//	Parameters		:	m	-  month field
//						d   -  day field
//						y   -  year field
//					    msg -  error message to be displayed
//----------------------------------------------------------------------------------------------------
function IsDate(m,d,y,msg)
{
  var val1= m.value;
  var val2= d.value;
  var val3= y.value;
	if(val2 > daysInFebruary(val3) && val1 == 02)
	{
		alert(msg);
		d.focus();
		return false;
	}
	if((val1 == 04 || val1 == 06 || val1 == 09 || val1 == 11 ) && (val2 > 30))
	{
		alert(msg);
		d.focus();
		return false;
	}

  dt= val1 + '/' + val2 + '/' + val3;
  return true;
}


//====================================================================================================
//	Function Name	:	IsValidCreditCardNumber
//	Purpose			:	checks if credit card no.is correct according to it's type.  It returns false
//						if no. is not correct otherwise true.
//	Parameters		:	ccTypeField     -  Credit card type i.e. Visa, MasterCard, American Express ...
//  					ccNumField      -  card number
//						msg             -  error message to be displayed if card no. is incorrect
//----------------------------------------------------------------------------------------------------

function IsValidCreditCardNumber(formField,ccType,msg)
{
	var result = true;
	var whitespace = " \t\n\r";
 	var ccNum = formField.value;

  	if (result && (formField.value.length>0))
 	{
 		if (!allDigits(ccNum))
 		{
			ccNum = stripCharsInBag (ccNum, whitespace);
		}
		if (result)
 		{
 			if (!LuhnCheck(ccNum) || !validateCCNum(ccType,ccNum))
 			{
 				alert(msg);
				formField.focus();
				result = false;
			}
		}
	}
	return result;
}

function allDigits(str)
{
	return inValidCharSet(str,"0123456789");
}

function inValidCharSet(str,charset)
{
	var result = true;
	for (var i=0;i<str.length;i++)
		if (charset.indexOf(str.substr(i,1))<0)
		{
			result = false;
			break;
		}
	return result;
}

function stripCharsInBag(s, bag)
{
    var i;
    var returnString = "";
    for (i = 0; i < s.length; i++)
    {
        var c = s.charAt(i);
        if (bag.indexOf(c) == -1) returnString += c;
    }
    return returnString;
}

function LuhnCheck(str)
{
  var result = true;
  var sum = 0;
  var mul = 1;
  var strLen = str.length;

  for (i = 0; i < strLen; i++)
  {
    var digit = str.substring(strLen-i-1,strLen-i);
    var tproduct = parseInt(digit ,10)*mul;
    if (tproduct >= 10)
      sum += (tproduct % 10) + 1;
    else
      sum += tproduct;
    if (mul == 1)
      mul++;
    else
      mul--;
  }
  if ((sum % 10) != 0)
    result = false;

  return result;

}

function validateCCNum(cardType,cardNum)
{
	var result = false;
	cardType = cardType.toUpperCase();
	var cardLen = cardNum.length;
	var firstdig = cardNum.substring(0,1);
	var seconddig = cardNum.substring(1,2);
	var first4digs = cardNum.substring(0,4);

	switch (cardType)
	{
		case "VISA":
			result = ((cardLen == 16) || (cardLen == 13)) && (firstdig == "4");
			break;
		case "AMEX":
			var validNums = "47";
			result = (cardLen == 15) && (firstdig == "3") && (validNums.indexOf(seconddig)>=0);
			break;
		case "MASTERCARD":
			var validNums = "12345";
			result = (cardLen == 16) && (firstdig == "5") && (validNums.indexOf(seconddig)>=0);
			break;
		case "DISCOVER":
			result = (cardLen == 16) && (first4digs == "6011");
			break;
		case "DINERS":
			var validNums = "068";
			result = (cardLen == 14) && (firstdig == "3") && (validNums.indexOf(seconddig)>=0);
			break;
		case "ENROUTE":
			//var validNums = "068";
			result = (cardLen == 15) && ((first4digs == "2149") || (first4digs == "2014"));
			break;
		case "JCB":
			//var validNums = "068";
			result = (cardLen == 16) && ((first4digs == "3088") || (first4digs == "3096") || (first4digs == "3112") || (first4digs == "3158") || (first4digs == "3337") || (first4digs == "3528"));
			break;
	}
	return result;
}


//====================================================================================================
//	Function Name	:	daysInFebruary
//	Purpose			:	To check days in Feb
//	Parameters		:	dyear  -  year for which days to check
//	Return			:	true or false
//----------------------------------------------------------------------------------------------------
function daysInFebruary (year)
{
	// February has 29 days in any year evenly divisible by four,
	// EXCEPT for centurial years which are not also divisible by 400.
	return (((year % 4 == 0) && ((!(year % 100 == 0)) || (year % 400 == 0))) ? 29 : 28 );
}
//====================================================================================================
//	Function Name	:	checkExpDate
//	Purpose			:	Also it checks whether card is expired or not. It returns false if card is
//						expired otherwise true.
//	Parameters		:	fldmonth -  month for expiry date
//						fldyear  -  year for expiry date
//						msg      -  error message to be displayed if card is expired
//----------------------------------------------------------------------------------------------------
function checkExpDate(fldmonth,fldyear,msg)
{
		var result = true;
 		var expired = false;
 		if (result)
 		{
 			var month = fldmonth.value;
 			var year = fldyear.value;

 			var now = new Date();
 			var nowMonth = now.getMonth() + 1;
 			var nowYear = now.getFullYear();
 			expired = (nowYear > year) || ((nowYear == year ) && (nowMonth > month));
		}
		if (expired)
		{
 			result = false;
			fldmonth.focus();
 			alert(msg);
		}

	return result;
}

//====================================================================================================
//	Function Name	:	checkFileType
//	Purpose			:	It checks the file type. It must be either doc or pdf.
//	Parameters		:	fld -  field name containig file name
//						msg -  error message to be displayed
//----------------------------------------------------------------------------------------------------
function checkFileType(fld,msg)
{
	var regex = /(.doc|.pdf)$/;
	if(!regex.test(fld.value))
	{
		alert(msg);
		fld.focus();
		return false;
	}
	return true;
}

//====================================================================================================
//	Function Name	:	checkImageType
//	Purpose			:	It checks the image type. It must be either jpg or gif.
//	Parameters		:	fld -  field name containig image file name
//						msg -  error message to be displayed
//----------------------------------------------------------------------------------------------------
function checkImageType(fld,msg)
{
	var regex = /(.jpg|.jpeg|.gif)$/;
	if(!regex.test(fld.value))
	{
		alert(msg);
		fld.focus();
		return false;
	}
	return true;
}

//====================================================================================================
//	Function Name	:	IsUrl
//	Purpose			:	It check that if url starts with htpp://
//	Parameters		:	fld -  field name containig url
//						msg -  error message to be displayed
//----------------------------------------------------------------------------------------------------
function IsUrl(fld,msg)
{
	var regex = /^(http:\/\/)/;
	if(!regex.test(fld.value))
	{
		alert(msg);
		fld.focus();
		return false;
	}
	return true;
}

//====================================================================================================
//	Function Name	:	IsFileSize
//	Purpose			:	It ckecks the size of the image file.
//	Parameters		:	fld -  field name containig image file name
//	Return			:	None
//	Author			:	Jignasa Naik
//	Creation Date	:	29-May-2003
//----------------------------------------------------------------------------------------------------
function IsFileSize(fld,msg)
{
	var img = new Image();
	img.src = fld.value;
//	alert('Dimensions:' + img.width + 'x' + img.height);
//	alert('File Size:' + img.fileSize);
	if(img.fileSize > 102400)
	{
		alert(msg);
		fld.focus();
		return false;
	}

	return true;
}
function IsNumeric(str)
{
   if((window.event.keyCode<48) || (window.event.keyCode>57) )
   {
   	  if(window.event.keyCode!=46)
	  {
	  	window.event.keyCode=0;
	  }
   }		
}

function IsPassword(fld,msg)
{
	var regex = /^[_]*[a-zA-Z]+[a-zA-Z0-9]*$/;
	if(!regex.test(fld.value))
  	{
		alert(msg);
		fld.focus();
		return false;
	}
	return true;
}


function isNumericKeyDec()
{
	if (window.event.keyCode < 48 || window.event.keyCode > 57)
	{
		if (window.event.keyCode != 46)
			window.event.keyCode = 0;
	} 
}

function isNumericKey()
{
	if (window.event.keyCode < 48 || window.event.keyCode > 57)
	{
		window.event.keyCode = 0;
	} 
}

function change_state_list(frm,lstcountry,stateSel,state_combo_name,state_text)
{
	cat = lstcountry.options[lstcountry.selectedIndex].value;
	with(frm)
	{
		for(i=0; i<arrState.length; i++)
		{
			if(arrState[i][0] == cat)	break;
		}
	
		if(i!=arrState.length)
		{
			state_combo_name.disabled=false;
			state_text.disabled=true;
			state_combo_name.length = 1;
			for(j=1; j<arrState[i].length; j+=3)
			{
				state_combo_name.length++;
				state_combo_name[state_combo_name.length-1].value = arrState[i][j];
				state_combo_name[state_combo_name.length-1].text = arrState[i][j+1];
				if(stateSel == arrState[i][j])
				{
					state_combo_name[state_combo_name.length-1].selected = true;
				}
			}
	
		}
		else
		{
			state_combo_name.length = 1;
			state_combo_name.disabled=true;
			state_text.disabled=false;
		}
		
	}
}
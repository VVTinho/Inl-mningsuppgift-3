function popup() 
{
	alert
	(
				"Jag berättar sanningen.\nI will write deliberately and with accuracy.\nI will acknowledge and correct mistakes promptly.\nI will preserve the original post, using notations to show where I have made changes so as to maintain the integrity of my publishing.\nI will never delete a post.\nI will not delete comments unless they are spam or off-topic.\nI will reply to emails and comments when appropriate, and do so promptly.\nI will strive for high quality with every post – including basic spellchecking.\nI will stay on topic.\nI will disagree with other opinions respectfully.\nI will link to online references and original source materials directly.\nI will disclose conflicts of interest.\nI will keep private issues and topics private, since discussing private issues would jeopardize my personal and work relationships."			  
	)
}

// Skapar en funktion som bestämmer antal skrivna bokstäver i textfälten.
function EnforceMaximumLength(fld,len) 
{
	if(fld.value.length > len) { fld.value = fld.value.substr(0,len); }
}
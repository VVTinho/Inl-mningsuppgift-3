function popup() 
{
	alert
	(
				"Jag kommer att berätta sanningen.\nJag kommer rätta till misstag omgående.\nJag kommer att bevara det ursprungliga inlägget, med anteckningar för att visa var jag har gjort ändringar.\nJag kommer aldrig ta bort ett inlägg.\nJag kommer att svara på e-post och kommentarer när så är lämpligt.\nJag kommer att sträva efter hög kvalitet i varje inlägg - inklusive grundläggande stavningskontroll.\nJag säger emot andra åsikter/inlägg respektfullt.\nJag kommer att länka till online referenser direkt."			  
	)
}

// Skapar en funktion som bestämmer antal skrivna bokstäver i textfälten.
function EnforceMaximumLength(fld,len) 
{
	if(fld.value.length > len) { fld.value = fld.value.substr(0,len); }
}
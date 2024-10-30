function importerRemoveSpaces(sFldval)
{
	var sTemp=sFldval;
	var sNewval=sTemp;
	//remove spaces from the front
	for(var i=0;i<sTemp.length;i++)
	{
		if(sTemp.charAt(i)!=" ")
			break;
		else
			sNewval = sTemp.substring(i+1);
	}
	return sNewval;
}
function importerFixSpace(sFldval)
{
	var sTemp=sFldval;
	var sReversedString="";
	var sTemp1;

	//remove spaces from the front
	sNewval = importerRemoveSpaces(sTemp);

	// reverse n remove spaces from the front
	for(var i=sNewval.length-1;i>=0;i--)
		sReversedString = sReversedString + sNewval.charAt(i);
	sTemp1 = importerRemoveSpaces(sReversedString);
	//reverse again
	sReversedString="";
	for(var i=sTemp1.length-1;i>=0;i--)
		sReversedString = sReversedString + sTemp1.charAt(i);
	sNewval = sReversedString;
	return sNewval;
}
/*-------------------------------------------------------------------------
        This sub routine checks for the mandatory fields, 
		their data types and maximum length
        also validates valid email entered or not
        Return : True/False
        Input : objFrm ( form object name)
--------------------------------------------------------------------------*/
function importerValidateForm(objFrm)
{
	var iConventionPos;
	var sChangedName;
 for( var i =0; i< objFrm.length;i++)
 {
	///////////// Only for this site ends ////////
		if(objFrm[i].type=='text' || objFrm[i].type=='textarea' || 
			objFrm[i].type=='select-one' || objFrm[i].type=='select-multiple' || 
			objFrm[i].type=='file' || 
			objFrm[i].type=='radio')
		{
			if(objFrm[i].type=='text' || objFrm[i].type=='textarea' )
			{
				objFrm[i].value = importerFixSpace(objFrm[i].value);
			}

			var objDataTypeHolder = objFrm[i].name.substring(0,3);
   if(objFrm[i].name.substring(0,5)=='TREF_' || 	objFrm[i].name.substring(0,5)=='TNEF_')
			{
				objDataTypeHolder = objFrm[i].name.substring(0,5);
			}
 
			if(objFrm[i].type=='select-one' && objDataTypeHolder=="TR_")
   {    
    if(objFrm[i].options[objFrm[i].selectedIndex].value=='')
    {
     sChangedName = objFrm[i].name.substring(3);
     sChangedName = getFormattedmsg(sChangedName)
     alert("Please select "+ sChangedName +".");
     objFrm[i].focus();
     return false;
     break;
    }
   }
			if(objFrm[i].type=='select-multiple' &&	objDataTypeHolder=="TR_")
   {
    if(objFrm[i].selectedIndex==-1)
    {
     sChangedName = objFrm[i].name.substring(3);
     lengg=sChangedName.length;
     sChangedName = sChangedName.substring(0,(lengg-2));
     sChangedName = getFormattedmsg(sChangedName)
     alert("Please select "+ sChangedName +".");
     objFrm[i].focus();
     return false;
     break;
    }
   }
   
		
			
   
			if((objDataTypeHolder=="TR_" || objDataTypeHolder=="IR_" || 
				objDataTypeHolder=="MR_"  )&& (objFrm[i].value=='') )
			{
				sChangedName = objFrm[i].name.substring(3);
				sChangedName = getFormattedmsg(sChangedName)
  
				alert("Please enter "+ sChangedName +".");
    if(objFrm[i].type=='textarea' && ( objFrm[i].name=='TR_description' || 
       objFrm[i].name=='TR_content' || objFrm[i].name=='TR_message'))
    {
				objFrm[i].focus();
				objFrm[i].select();
    }   
    else
    {
				 objFrm[i].focus();
 				objFrm[i].select();
    }
				return false;
				break;
			}
	
			if((objDataTypeHolder=="IR_" || objDataTypeHolder=="MR_" )&& 
				(isNaN(objFrm[i].value)))
			{
				sChangedName = objFrm[i].name.substring(3);
				sChangedName = getFormattedmsg(sChangedName)
				alert("Please enter numeric "+ sChangedName +".");
				objFrm[i].focus();
				objFrm[i].select();
				return false;
				break;
			}
			if((objDataTypeHolder=="IR_" || objDataTypeHolder=="MR_" )&& 
				(objFrm[i].value < 0))
			{
				sChangedName = objFrm[i].name.substring(3);
				sChangedName = getFormattedmsg(sChangedName)
				alert("Please enter valid "+ sChangedName +".");
				objFrm[i].focus();
				objFrm[i].select();
				return false;
				break;
			}

			if((objDataTypeHolder=="IN_" || objDataTypeHolder=="MN_" )&& 
				(isNaN(objFrm[i].value) && objFrm[i].value!='' ))
			{
				sChangedName = objFrm[i].name.substring(3);
				sChangedName = getFormattedmsg(sChangedName)
				alert("Please enter numeric "+ sChangedName +".");
				objFrm[i].focus();
				objFrm[i].select();
				return false;
				break;
			}
			if((objDataTypeHolder=="IN_" || objDataTypeHolder=="MN_" )&& 
				(objFrm[i].value<0 && objFrm[i].value!=''))
			{
				sChangedName = objFrm[i].name.substring(3);
				sChangedName = getFormattedmsg(sChangedName)
				alert("Please enter valid "+ sChangedName +".");
				objFrm[i].focus();
				objFrm[i].select();
				return false;
				break;
			}
			if((objDataTypeHolder=="IR_" || objDataTypeHolder=="IN_" ) && 
				(objFrm[i].value.indexOf(".")!=-1))
			{
				sChangedName = objFrm[i].name.substring(3);
				sChangedName = getFormattedmsg(sChangedName)
				alert("Please enter valid "+ sChangedName +".");
				objFrm[i].focus();
				objFrm[i].select();
				return false;
				break;
			}
			if((objDataTypeHolder=="IN_" ) && ((objFrm[i].value.indexOf("e")!=-1) ||(objFrm[i].value.indexOf("E")!=-1)) )
			{
				sChangedName = objFrm[i].name.substring(3);
				sChangedName = getFormattedmsg(sChangedName)
				alert("Please enter Numeric "+ sChangedName +".");
				objFrm[i].focus();
				objFrm[i].select();
				return false;
				break;
			}
			if((objDataTypeHolder=="TREF_") || (objDataTypeHolder=="TNEF_" && 
				objFrm[i].value!='' ))
			{
				if(!importerValidateEMail(objFrm[i].value))
				{
				sChangedName = objFrm[i].name.substring(5);
				sChangedName = getFormattedmsg(sChangedName)
				alert("Please enter valid "+ sChangedName +".");
				objFrm[i].focus();
				objFrm[i].select();
				return false;
				break;
				}
			}
			
			//ValidateNumber(objName)
			if((objDataTypeHolder=="NR_"))
			{
				if(!ValidateNumber(objFrm[i].value))
				{
					objFrm[i].focus();
					return false;
					break;
				}
			}			
			//ValidateNumber(objName)
		}
	}
	return true;
}


function ValidateNumber(objName)
{

	var h;
	var x;

	h=objName.length;
	x = objName;
	if (h==0)
	{
		alert("Price Can be numeric only");
		return false;
	}
	for( i=0;i<h;i++)
	{
		z = x.substring(i,i+1);
		if ( z=="'"||z=='"' || (z >= "a" && z <= "z" ) || (z >= "A" && z <= "Z") )
		{
			alert("Price Can be numeric only");
			return false;
		}
	}
	jj=x.indexOf(".");
	if (jj != "-1")
	{
		hh=x.substring(jj);
		ll=hh.length;
		if (ll > 3)
		{
			alert("Price Can have upto 2 decimal places");
			return false;
		}
	}
	x = objName;
	return true;
}
function getFormattedmsg(sVal)
{
	while(sVal.indexOf("_")!=-1)
	{
		sVal = sVal.replace("_", " ")
	}
	return sVal;
}

function importerValidateEMail(objName)
{
	var sobjValue;
	var iobjLength;
	sobjValue=objName;
	iobjLength=sobjValue.length;
	iFposition=sobjValue.indexOf("@");
	iSposition=sobjValue.indexOf(".");
	iTmp=sobjValue.lastIndexOf(".");
	iPosition=sobjValue.indexOf(",");
	iPos=sobjValue.indexOf(";");

	if (iobjLength!=0)
	{
		if ((iFposition == -1)||(iSposition == -1))
		{
			return false;
		}
		else if(sobjValue.charAt(0) == "@" || sobjValue.charAt(0)==".")
		{
			return false;
		}
		else if(sobjValue.charAt(iobjLength) == "@" ||
				sobjValue.charAt(iobjLength)==".")
		{
			return false;
		}
		else if((sobjValue.indexOf("@",(iFposition+1)))!=-1)
		{
			return false;
		}
		else if ((iobjLength-(iTmp+1)<2)||(iobjLength-(iTmp+1)>3))
		{
			return false;
		}
		else if ((iPosition!=-1) || (iPos!=-1))
		{
			return false;
		}
		else
		{
			return true;
		}
	}
}
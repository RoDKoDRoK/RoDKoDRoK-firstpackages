function loadWorldPins( callback ){							
	
	//à enlever, permet de charger l'ancien fichier en cas de manque de données provenant de drupal
	// We're going to ask a file for the JSON data.
	xhr = new XMLHttpRequest();

	// Where do we get the data?
	xhr.open( 'GET', oldLatlonFile, true ); 
	
	// What do we do when we have it?
	xhr.onreadystatechange = function() {
	  // If we've received the data
	  if ( xhr.readyState === 4 && xhr.status === 200 ) {
	      // Parse the JSON
	      latlonData = JSON.parse( xhr.responseText );	
		  
		  //preload countryAll with old data
		  var tabTmpLatLon=latlonData['countries'];
			for( var keytmp in tabTmpLatLon )
			{
				//console.log(keytmp + "=" + tabTmpLatLon[keytmp]);
				//console.log(countryLookup[keytmp]);
				//tab countryAll complete
				if(countryLookup[keytmp] != null && countryLookup[keytmp] != 'undefined' && countryLookup[keytmp] != '')
				{
					countryAll[countryLookup[keytmp]]['lat']=tabTmpLatLon[keytmp]['lat'];
					countryAll[countryLookup[keytmp]]['lon']=tabTmpLatLon[keytmp]['lon'];
					//$('#debug').append(countryLookup[keytmp]+'-'+countryAll[countryLookup[keytmp]]['lat']+'<br />');
				}
			}
			//...	
		  
		    //test si chargement data depuis json issu de RKR
			if(newIsoFileLoad=='0')
			{
				callback();
				return;
			}
		  
		    //à conserver
		    // We're going to ask a file for the JSON data.
			xhr2 = new XMLHttpRequest();
			
			// Where do we get the data?
			xhr2.open( 'GET', isoFile, true );
		
			// What do we do when we have it?
			xhr2.onreadystatechange = function() {
			  // If we've received the data
			  if ( xhr2.readyState === 4 && xhr2.status === 200 ) {
				  // Parse the JSON
				  var tmptabfromjson = JSON.parse( xhr2.responseText );
				  
				    //reparse array (terms/term/codelettre and terms/term/name) in format "CODE":"ZONENAME"
					tmptabfromjson=tmptabfromjson['terms'];
					var i = 0;
					var codelettrecour='';
					var namecour='';
					for(i = 0;i < tmptabfromjson.length; i++)
					{
						codelettrecour=tmptabfromjson[i]['term']['codelettre'];
						namecour=tmptabfromjson[i]['term']['name'];
						
						//tab countryLookup
						if(codelettrecour != null && codelettrecour != 'undefined' && codelettrecour != '' && 
								tmptabfromjson[i]['term']['lat'] != null && tmptabfromjson[i]['term']['lat'] != 'undefined' && tmptabfromjson[i]['term']['lat'] != '' && 
								tmptabfromjson[i]['term']['lon'] != null && tmptabfromjson[i]['term']['lon'] != 'undefined' && tmptabfromjson[i]['term']['lon'] != '')
						{
							//$('#debug').append(codelettrecour.toUpperCase()+'-'+latlonData['countries'][codelettrecour.toUpperCase()]['lat']+'<br />');
							latlonData['countries'][codelettrecour.toUpperCase()]['lat']=tmptabfromjson[i]['term']['lat'];
							latlonData['countries'][codelettrecour.toUpperCase()]['lon']=tmptabfromjson[i]['term']['lon'];
							//$('#debug').append(codelettrecour.toUpperCase()+'-'+tmptabfromjson[i]['term']['lat']+'<br />');
						
							//tab countryAll complete
							countryAll[namecour.toUpperCase()]['lat']=tmptabfromjson[i]['term']['lat'];
							countryAll[namecour.toUpperCase()]['lon']=tmptabfromjson[i]['term']['lon'];
							//$('#debug').append(codelettrecour.toUpperCase()+'-'+countryAll[namecour.toUpperCase()]['lon']+'<br />');
						}
					}
					//...reparsed
				  
				  
				  if( callback )
					callback();				     
				}
			};
		
			// Begin request
			xhr2.send( null );
			//...à conserver
		  		     
	    }
	};
	
	// Begin request
	xhr.send( null );
	//...à enlever			    	
}

function loadContentData(callback){	
	var filePath = configFromRKR['pathtoearth']+"categories/All.json";
	filePath = encodeURI( filePath );
	// console.log(filePath);
			
	xhr = new XMLHttpRequest();
	xhr.open( 'GET', filePath, true );
	xhr.onreadystatechange = function() {
		if ( xhr.readyState === 4 && xhr.status === 200 ) {
	    	timeBins = JSON.parse( xhr.responseText ).timeBins;
		
			maxValue = 0;
			// console.log(timeBins);

			startTime = timeBins[0].t;
	    	endTime = timeBins[timeBins.length-1].t;
	    	timeLength = endTime - startTime;				    											    	

			if(callback)
				callback();				
	    	console.log("finished read data file");	   	
	    }
	};
	xhr.send( null );					    	
}

function loadCountryCodes( callback ){
	cxhr = new XMLHttpRequest();
	cxhr.open( 'GET', oldIsoFile, true );
	cxhr.onreadystatechange = function() {
		if ( cxhr.readyState === 4 && cxhr.status === 200 ) {
				if(oldIsoFilePreload)
				{
					countryLookup = JSON.parse( cxhr.responseText );
					
					//preload countryAll with old data
				  var tabTmpCountryLookup=countryLookup;
				  for( var keytmp in tabTmpCountryLookup )
					{
						//console.log(keytmp + "=" + tabTmpCountryLookup[keytmp]);
						//tab countryAll complete
						countryAll[tabTmpCountryLookup[keytmp]]=new Array();
						countryAll[tabTmpCountryLookup[keytmp]]['name']=tabTmpCountryLookup[keytmp];
						countryAll[tabTmpCountryLookup[keytmp]]['codelettre']=keytmp;
						//$('#debug').append(countryAll[tabTmpCountryLookup[keytmp]]['codelettre']+'-'+countryAll[tabTmpCountryLookup[keytmp]]['name']+'<br />');
					}
					//...
				}
				
				//test si chargement data depuis json issu de RKR
				if(newIsoFileLoad=='0')
				{
					callback();
					return;
				}
				
				cxhr2 = new XMLHttpRequest();
				cxhr2.open( 'GET', isoFile, true );
				cxhr2.onreadystatechange = function() {
					if ( cxhr2.readyState === 4 && cxhr2.status === 200 ) {
						
						var resultfromjson = JSON.parse( cxhr2.responseText );
						
						//reparse array (terms/term/codelettre and terms/term/name) in format "CODE":"ZONENAME"
						var tmptabfromjson=resultfromjson['terms'];
						var i = 0;
						var codelettrecour='';
						var namecour='';
						var codegris='';
						for(i = 0;i < tmptabfromjson.length; i++)
						{
							codelettrecour=tmptabfromjson[i]['term']['codelettre'];
							namecour=tmptabfromjson[i]['term']['name'];
							codegris=tmptabfromjson[i]['term']['codegris'];
							
							//tab countryLookup
							if(codelettrecour != null && codelettrecour != 'undefined' && codelettrecour != '')
								countryLookup[codelettrecour.toUpperCase()]=namecour.toUpperCase();
							//$('#debug').append(codelettrecour.toUpperCase()+'-'+countryLookup[codelettrecour.toUpperCase()]+'<br />');
							
							//tab countryAll
							countryAll[namecour.toUpperCase()]=new Array();
							countryAll[namecour.toUpperCase()]['tid']=tmptabfromjson[i]['term']['tid'];
							countryAll[namecour.toUpperCase()]['name']=namecour.toUpperCase();
							if(codelettrecour != null && codelettrecour != 'undefined' && codelettrecour != '')
							{
								//search old countryAll colonne with the same country code and delete it
								var tmpCountryAll=countryAll;
								for(var keytmp in tmpCountryAll)
								{
									if(tmpCountryAll[keytmp]['codelettre']==codelettrecour.toUpperCase())
									{
										delete countryAll[keytmp];
										break;
									}
								}
								
								//add new countryAll
								countryAll[namecour.toUpperCase()]['codelettre']=codelettrecour.toUpperCase();
							}
							var oldCodeGrisCour=countryColorMap[codelettrecour.toUpperCase()];
							if(codegris != null && codegris != 'undefined' && codegris != '')
								countryAll[namecour.toUpperCase()]['codegris']=tmptabfromjson[i]['term']['codegris'];
							else if (oldCodeGrisCour != null && oldCodeGrisCour != 'undefined' && oldCodeGrisCour != '')
								countryAll[namecour.toUpperCase()]['codegris']=oldCodeGrisCour; //old code gris si existant
							
							//tab countryColorMap
							if(codegris != null && codegris != 'undefined' && codegris != '')
								countryColorMap[codelettrecour.toUpperCase()]=codegris;
							//$('#debug').append(codelettrecour.toUpperCase()+'-'+countryColorMap[codelettrecour.toUpperCase()]+'<br />');
						}
						
						console.log("loaded country codes");
						callback();

					}
				}
			cxhr2.send( null );
		}
	};
	cxhr.send( null );
}


function loadconfigFromRKR(callback){
	//TO KILL FOR A LATER USE OF A JSON MAIN CONFIG
	if(callback)
		callback();	
	return;
	//...
	var deltaBlocDrupal='null';
	var deltaBlocDrupalZone=parent.document.getElementById('delta_iframe_globe'); //recup delta block
	if(deltaBlocDrupalZone != null && deltaBlocDrupalZone != 'undefined' && deltaBlocDrupalZone != '')
		deltaBlocDrupal = deltaBlocDrupalZone.value;
	
	//default country (optionnel)
	var defaultcountryBlocDrupal='null';
	var defaultcountryBlocDrupalZone=parent.document.getElementById('defaultcountry_globe'); //recup delta block
	if(defaultcountryBlocDrupalZone != null && defaultcountryBlocDrupalZone != 'undefined' && defaultcountryBlocDrupalZone != '')
		defaultcountryBlocDrupal = defaultcountryBlocDrupalZone.value;
	
	var subfolder=configFromRKR['rootsubfolder'];
	
	var filePath = "/"+configFromRKR['rootsubfolder']+"/globe-config-json/"+deltaBlocDrupal+"/"+defaultcountryBlocDrupal;
	filePath=filePath.replace("//","/");
	filePath=filePath.replace("//","/");
	filePath = encodeURI( filePath );
	// console.log(filePath);
			
	xhr = new XMLHttpRequest();
	xhr.open( 'GET', filePath, true );
	xhr.onreadystatechange = function() {
		if ( xhr.readyState === 4 && xhr.status === 200 ) {
	    	configFromRKR = JSON.parse( xhr.responseText );
			configFromRKR['rootsubfolder']=subfolder;
			
			if(callback)
				callback();				
	    	console.log("finished read data file");	   	
	    }
	};
	xhr.send( null );					    	
}

var utils = (function(){
     return {
		 //create XHR objects for ajax requests:
		 createXHR: function(){
			 if(typeof XMLHttpRequest != 'undefined'){
			     return new XMLHttpRequest();
		     }else if(typeof ActiveXObject != 'undefined'){
			     if(typeof arguments.callee.activeXString != 'string'){
				     var versions = ['MSXML2.XMLHttp.6.0', 'MSXML2.XMLHttp.3.0', 'MSXML2.XMLHttp'], i, len;
				     for (i = 0, len = versions.length; i < len; i++){
					     try{
						     new ActiveXObject(versions[i]);
						     arguments.callee.activeXString = versions[i];
						     break;
					     }catch (ex){
						     //skip
					     }
				     }
			     }
			     return new ActiveXObject(arguments.callee.activeXString);
		     }else{
			     throw new Error('No XHR object available.');
		     }
		 },
		 showAjaxError: function(responseText, el){
			 let errorTooltip = {
				 tooltipId: this.generateRandomString(10, "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz"),
				 targetId: el.id ?? this.generateRandomString(12, "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz"),
				 tooltipType: "error", //types include error, success, info and onboard.
				 content: JSON.parse(responseText).Message
			 };
			 Saqle.Tooltip.generate(errorTooltip);
		 },
		 ajax: function(type, url, extraData = null, form = null, headers = {}){
			 let self = this;
			 return new Promise(function(resolve, reject){
				 let request = self.createXHR();
				 request.onreadystatechange = function(){
					 if(request.readyState == 4){
						 if((request.status >= 200 && request.status < 300) || request.status == 304){
							  resolve(request.responseText);
						 }else{
							 /*if(errorElement && typeof errorElement === "object"){
								 self.showAjaxError(request.responseText, errorElement);
							 }*/
							 reject(request.responseText);
						 }
					 }
				};
				let data = null;
				let objectProperties = extraData && typeof extraData == "object" ? Object.entries(extraData) : [];
				switch(type){
					case "PATCH":
					case "POST":
					      data = form ? new FormData(form) : new FormData();
						 objectProperties.forEach(function(property){
						     data.append(property[0], property[1]);
						 });
					break;
					case "GET":
					     objectProperties.forEach(function(property){
							 url = self.addURLParam(url, property[0], property[1]);
						 });
					break;
				}
				request.open(type, url, true);
				for(const key in headers){
                     request.setRequestHeader(key, headers[key]);
                }
				request.withCredentials = true;
				request.send(data);
			 });
		 },
		 //serialize forms:
		 serializeForm: function(){
			 let parts = [], field = null, i, len, j, optLen, option, optValue;
		     for(i=0, len=form.elements.length; i < len; i++){
			     field = form.elements[i];
			     switch(field.type){
				     case 'select-one':
				     case 'select-multiple':
				     if (field.name.length){
					     for (j=0, optLen = field.options.length; j < optLen; j++){
						     option = field.options[j];
						     if(option.selected){
							     optValue = '';
							     if(option.hasAttribute){
								     optValue = (option.hasAttribute('value') ? option.value : option.text);
							     }else{
								     optValue = (option.attributes['value'].specified ? option.value : option.text);
							     }
							     parts.push(encodeURIComponent(field.name) + '=' + encodeURIComponent(optValue));
						     }
					     }
				     }
				     break;
				     case undefined: //fieldset
				     case 'file': //file input
				     case 'submit': //submit button
				     case 'reset': //reset button
				     case 'button': //custom button
				     break;
				     case 'radio': //radio button
				     case 'checkbox': //checkbox
				     if(!field.checked){
					     break;
				     }
				     /* falls through */
				     default:
				     //don’t include form fields without names
				     if(field.name.length){
					     parts.push(encodeURIComponent(field.name) + '=' + encodeURIComponent(field.value));
				     }
			     }
		     }
		     return parts.join('&');
		 },
		 //add url parameters to get requests:
		 addURLParam: function(url, name, value){
			 url += (url.indexOf('?') == -1 ? '?' : '&');
		     url += encodeURIComponent(name) + '=' + encodeURIComponent(value);
		     return url;
		 },
		 //get url parameter values.
		 getUrlParameter: function(name){
			 name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
             var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
             var results = regex.exec(location.search);
             return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
         },
		 generateRandomString: function(len, charSet){
			 charSet = charSet || 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
			 let randomString = '';
			 for(var i = 0; i < len; i++){
				var randomPoz = Math.floor(Math.random() * charSet.length);
				randomString += charSet.substring(randomPoz,randomPoz+1);
			 }
			return randomString;
		 },
		 //add leading zeros to a string: stringValue - string to add leading zeros, maxLength - the field width of resulting string:
		 prependZeros: function(stringValue, maxLength){
			 var newStr = ""; //the string that will be returned.
		     var str_len = stringValue.length; //find the length of the input string.
		     var zeros = maxLength - str_len; //the number of zeroes to prepend.
			 for(var x = 0; x < zeros; x++){
				 newStr = newStr + "0";
			 }
		     newStr = newStr + stringValue;
		     return newStr; //return the new string.
		 },
		 getShortenedString: function(stringValue, maxLength, fileStyle){
			 var finalString = stringValue;
		     var stringLength = stringValue.length;
		     if(stringLength > maxLength){
			     if(fileStyle != undefined && fileStyle == true){
					 var stringArray = stringValue.split(".");
					 var is_file = true;
					 if(stringArray.length == 1){ //this must be a folder
						 is_file = false;
						 stringArray = stringValue.split("/");
					 }
					 var extension = stringArray[stringArray.length - 1];
					 stringArray.splice(stringArray.length - 1);
					 var newString = (is_file == true) ? stringArray.join("") : stringArray.join("/");
					 var charArray = newString.split("");
					 var extensionLength = extension.length;
					 var ellipsisLength = 4;
					 var defaultLength = extensionLength + ellipsisLength;
					 var lengthRequired = maxLength - defaultLength;
					 var leftCharArray = [];
					 var rightCharArray = [];
				     var leftIndex = 0;
				     var rightIndex = charArray.length;
				     while(lengthRequired > 0){
					     leftCharArray.push(charArray[leftIndex]);
					     lengthRequired -= 1;
					     leftIndex += 1;
					     if(lengthRequired > 0){
							 rightCharArray.push(charArray[rightIndex]);
						     lengthRequired -= 1;
						     rightIndex -= 1;
					     }
				     }
					 finalString = leftCharArray.join("") + "..." + rightCharArray.join("");
				     finalString = (is_file == true ) ?  finalString + "." + extension : finalString + "/" + extension;
			     }else{
				     finalString = stringValue.substring(0, maxLength) + "...";
			     }
		     }
		     return finalString;
		 },
		 getTimeDifference: function(time_one_milliseconds, time_two_milliseconds){
			var total = Math.max(time_one_milliseconds, time_two_milliseconds) - Math.min(time_one_milliseconds, time_two_milliseconds);
			var seconds = Math.floor( ( total/1000) % 60 );
			var minutes = Math.floor( ( total/1000/60) % 60 );
			var hours = Math.floor( ( total/(1000*60*60)) % 24 );
			var days = Math.floor( total/(1000*60*60*24) );
			
			var day = {};
			day.label = "day";
			if(days > 1) day.label = "days";
			day.count = days;
   
			var hour = {};
			hour.label = "hour";
			if(hours > 1) hour.label = "hours";
			hour.count = hours;
   
			var min = {};
			min.label = "minute";
			if(minutes > 1) min.label = "minutes";
			min.count = minutes;
   
			var sec = {};
			sec.label = "second";
			if(seconds > 1) sec.label = "seconds";
			sec.count = seconds;
   
   
			var time_parts = [
				day, hour, min, sec
			];
			var clean_parts = [total];
			for(var p = 0; p < time_parts.length; p++)
			{
				if(time_parts[p].count != 0) clean_parts.push(time_parts[p]);
			}
			return clean_parts;
		 },
		 
		 //Querying the scrollbar positions of a window
         // Return the current scrollbar offsets as the x and y properties of an object
         getScrollOffsets: function(w) 
	     {
             // Use the specified window or the current window if no argument
             w = w || window;
             // This works for all browsers except IE versions 8 and before
             if (w.pageXOffset != null) 
		     {
			     return {x: w.pageXOffset, y:w.pageYOffset};
		     }
		 
             // For IE (or any browser) in Standards mode
             var d = w.document;
             if (document.compatMode == "CSS1Compat")
		     {
			     return {x:d.documentElement.scrollLeft, y:d.documentElement.scrollTop};
		     }
		     else
		     {
			     // For browsers in Quirks mode
                 return { x: d.body.scrollLeft, y: d.body.scrollTop };
		     }
         },
	 
	     //Querying the current view port size of the doc
	     // Return the viewport size as w and h properties of an object
         getViewportSize: function(win) 
	     {
             // Use the specified window or the current window if no argument
             var w = win || window;
             // This works for all browsers except IE8 and before
             if (w.innerWidth != null) 
		     {
			     return {w: w.innerWidth, h:w.innerHeight};
		     }
		     // For IE (or any browser) in Standards mode
             var d = w.document;
             if (document.compatMode == "CSS1Compat")
		     {
			     return { w: d.documentElement.clientWidth, h: d.documentElement.clientHeight };
		     }
		     else
		     {
			     // For browsers in Quirks mode
                 return { w: d.body.clientWidth, h: d.body.clientWidth };
		     }
         },
		 
		 checkLeapYear: function(year)
		 {
			 return (year % 4 == 0);
		 },
		 
		 //get the years that a calendar covers:
		 getCalendarYears: function(yearRange, currentYear, dir)
         {
			 yearRange = yearRange && !isNaN(yearRange) ? yearRange : 10;
			 dir = dir && (dir == "before" || dir == "after" || dir == "between") ? dir : "between";
			 currentYear = currentYear ? currentYear : new Date().getFullYear();
			 calendarYears = []; //an array of all the years that calendar will cover:
			 //the years that a calendar covers will include, depending on the yearRange, all the years before and after the current year:
			 yearRange = Number(yearRange);
			 currentYear = Number(currentYear);
			 
			 //get the max number of years to cover:
		     var maxYearsToCover = yearRange * 2;
			 var startYear = 0;
			 //get start year:
			 switch(dir)
			 {
				 case "before":
					 startYear = currentYear - maxYearsToCover;
				 break;
				 case "after":
					 startYear = currentYear;
				 break;
				 case "between":
					 startYear = currentYear - yearRange;
				 break;
			 }
			 var y = 1;
			 for(y = 1; y <= maxYearsToCover; y++)
			 {
				 calendarYears.push(startYear + y)
			 }
		     //sort the years from the biggest to smallest:
			 calendarYears.sort(function(a, b){return a - b;});
		     return calendarYears;
	     },
		 
		 //draw calendar:
		 drawCalendar: function(yearsRange, /* optional */ currentDate)
         { 
		     var ref = this;
		     //the currentDate is given in the format dd-mm-yyyy:
			 //if currentDate is not explicitly given, use the systems current date:
			 var currentYear;  //current year
             var year;     //current year
			 var currentMonth; //current month
			 var currentDay;   //current day
			 var previousMonth; //the month before current month
			 var nextMonth; //the month after current month
			 var months; //an array of month names and the max days in these months
			 var febDays = 28; //the default number of days in february when it is not a leap year
			 var currentMonthName; //the name of current month
			 var maxMonthDays; //the maximum number of days in current month
			 var currentMonthIndex; //the zero based index of the current month, this will be used in the months array
			 var dates; //this is an array of all dates for the current month
			 var weekDayForFirstDayOfMonth = 0; //a numeric representation of the weekday for the first day of current month,it is by default 0
			 var maxWeekDays = 6; //the maximum number of days in a week, note that this number is zero based so idealy the number here is 7
			 if(currentDate != null && currentDate != undefined) //if currentDate is explicitly provided in the format dd-mm-yyyy
			 {
				 var dateParts = currentDate.split("-");
				 currentYear = Number(dateParts[2]);  //year
				 year = year;                     //year
				 currentMonth = Number(dateParts[1]); //month
				 currentDay = Number(dateParts[0]);   //day
			 }
			 else //if currentDate is not provided:
			 {
				 var currentDate = new Date(); //set currentDate to system current date
				 currentYear = currentDate.getFullYear();   //year
				 year = year;                           //year
				 currentMonth = currentDate.getMonth() + 1; //month
				 currentDay = currentDate.getDate();        //day
			 }
			 //check if this is a leap year:
			 if (this.checkLeapYear(currentYear))
			 {
				 febDays = 29;
			 }
			 //set the max days for months and the month names:
			 months = [
			                 [31, "January"],
							 [febDays, "February"],
							 [31, "March"],
							 [30, "April"],
							 [31, "May"],
							 [30, "June"],
							 [31, "July"],
							 [31, "August"],
							 [30, "September"],
							 [31, "October"],
							 [30, "November"],
							 [31, "December"]
			              ];
			 //set previous month and next month to current month by default:
			 previousMonth = currentMonth;
			 nextMonth = currentMonth;
			 
	         if( currentMonth >= 1 && currentMonth <= 12) //if current month is between 1 and 12
	         {
				 if( currentMonth > 1) //if current month is 2 and above
	             {
		             previousMonth = currentMonth - 1; //previous month is one month less than current month:
	             } 
		         if( currentMonth < 12) //if current month is 11 and below
	             {
		             nextMonth = currentMonth + 1; //next month is one month more than current month:
	             } 
	         }
			 //set current month index:
			 currentMonthIndex = currentMonth - 1;
			 //set maximum number of days in current month:
			 maxMonthDays = months[currentMonthIndex][0];
			 //set current month name
			 currentMonthName = months[currentMonthIndex][1];
             dates = [
			          "", "", "", "", "", "", "",
					  "", "", "", "", "", "", "",
					  "", "", "", "", "", "", "",
					  "", "", "", "", "", "", "",
					  "", "", "", "", "", "", ""
			         ];
					 
			 //for each day of the current month:
	         for(var d = 1; d <= maxMonthDays; d++)
	         {
		         var today = new Date(currentYear, currentMonthIndex, d); //get a date representation of this day:
				 var daysLeftInWeek; //the number of days left in this week after taking away the current week day from the maximum number
				                     //of days in a week:
				 var week = 0; //a zero based integer representation of current week: 0 - week 1 ... 4 - week 5
				 var daysb4 = 0; //the number of days that come before the current week:
				 var daycode = 0; //a zero based intereger reprsentation of week day for current day:
		         if(d === 1) //if this is the first day of the month:
		         {
			         weekDayForFirstDayOfMonth = today.getDay(); //get the zero based integer representation of the week day for the first day of month:
		             daysLeftInWeek = maxWeekDays - weekDayForFirstDayOfMonth; 
		         }
				 
		         if( (d >= 1) && (d <= daysLeftInWeek + 1) ) //if current day is within the first week:
		         {
		             week = 0; //this is the first week:
			         daysb4 = 0; //the number of days coming before the first week is zero:
			         daycode = today.getDay(); 
		         }
		         if((d > daysLeftInWeek + 1) && (d <= daysLeftInWeek + 1 + 7)) //if the current day is within the 2nd week:
		         {
		             week = 1; //this is the 2nd week
			         daysb4 = 6; //the days that come before the 2nd week are 6
			         daycode = today.getDay(); 
		         }
		         if((d > daysLeftInWeek + 1 + 7) && (d <= daysLeftInWeek + 1 + 7 + 7)) //if current day is within the 3rd week:
		         {
		             week = 2; //this is the third week:
			         daysb4 = 12; //the days that come before the 3rd week are 12
			         daycode = today.getDay(); 
		         }
		         if((d > daysLeftInWeek + 1 + 7 + 7) && (d <= daysLeftInWeek + 1 + 7 + 7 + 7)) //if current day is within the 4th week:
		         {
		             week = 3; //this is the forth week:
			         daysb4 = 18; //the days that come before the forth week are 18:
			         daycode = today.getDay(); 
                 }
		         if(d > daysLeftInWeek + 1 + 7 + 7 + 7) //if the current day is within the fifth week:
		         {
		             week = 4; //this is the 5fth week:
			         daysb4 = 24; //the days that come before the fifth week are 24:
			         daycode = today.getDay(); 
		         }
				 
		         //now, for all the 35 day spaces in a typical calendar, get the appropriate index for each day space:
		         var dayIndex = week + daysb4 + daycode;
				 //if the value of dates array at this index is an empty string, replace it with the value of the current day from the loop variable d
		         if( dates[dayIndex] == "")
		         {
			         dates[dayIndex] = d;
		         }
		         else
		         {
			         dates[daycode] = d;
		         }
	        }
			
			 //on the calendar interface, there will be left and right chevrons to help the user navigate back and forth throught the months:
			 //set the ids for the hidden inputs for these chevrons:
	         var previousMonthInput = "previousMonth-" + previousMonth + "-" + currentYear;
			 var nextMonthInput = "nextMonth-" + nextMonth + "-" + currentYear;
	         //get the years this calendar will cover:
			 var calendarYears = this.getCalendarYears(yearsRange, currentYear);
			 //construct the html for cakendar view:
			 var calendarView = "\
			 <div class='bryllians-calendar'>\
			     <div class='bryllians-calendar-years'>\
				     <select id='bryllians-calendar-years-select'>\
			 ";
			 calendarYears.forEach(function(year)
			 {
				 calendarView += Number(year) === Number(currentYear) ? "<option value='" + year + "' selected>" + year + "</option>" : "<option value='" + year + "'>" + year + "</option>";
			 });
			 calendarView += "\
			         </select>\
			     </div>\
			     <div class='bryllians-calendar-months'>\
			         <a href='#' data-month='" + previousMonth + "' id='bryllians-calendar-months-lastmonthlink' title='Last Month'>\
			             <span class='fa fa-chevron-left'></span>\
			         </a>\
					 <span class='bryllians-calendar-months-currentmonthname' id='bryllians-calendar-months-currentmonthname'>\
					     <input type='hidden' id='bryllians-calendar-months-currentmonth' value='" + currentMonth + "'>\
					     " + currentMonthName + " " + String(currentYear) + "\
					 </span>\
					 <a href='#' data-month='" + nextMonth + "' id='bryllians-calendar-months-nextmonthlink' title='Next Month'>\
			             <span class='fa fa-chevron-right'></span>\
			         </a>\
				 </div>\
			     <div class='bryllians-calendar-week'>\
			         <div>Su</div>\
			         <div>Mo</div>\
			         <div>Tu</div>\
			         <div>We</div>\
			         <div>Th</div>\
			         <div>Fr</div>\
			         <div>Sa</div>\
			     </div>\
			     <div class='bryllians-calendar-days'>\
			         <div class='bryllians-calendar-daysrow'>\
			 ";
			 //use the dates array to draw the days for the calendar:
			 //a calendar will have five rows of seven days each:
			 var count = 0; //when this counter reaches 6, close the previous week row, and start another week row, then set counter back to 0:
			 for(var d = 0; d < dates.length; d++)
	         {
				 if( count >= 0 && count <= 6)
		         {
					 drawToday();
		         }
		         else
		         {
					 count = 0; //reset counter to 0:
			         calendarView = calendarView + "</div><div class='bryllians-calendar-daysrow'>"; //close the previous week row and open a new week row:
				     drawToday();
		         }
				 count += 1; //increament count:
			 }
			 calendarView = calendarView + "</div></div>";
		     function drawToday()
		     {
			     if(dates[d] != "")
		         {
			         //set a unique id for every day visible on the calendar: this will be used by javascript to enable user interaction with the days:
				     var current_date = ref.prependZeros(dates[d], 2) + "-" + ref.prependZeros(currentMonth, 2) + "-" + ref.prependZeros(currentYear, 4);
				     if(dates[d] == currentDay)
				     {
					     calendarView += "<div class='bryllians-calendar-daycol_current' data-date='" + current_date + "'>" + dates[d] + "</div>";
				     }
				     else
				     {
					     calendarView += "<div class='bryllians-calendar-daycol' data-date='" + current_date + "'>" + dates[d] + "</div>";
				     }
			     }
			     else
			     {
			         calendarView += "<div class='bryllians-calendar-daycol_special'></div>";
			     }
		     }
             return calendarView;
         },
		 
		 getCurrentMonthLabel: function(/*optional*/ currentDate)
		 {
			 //the currentDate is given in the format dd-mm-yyyy:
			 //if currentDate is not explicitly given, use the systems current date:
			 var currentYear;  //current year
			 var currentMonth; //current month
			 var months; //an array of month names and the max days in these months
			 var febDays = 28; //the default number of days in february when it is not a leap year
			 var currentMonthName; //the name of current month
			 var firstDayOfMonth = 1; //the first day of the month:
			 var lastDayOfMonth; //the last day of the month:
			 
			 if(currentDate != null) //if currentDate is explicitly provided in the format dd-mm-yyyy
			 {
				 var dateParts = currentDate.split("-");
				 currentYear = Number(dateParts[2]);  //year
				 currentMonth = Number(dateParts[1]); //month
			 }
			 else //if currentDate is not provided:
			 {
				 var currentDate = new Date(); //set currentDate to system current date
				 currentYear = currentDate.getFullYear();   //year
				 currentMonth = currentDate.getMonth() + 1; //month
			 }
			 
			 //check if this is a leap year:
			 if (this.checkLeapYear(currentYear))
			 {
				 febDays = 29;
			 }
			 //set the max days for months and the month names:
			 months = [
			                 [31, "January"],
							 [febDays, "February"],
							 [31, "March"],
							 [30, "April"],
							 [31, "May"],
							 [30, "June"],
							 [31, "July"],
							 [31, "August"],
							 [30, "September"],
							 [31, "October"],
							 [30, "November"],
							 [31, "December"]
			              ];
			 //set current month index:
			 currentMonthIndex = currentMonth - 1;
			 //set maximum number of days in current month:
			 lastDayOfMonth = months[currentMonthIndex][0];
			 //set current month name
			 currentMonthName = months[currentMonthIndex][1];
             return currentMonthName + " " + firstDayOfMonth + ", " + currentYear + " - " + currentMonthName + " " + lastDayOfMonth + ", " + currentYear;
		 },
		 
		 //add leading zeros to a string:
		 prePendLeadingZeros: function(str_val, totalLength)
	     {
		     var newStr = "";
		     var str_len = String(str_val).length;
			 //console.log(str_len);
		     var zeros = totalLength - str_len;
		     for(var x = 0; x < zeros; x++)
		     {
			     newStr = newStr + "0";
		     }
		     newStr = newStr + str_val;
		     return newStr;
	     },
		 
		 //validate a date entry
		 validateDateEntry: function(date)
		 {
			 var dateIsValid = true;
			 var newDate = "";
			 var errorMessage = "Invalid Date. Please enter a valid date!";
			 /*a valid date is supposed to be entered in the format dd-mm-yyyy or d-m-yyyy,
			   any date entry that does not fit this creteria is considered invalid date:
			 */
			 //remove all the spaces in the date:
			 date = date.replace(/\s/g, "");
			 //split the date into an array of three items, day, month and year:
			 var dateParts = date.split("-");
			 //check if the dateParts actually has exactly three items, otherwise this is already an invalid date:
			 if(dateParts.length != 3)
			 {
				 dateIsValid = false;
			 }
			 else
			 {
				 //confirm that all the entered date parts are digits.
				 if( !isNaN(dateParts[0]) && !isNaN(dateParts[1]) && !isNaN(dateParts[2]))
				 {
				     //get the dateParts values:
				     var day = dateParts[0];
				     var month = dateParts[1];
				     var year = dateParts[2];
				     //check if the day value is between 1 and 31, otherwise this is already an invalid date:
				     if( Number(day) >= 1 && Number(day) <= 31)
				     {
					     //check if the month value is between 1 and 12, otherwise this is already an invalid date:
					     if( Number(month) >= 1 && Number(month) <= 12)
					     {
						     //check if the year value is atleast greater than 1970, otherwise this is already an invalid date:
						     if(Number(year) >= 1970)
						     {
								 var febDays = ( this.checkLeapYear(Number(year)) == true) ? 29 : 28; //assing the correct number of days to feb.
			                     //set the max days for months and the month names:
			                     months = [[31, "January"], [febDays, "February"], [31, "March"], [30, "April"], [31, "May"], [30, "June"], [31, "July"], [31, "August"], [30, "September"], [31, "October"], [30, "November"], [31, "December"]];
							     //get the index for the entered month:
							     var monthIndex = Number(month) - 1;
							     /*now check if the number of days entered matches that corresponding month, otherwise this is already an invalid date*/
							     if( Number(day) <= months[monthIndex][0])
							     {
									 //now make the date be in correct format:
								     newDate = this.prePendLeadingZeros(day, 2) + "-" + this.prePendLeadingZeros(month, 2) + "-" + this.prePendLeadingZeros(year, 4);
							     }
							     else
							     {
								     dateIsValid = false;
								     errorMessage = "The maximum number of days for " + months[monthIndex][1] + " should be " + months[monthIndex][0] + ". Please enter a valid date!";
							     }
						     }
						     else
						     {
							     dateIsValid = false;
							     errorMessage = "The years in a date cannot be less than 1. Please enter a valid date!";
						     }
					     }
					     else
					     {
						     dateIsValid = false;
						     errorMessage = "The months in a date cannot be more than 12 and less than 1. Please enter a valid date!";
					     }
				     }
				     else
				     {
					     dateIsValid = false;
					     errorMessage = "The days in a date cannot be more than 31 and less than 1. Please enter a valid date!";
				     }
				 }
				 else
				 {
					 dateIsValid = false;
					 errorMessage = "One or more of the date parts provided is not a number. Please enter a valid date!";
				 }
			 }
			 return {"dateIsValid":dateIsValid, "validDate":newDate, "errorMessage":errorMessage};
		 },
		 
		 //validate time entries:
		 validateTimeEntry: function(time)
		 {
			 var timeIsValid = true;
			 var errorMessage = "Invalid Time. Please enter a valid time.";
			 var newTime = "";
			 //remove all the spaces in the time given:
			 time = time.replace(/\s/g, "");
			 time = time.trim();
			 //split the time into hours, minutes and seconds using : as seperator:
			 var timeArray = time.split(":");

			 if( (timeArray[timeArray.length - 1] != "" && timeArray.length == 2) || ( timeArray.length == 3 ) )
			 {
				 var hours = timeArray[0];
				 var minutes = timeArray[1];
				 var seconds = (timeArray.length == 3) ? timeArray[2] : 0
				 if( !isNaN( hours) && !isNaN(minutes) && !isNaN(seconds))
				 {
				     //check if hours is between 1 and 12, otherwise this is an invalid time:
				     if(Number(hours) >= 1 && Number(hours) <= 12)
				     {
					     //check if minutes is between 0 and 59, otherwise this is an invalid time:
					     if(Number(minutes) >= 0 && Number(minutes) <= 59)
				         {
						     //check if seconds is between 0 and 59, otherwise this is an invalid time:
					         if(Number(seconds) >= 0 && Number(seconds) <= 59)
				             {
						         //create a string with a validated time in the required format:
							     newTime = this.prePendLeadingZeros(hours, 2) + ":" + this.prePendLeadingZeros(minutes, 2) + ":" + this.prePendLeadingZeros(seconds, 2);
				             }
					         else
					         {
						         timeIsValid = false;
							     errorMessage = "The number of seconds cannot be more than 59. Please enter a valid time.";
					         }
				         }
					     else
					     {
						     timeIsValid = false;
						     errorMessage = "The number of minutes cannot be more than 59. Please enter a valid time.";
					     }
				     }
				     else
				     {
					     timeIsValid = false;
					     errorMessage = "The number of hours cannot be less than 1 or more than 12. Please enter a valid time.";
				     }
				 }
				 else
				 {
					 timeIsValid = false;
					 errorMessage = "One of the time parts is not a number. Please enter a valid time.";
				 }
			 }
			 else
			 {
				 timeIsValid = false;
			 }
			 return {timeIsValid:timeIsValid, validTime:newTime, errorMessage:errorMessage};
		 },
		 
		 //validate number entries:
		 validateNumberEntry: function(number, /*optional*/min, max)
		 {
			 var numberIsValid = true;
			 var errorMessage = "This is not a number! Please enter a valid number.";
			 //replace all the spaces in number:
			 number = number.replace(/\s/g, "");
			 if(isNaN(number) == true)
			 {
				 numberIsValid = false;
				 
			 }
			 return {"numberIsValid":numberIsValid, "errorMessage":errorMessage};
		 },
		 
		 validateTextEntry: function(text) //validate text entries.
		 {
			 text = Number(text);
			 var textIsValid = ( text == NaN) ? true : false;
			 var errorMessage = "Invalid name! Please enter a valid name.";
			 //text = text.replace(/\s/g, "");
			 return {"nameIsValid":textIsValid, "errorMessage":errorMessage};
		 },
		 
		 //validate phone numbers:
		 validatePhoneNumber: function(number)
	     {
		     /*a complete phone number has altleast ten digits
		     all phone numbers will be assumed to be kenyan therefore phone numbers
		     preceded with country codes will be rejected as invalid:
		 
		     acceptable phone numbers will appear in the one of the following patterns:
		     1. 0712345678
		     2. 0712 345 678
		     3. 0712-345-678
		     4. 071 234 5678
		     5. 071-234-5678
		     6. 071 2345 678
		     7. 071-2345-678
		     consider any pattern falling aout of this to be aninvalid phone number:
		     */
		     var phonePattern = /\b\d{10}\b|\b\d{4}[\s]\d{3}[\s]\d{3}\b|\b\d{4}[-]\d{3}[-]\d{3}\b|\b\d{3}[\s]\d{3}[\s]\d{4}\b|\b\d{3}[-]\d{3}[-]\d{4}\b|\b\d{3}[\s]\d{4}[\s]\d{3}\b|\b\d{3}[-]\d{4}[-]\d{3}\b/g;
		     var phoneIsValid = phonePattern.test(number.replace(/\s/g, ""));
			 var errorMessage = "Invalid Phone Number! Please enter the correct phone number.";
			 return {"phoneIsValid":phoneIsValid, "errorMessage":errorMessage};
		 },
		 
		 //validate email addresses:
		 validateEmailAddress: function(email)
	     {
	         var emailPattern = /\b[a-zA-Z]+[a-zA-Z0-9]+[@]yahoo[.com]\b|\b[a-zA-Z]+[a-zA-Z0-9]+[@]gmail[.com]\b|\b[a-zA-Z]+[a-zA-Z0-9]+[@]hotmail[.com]\b/;
			 var emailIsValid = emailPattern.test(email.replace(/\s/g, ""));
			 var errorMessage = "Invalid Email Address! Please enter the correct email address.";
			 return {"emailIsValid":emailIsValid, "errorMessage":errorMessage};
	     },
		 
		 //validate id numbers:
		 validateSchoolId: function(id)
		 {
			 var errorMessage = "Invalid ID Number! Please enter a valid school id number.";
			 var idPattern = /\b[A-Z][\d]{5}\b/;
			 var idIsValid = idPattern.test(id.replace(/\s/g, ""));
			 return {"idIsValid":idIsValid, "errorMessage":errorMessage};
		 },
         
    showAndHideSomeElements: function(elements_to_hide, elements_to_show, element_identifier, /*optional*/css_styles_for_elements_to_show)
    {
		 element_identifier = element_identifier !== null && element_identifier !== undefined ? element_identifier : "#";
		 //hide the specified elements:
         for(var el = 0; el < elements_to_hide.length; el++)
         {
             var el_id = elements_to_hide[el].indexOf(".") == -1 && elements_to_hide[el].indexOf("#") == -1 ? element_identifier + elements_to_hide[el] : elements_to_hide[el];
             $(el_id).hide();
         }
         //show the specified elements:
         for(var el = 0; el < elements_to_show.length; el++)
         {
             var el_id = elements_to_show[el].indexOf(".") == -1 && elements_to_show[el].indexOf("#") == -1 ? element_identifier + elements_to_show[el] : elements_to_show[el];
             $(el_id).show();
         }
         //apply the specified css rules to the shown elements:
         if(css_styles_for_elements_to_show)
         {
             for(var el = 0; el < elements_to_show.length; el++)
             {
                var el_id = element_identifier + elements_to_show[el];
                for(var style = 0; style < css_styles_for_elements_to_show.length; style++)
                {
                    $(el_id).css(css_styles_for_elements_to_show[style].rule, css_styles_for_elements_to_show[style].value);
                }
             }   
         }
    },
         
    constructFileNameLabelWithIcon: function(file_type, file_name)
    {
            var label = "";
            switch(file_type)
            {
                case "video":
                    label = "<span class='fa fa-file-video'></span>&nbsp;" + file_name;
                break;
                case "image":
                    label = "<span class='fa fa-file-image'></span>&nbsp;" + file_name;
                break;
                case "audio":
                    label = "<span class='fa fa-file-audio'></span>&nbsp;" + file_name;
                break;
                case "pdf":
                    label = "<span class='fa fa-file-pdf'></span>&nbsp;" + file_name;
                break;
                case "word":
                    label = "<span class='fa fa-file-word'></span>&nbsp;" + file_name;
                break;
                case "excel":
                    label = "<span class='fa fa-file-excel'></span>&nbsp;" + file_name;
                break;
                case "powerpoint":
                    label = "<span class='fa fa-file-powerpoint'></span>&nbsp;" + file_name;
                break
                case "code":
                    label = "<span class='fa fa-file-code'></span>&nbsp;" + file_name;
                break
                default:
                   label = "<span class='fa fa-file'></span>&nbsp;" + file_name;
                break;
            }
            return label;
    },
    
    getFilePathInfo: function(file_path)
    {
        var file_path_array = file_path.split("\\");
        if(file_path_array.length == 1)
        {
            file_path_array = file_path.split("/");
        }
        var file_name = file_path_array[file_path_array.length - 1];
        var file_name_array = file_name.split(".");
		var file_ext = (file_name_array.length == 2) ? file_name_array[file_name_array.length - 1] : "";
		file_ext = file_ext.toLowerCase();
		var folder = (file_name_array.length == 2) ? false : true;

        var imageFileExtensions = ["jpg", "jpeg", "tif", "tiff", "bmp", "gif", "png", "eps", "cr2", "raw", "nef", "orf", "sr2", "webp"];
        var videoFileExtensions = ["avi", "flv", "ogv", "wmv", "mov", "mp4"];
        var pdfFileExtensions = ["pdf"];
        var audioFileExtensions = ["mp3"];
        var codeFileExtensions = [
            "txt", "as", "mx", "ada", "ads", "adb", "asm", "asp", "sh", "bsh", "bat", "cmd", "nt",
            "ml", "mli", "sml", "thy", "c", "cmake", "cbl", "cbd", "cdb", "cdc", "cob", "litcoffee", "h", "hpp", "hxx", "cpp", 
            "cxx", "cc", "cs", "css", "d", "diff", "patch", "f", "for", "f90", "f95", "f2k", "hs", "lhs", "las", "html", "htm",
            "shtml", "shtm", "xhtml", "hta", "ini", "inf", "reg", "url", "iss", "java", "js", "jsp", "lua", "lsp", "lisp", "m",
            "pas", "inc", "pl", "pm", "plx", "php", "ps", "py", "pyw", "rc", "rb", "rbw", "st", "sql", "tcl", "tex", "vb", "vbs",
            "v", "sv", "vh", "svh", "vhd", "vhdl", "xml", "xsml", "xsl", "xsd", "kml", "yml"];
        var fileType = "";
        if(imageFileExtensions.indexOf(file_ext) != -1)
        {
            fileType = "image";
        }
        else if(videoFileExtensions.indexOf(file_ext) != -1)
        {
            fileType = "video";
        }
        else if(pdfFileExtensions.indexOf(file_ext) != -1)
        {
            fileType = "pdf";
        }
        else if(audioFileExtensions.indexOf(file_ext) != -1)
        {
            fileType = "audio";
        }
        else if(codeFileExtensions.indexOf(file_ext) != -1)
        {
            fileType = "code";
        }
        else
        {
            fileType = "other";   
        }
        return {file_base_name: file_name, file_extension: file_ext, file_type: fileType, dir: folder};
    },
    
    getCurrentDate: function()
    {
         var currentDate = new Date(); //set currentDate to system current date
         currentYear = currentDate.getFullYear(); 
         currentMonth = currentDate.getMonth() + 1; 
         currentDay = currentDate.getDate(); 
         return this.prePendLeadingZeros(currentYear, 4) + "-" + this.prePendLeadingZeros(currentMonth, 2) + "-" + this.prePendLeadingZeros(currentDay, 2);
	},

     //construct a string from an array of elements:
	 constructStringFromArray: function(array, separator, finisher, and)
	 {
		 var clean_array = [];
		 array.forEach(function(el){
			 if(el != ""){
				 clean_array.push(el);
			 }
		 });
		 
		 if(clean_array.length == 0) return "";
		 if(clean_array.length == 1 && finisher !== undefined) return clean_array[0].trim() + "" + finisher;
		 if(clean_array.length == 1 && finisher === undefined) return clean_array[0].trim();
		 var constructed_string = ""; //the string to be returned:
		 var s = 0;
		 for(s = 0; s < clean_array.length; s++) //for every element of the array:
		 {
			 if(s == 0) constructed_string = clean_array[s];
			 if(s != 0 && s != clean_array.length - 1)
			 {
				 constructed_string += separator + "" + clean_array[s];
			 }
			 if(s != 0 && s == clean_array.length - 1 && and == false)
			 {
				 constructed_string += separator + "" + clean_array[s];
			 }
			 if(s != 0 && s == clean_array.length - 1 && and == true)
			 {
				 constructed_string += " and " + clean_array[s];
			 }
		 }
		 if(finisher !== undefined)
		 {
			 constructed_string += finisher;
		 }
		 return constructed_string;
	 },
		 getBrowserTypeAndVersion: function()
		 {
			 var browser = {browser_type: undefined, browser_version: undefined};
             //test for Firefox/x.x or Firefox x.x (ignoring remaining digits);
			 if (/Firefox[\/\s](\d+\.\d+)/.test(navigator.userAgent))
			 { 
				 var firefox_version = new Number(RegExp.$1);
				 browser.browser_type = "Firefox";
				 browser.browser_version = firefox_version;
			 }
			 
			 //test for IE
			 var detectIEregexp = undefined;
			 if(navigator.userAgent.indexOf('MSIE') != -1)
			 {
				 detectIEregexp = /MSIE (\d+\.\d+);/ //test for MSIE x.x
			 }
			 else // if no "MSIE" string in userAgent
			 {
				 detectIEregexp = /Trident.*rv[ :]*(\d+\.\d+)/ //test for rv:x.x or rv x.x where Trident string exists
			 }

			 if(detectIEregexp.test(navigator.userAgent))//if some form of IE
			 { 
				 var ie_version = new Number(RegExp.$1) // capture x.x portion and store as a number
				 browser.browser_type = "IE";
				 browser.browser_version = ie_version;
			 }

			 //test for chrome:
			 if (/Chrome[\/\s](\d+\.\d+)/.test(navigator.userAgent))
			 { 
				 var chrome_version = new Number(RegExp.$1);
				 browser.browser_type = "Chrome";
				 browser.browser_version = chrome_version;
			 }
			 return browser;
		 },

		 showincorrectEntryMessage: function(el, message)
		 {
			 $(".incorrect_input_entry").remove();
			 var message_view = "<div class='incorrect_input_entry'>";
			 message_view += "<span class='incorrect_input_entry_message'>" + message + "</span>";
			 message_view += "</div>";
			 $(el).after(message_view);
			 var w = $(el).outerWidth() + "px";
			 $(".incorrect_input_entry").css("width", w);
		 },
		 
		 constructFileDisplay: function(file_path, locked)
		 {
			 var file_path_info = this.getFilePathInfo(file_path);
			 var attached_file = "<div class='file_display'>";
			 if(locked != undefined && locked == true) attached_file += "<div class='file_display_cover'>&nbsp;</div>";
			 switch(file_path_info.file_type)
		     {
				 case "video":
					 attached_file += "<video src='" + file_path + "' controls></video>";
				 case "image":
					 attached_file += "<img src='" + file_path + "'>";
				 break;
				 case "pdf":
					 attached_file += "<object data='" + file_path + "' type='application/pdf' height='550px' width='100%'>";
					 attached_file += "<embed src='" + file_path + "'>";
					 attached_file += "This browser does not support PDFs. Please download the PDF to view it: <a href='" + file_path + "'>Download PDF</a>.</p>";
					 attached_file += "</embed>";
					 attached_file += "</object>";
				 break;
				 case "code":
				     attached_file += "<div class='class_dir_empty'><span class='fa fa-info-circle'></span>&nbsp;Oops! This file failed to open for one reason or another. You can download this file instead if its available for download.</div>";
				 break;
		     }
			 attached_file += "</div>";
			 return attached_file;
		 },
		 
		 addButtonsToAsidePopup: function(where, button_settings, hide_pagination)
		 {
			 var buttons = "";
			 button_settings.forEach(function(but){
				 buttons += "<button type='button' class='" + but.class + "' id='" + but.id + "'>" + but.text + "</button>";
			 });
			 console.log(button_settings);
			 $("#" + where).empty().append(buttons);
			 if(hide_pagination == true) $("#" + where).prev().hide();
		 },

		 ucwords: function(string, separator)
		 {
			 separator = separator !== null && separator !== undefined ? separator : " ";
			 var string_array = string.split(separator);
			 var new_string_array = [];
			 string_array.forEach(function(s)
			 {
				 var first_letter = s.charAt(0).toUpperCase();
				 var other_letters = s.substring(1);
				 var new_word = first_letter + other_letters;
				 new_string_array.push(new_word);
			 });
			 return new_string_array.join(separator);
		 },
		 
		 checkUserInput: function(inputElements)
		 {
			 var inputObject = {allInputProvided:true};
			 inputElements.forEach(function(element)
			 {
				 element.elementId = element.elementId.indexOf("#") !== -1 ? element.elementId : "#" + element.elementId;
				 var elementValue = $(element.elementId).val().trim();
				 inputObject.allInputProvided = (element.valueRequired && (elementValue !== "" && elementValue !== null && elementValue !== undefined)) || !element.valueRequired ? true : false;
			     elementValue = !element.valueRequired && (elementValue == "" && elementValue == null && elementValue == undefined) ? element.defaultValue : elementValue;
			     inputObject[element.associatedVariableName] = elementValue;
			 });
			 return inputObject;
		 },

		 showToast: function(message, type = 'success', duration = 5000) {
			  const container = document.getElementById('toast-container');

			  const toast = document.createElement('div');
			  toast.className = `toast ${type}`;
			  toast.innerHTML = `
			    <span>${message}</span>
			    <span class="close-btn" onclick="this.parentElement.remove()">×</span>
			  `;

			  container.appendChild(toast);

			  setTimeout(() => {
			    toast.remove();
			  }, duration);
	      },

	      generateBrowserFingerprint: function(){
	      	 const navigatorInfo = [
			      navigator.userAgent,
			      navigator.language,
			      navigator.platform,
			      navigator.hardwareConcurrency,
			      navigator.deviceMemory,
			      screen.colorDepth,
			      screen.width,
			      screen.height,
			      new Date().getTimezoneOffset()
			 ].join('::');
                return this.hashString(navigatorInfo);
	      },

	      hashString: function(str){
	      	 let hash = 0;
			 if (str.length === 0) return hash.toString();
			 for (let i = 0; i < str.length; i++) {
			      const chr = str.charCodeAt(i);
			      hash = (hash << 5) - hash + chr;
			      hash |= 0; // Convert to 32bit integer
			 }
			 return hash.toString();
	      },
		 	 
		 getPopupCoordinates: function(referenceElementId, popupElementId)
		 {
			 var referenceElement = document.getElementById(referenceElementId);
			 var referenceElementRect = referenceElement.getBoundingClientRect();
			 var bottomSpace = window.innerHeight - referenceElementRect.bottom;
			 var rightSpace = window.innerWidth - referenceElementRect.right;
			 var leftSpace = referenceElementRect.left;
			 var topSpace = referenceElementRect.top;
			 //if the popup element is not already showing, display it and position it absolutely
			 //with a negative z-index.
			 $(popupElementId).show();
			 $(popupElementId).css({"position": "absolute", "z-index": "-100000"});
			 var popupElementWidth = $(popupElementId).outerWidth();
			 var popupElementHeight = $(popupElementId).outerHeight();
			 
			 var isRightSpaceAvailable = rightSpace > popupElementWidth ? true : false;
			 var isBottomSpaceAvailable = bottomSpace > popupElementHeight ? true : false;
			 var isLeftSpaceAvailable = leftSpace > popupElementWidth ? true : false;
			 var isTopSpaceAvailable = topSpace > popupElementHeight ? true : false;
			 
			 var offsetTop = 0;
			 var offsetLeft = 0;
			 if(isBottomSpaceAvailable)
			 {
				 if(popupElementWidth > referenceElementRect.width)
				 {
					 if(isLeftSpaceAvailable)
			         {
						 offsetLeft = referenceElementRect.x - (popupElementWidth - referenceElementRect.width);
						 offsetTop = referenceElementRect.y + referenceElementRect.height;
					 }
					 else if(isRightSpaceAvailable)
					 {
						 offsetLeft = referenceElementRect.x - (popupElementWidth - referenceElementRect.width);
						 offsetTop = referenceElementRect.y + referenceElementRect.height;
					 }
					 else
					 {
						 
					 }
				 }
				 else
				 {
					 offsetTop = referenceElementRect.y + referenceElementRect.height;
			         offsetLeft = referenceElementRect.x;
				 }
			 }
			 else if(isRightSpaceAvailable)
			 {
				 if(isTopSpaceAvailable)
			     {
					 offsetLeft = referenceElementRect.x + referenceElementRect.width;
					 offsetTop = referenceElementRect.bottom - popupElementHeight;
				 }
			 }
			 else if(isTopSpaceAvailable)
			 {
				 if(isLeftSpaceAvailable)
			     {
					 offsetTop = referenceElementRect.bottom - (popupElementHeight + referenceElementRect.height);
					 offsetLeft = popupElementWidth > referenceElementRect.width ? referenceElementRect.x - (popupElementWidth - referenceElementRect.width): referenceElementRect.x;
				 }
			 }
		     return {top: offsetTop - document.querySelector("body").getBoundingClientRect().top, left: offsetLeft};
		 }
	 };
})();
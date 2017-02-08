import {Injectable} from '@angular/core';
import { Http, Headers, RequestOptions } from '@angular/http';
import { AppSettings } from './app-settings';
import {UserData} from './user-data';
import {Network} from 'ionic-native';
import 'rxjs/add/operator/map';


/*
drill
{
	id: 1,
	title: "Beenzwaai op plaats, met hang naar voren",
	description: "Zwaaibeweging been op de plaats. Evenwicht houden. Daarna stilhangen lichaam naar voren 1 been achter",
	tags: [ "warming up", "core" ],
	locations: [ "circle" ],
	media: [ 'beenzwaai-1.jpg', 'picture1.jpg'],
	musclegroups: [ "rug", "quadricepts"],
}

*/
@Injectable()
export class DrillData {
	private drills: Drill[];
	public drill: Drill;
	private trainingSessions: TrainingSession[];
	public trainingSession: TrainingSession;
	private sessionData: any;
	private http: Http;
	private userData: UserData;
	private errorMessage: string;
	private drillFilters: any[];
	public isConnected: boolean;
	public settings: any;
	public timesPerDistance: any[];
	public defaultImg:string;

	public reloadVideo: boolean=false;

	private drillIdx:number = 0;

	static get parameters(){

		return [[Http],[UserData]];
	}	
	constructor(http: Http, userData: UserData) {
		this.isConnected = true;
		if (Network.connection == "none") {
			this.isConnected = false;
		}
		this.http = http;
		this.userData = userData;
    	this.errorMessage = '';
    	this.defaultImg =AppSettings.defaultImg;


    	this.initSettings();
    	this.initDrillFilters();
    	//this.settings.tenTimeSecs = 2500;

	}

	private handleError (error: any) {
		// In a real world app, we might use a remote logging infrastructure
		// We'd also dig deeper into the error to get a better message
		let errMsg = (error.message) ? error.message :
		  error.status ? `${error.status} - ${error.statusText}` : 'Server error';
		console.error(errMsg); // log to console instead
		this.errorMessage = 'Server error';
		return Promise.reject(errMsg);
	}

	changeTimeTen(timeSecsTen) {
		if (timeSecsTen) {
			this.settings.tenTime = timeSecsTen;
			this.settings.fiveTime = '';
			this.settings.halfTime = '';
			this.calcTimesPerDistance();
		} 

	}
	changeTimeFive(timeSecsFive) {
		if (timeSecsFive) {
			this.settings.tenTime = '';
			this.settings.fiveTime = timeSecsFive;
			this.settings.halfTime = '';
			this.calcTimesPerDistance();
		} 
	}	

	getDropDownIntervalsForTen() {
		let result = [];
		for ( var i=33; i<70; i++) {
				result.push(i+":00");
				result.push(i+":30");
		}
		return result;
	}

	getDropDownIntervalsForFive() {
		let result = [];
		for ( var i=16; i<35; i++) {
				result.push(i+":00");
				result.push(i+":30");
		}
		return result;
	}
	getTrainingSessions() {
		//console.log("getTrainingSessions...");
		return this.http.get(AppSettings.BASE_API_URL + "/trainingsessions", this.getRequestOptions()).map(res => {
		    let result = res.json();
			if (result.status === false) {
				this.errorMessage = result.message;
				return this.trainingSessions;
			} else {
				this.trainingSessions = result.data;
				console.debug("getTrainingSessions:",this.trainingSessions);
				localStorage.setItem("trainingSessions", JSON.stringify(this.trainingSessions));
				this.filterOnUserGroups();
				return this.trainingSessions;
			}		    
		});
	}

	filterOnUserGroups() {
		let runningGroups = this.userData.getRunningGroups();
		for(var i = 0; i < this.trainingSessions.length; i++) {
			this.trainingSessions[i].show = false;
			if (this.trainingSessions[i].userGroupName == "alle") {
				this.trainingSessions[i].show = true;
			} else {
				for (let j in runningGroups) {
					if (runningGroups[j].name == this.trainingSessions[i].userGroupName && runningGroups[j].value===true) {
						this.trainingSessions[i].show = true;
					}
				}
			}
		}
	}

	getCachedSessions() {
		let localTrainingsSession = localStorage.getItem("trainingSessions");
		if (localTrainingsSession !== null) {
			this.trainingSessions = JSON.parse(localTrainingsSession);
		}
		//console.debug("getCachedSessions",localTrainingsSession);
		return this.trainingSessions;
	}

	initSettings() {
		let localSettings = localStorage.getItem("settings");
		if (localSettings ==  null) {
			this.settings = { showSummary: false, fiveTime: "", tenTime: "", halfTime:"", setTenTime:true };
			localStorage.setItem("settings", JSON.stringify(this.settings));
		} else {
			this.settings = JSON.parse(localSettings);
		}	
		//console.debug("Init Settings:",this.settings);

		this.calcTimesPerDistance();
	}

	initDrillFilters() {
		let localDrillFilter = localStorage.getItem("drillFilters");
		if (localDrillFilter ==  null) {
			this.drillFilters = [ 
		      {title: "Warming up", value: true},
		      {title: "Core stability", value: true},
		      {title: "Loopscholing", value: true},
		      {title: "Kern", value: true},
		      {title: "Cooling down", value: true},
	   		];

			localStorage.setItem("drillFilters", JSON.stringify(this.drillFilters));
		} else {
			this.drillFilters = JSON.parse(localDrillFilter);
		}
	}

	public getDrillFilters(){
		return this.drillFilters;

	}
	
	public toggleDrillFilter(idx) {
    	this.drillFilters[idx].value = (!this.drillFilters[idx].value);
    	localStorage.setItem("drillFilters", JSON.stringify(this.drillFilters));
 	}
	public toggleSetting(name) {
    	this.settings[name] = (!this.settings[name]);
    	localStorage.setItem("settings", JSON.stringify(this.settings));
 	}

 	public storeSettings() {
 		this.validateSettings();
 		localStorage.setItem("settings", JSON.stringify(this.settings));
 	}

 	private validateSettings() {

 		if (this.settings.fiveTime) {
 			this.settings.fiveTime = this.settings.fiveTime.replace(/\D/g,':');

 		}
 		if (this.settings.tenTime) {
 			this.settings.tenTime = this.settings.tenTime.replace(/\D/g,':');
 		 	if (this.settings.tenTime.indexOf("00:")==0){
 				this.settings.tenTime = this.settings.tenTime.substring(3);
 			}

 		} 		
		if (this.settings.halfTime) {
 			this.settings.halfTime = this.settings.halfTime.replace(/\D/g,':');
 		} 		
 	}

 	public getTimeForDistance(distance:number, speedRef:string) {
 		let result = 0;
 		for (let i in this.timesPerDistance) {
 //console.log("loop:"+this.timesPerDistance[i].distance);
 			if (this.timesPerDistance[i].distanceMeters == distance) {
 //console.log("found dist:"+ distance+":"+speedRef);
 				if (speedRef=='5') {
 					result = this.timeToSeconds(this.timesPerDistance[i].timeFive);
 					break;
 				} else if (speedRef=='10') {
 					result = this.timeToSeconds(this.timesPerDistance[i].timeTen);
 					break;
 				} else if (speedRef=='21') {
 					result = this.timeToSeconds(this.timesPerDistance[i].timeHalf);
 					break;
 				} else if (speedRef=='i') {
 					result = this.timeToSeconds(this.timesPerDistance[i].timeInt);
 					break;
 				} else if (speedRef=='x') {
 					result = this.timeToSeconds(this.timesPerDistance[i].timeExt);
 					break;
 				}			
 			}
 		}
//console.log("result:"+result); 		
 		return result;
 	}

	parseTime(time: string) {
		let len = time.length;
		var i;

		if (len == 4 && parseInt(time[2]) >= 0) {
			time = time.substring(0, 2) + ":" + time.substring(2, 7);
			len++;
		} 
		if (len == 7) {
			if (time[0] != '0') {
				time = '0'+time;
				len++;
			}
			if (parseInt(time[5]) >= 0) {
				time = time.substring(0, 5) + ":" + time.substring(5, 7);
				len++;
			}
		} 
		let result = time;
		for (i=0; i < len; i++) {
  			if (i != 2 && i != 5) {
  				if (parseInt(time[i]) >= 0) {
  					console.log("parsed("+i+"):"+time[i]);
  				} else {
  					console.log("not parsed("+i+"):"+time[i]);
  					break;
  				}
  			}
		}

		if (i==2) {
			result += ":";
			i++;
		}
		result = result.replace(".",":");

		return result.substring(0, i);
	} 	

 	public calcTimesPerDistance() {
 		let distances = [ 100, 200, 300, 400, 500, 600, 700, 800, 900, 1000, 1200, 1500, 2000, 3000];

 		this.timesPerDistance = [];
 		let timeSecsFive = this.timeToSeconds(this.settings.fiveTime);
 		let timeSecsTen = this.timeToSeconds(this.settings.tenTime);
 		let timeSecsHalf = this.timeToSeconds(this.settings.halfTime);
console.log("timeSecsFive:"+timeSecsFive);
console.log("timeSecsTen:"+timeSecsTen);
console.log("timeSecsHalf:"+timeSecsHalf);

console.log("tempos 5k:"+AppSettings.tempos['wds']['5k']);
console.log("tempos 10k:"+AppSettings.tempos['wds']['10k']);
console.log("tempos 21k:"+AppSettings.tempos['wds']['21k']);
console.debug("1:"+AppSettings.tempos['wds']['10k']/AppSettings.tempos['wds']['5k']);
console.debug("2:"+Math.floor(AppSettings.tempos['wds']['10k']/AppSettings.tempos['wds']['5k']));

	 	if (timeSecsFive > 0 && timeSecsTen == 0) {
	 		//timeSecsTen = Math.floor(timeSecsFive*2.085);
	 		timeSecsTen = Math.floor(timeSecsFive*(AppSettings.tempos['wds']['10k']/AppSettings.tempos['wds']['5k']));
	 		this.settings.tenTime = this.secondsToTime(timeSecsTen);
		}	
	 	if (timeSecsTen > 0 && timeSecsHalf == 0) {
	 		//timeSecsHalf = Math.floor(timeSecsTen*2.20625);
	 		timeSecsHalf = Math.floor(timeSecsTen * (AppSettings.tempos['wds']['21k']/AppSettings.tempos['wds']['10k']));
	 		this.settings.halfTime = this.secondsToTime(timeSecsHalf);
		}	
	 	if (timeSecsTen > 0 && timeSecsFive == 0) {
	 		//timeSecsFive = Math.floor(timeSecsTen/2.085);
	 		timeSecsFive = Math.floor(timeSecsTen * (AppSettings.tempos['wds']['5k']/AppSettings.tempos['wds']['10k']));
	 		this.settings.fiveTime = this.secondsToTime(timeSecsFive);
		}		
console.log("timeSecsFive-:"+timeSecsFive);
console.log("timeSecsTen-:"+timeSecsTen);
console.log("timeSecsHalf-:"+timeSecsHalf);
console.debug("tempos:",AppSettings.tempos);
		let baseInt = timeSecsTen/10;
		for (let i = 0; i < distances.length; i++) { 
			let distance =  distances[i];
			let timeStrFive = this.secondsToTime(Math.floor((distance/5000)*timeSecsFive));
			let timeStrTen = this.secondsToTime(Math.floor((distance/10000)*timeSecsTen));
			let timeStrHalf = this.secondsToTime(Math.floor((distance/21100)*timeSecsHalf)); 
			let timeStrInt = '';
			if (typeof AppSettings.tempos['int'][distance+'m'] !== "undefined") {
				timeStrInt = this.secondsToTime(Math.floor(baseInt*AppSettings.tempos['int'][distance+'m']));
			}
			let timeStrExt = '';
			if (typeof AppSettings.tempos['ext'][distance+'m'] !== "undefined") {
				timeStrExt = this.secondsToTime(Math.floor(baseInt*AppSettings.tempos['ext'][distance+'m']));
			}			
			this.timesPerDistance.push({ distanceMeters: distance, distance: distance + "", timeFive: timeStrFive
				, timeTen: timeStrTen, timeHalf:timeStrHalf, timeInt:timeStrInt, timeExt:timeStrExt});
		}

 	}

 	private timeToSeconds(timeStr: string) {
 		// time to seconds
 		let timeSecs = 0;
 		if (timeStr.indexOf(":")) {
 			if (timeStr.length == 5) {
 				timeStr = "00:" + timeStr;
 			}
	 		let arr = timeStr.split(":");
	 		if (arr.length === 3) {
				let hours = parseInt(arr[0]);
				let minutes = parseInt(arr[1]);
				let seconds = parseInt(arr[2]);
				
				if (!(isNaN(hours) || isNaN(minutes) || isNaN(seconds))) {
					timeSecs = hours*3600 + minutes*60 + seconds;
				}
				
	 		}
 		}
 		return timeSecs;
 	}

 	private secondsToTime(timeSecs: number) {
	    let hours   = Math.floor(timeSecs / 3600);
	    let minutes = Math.floor((timeSecs - (hours * 3600)) / 60);
	    let seconds = timeSecs - (hours * 3600) - (minutes * 60);

	    let strHours = ""+hours;
	    let strMinutes = ""+minutes;
	    let strSeconds = ""+seconds;

	    if (hours   < 10) {strHours   = "0"+hours;}
	    if (minutes < 10) {strMinutes = "0"+minutes;}
	    if (seconds < 10) {strSeconds = "0"+seconds;}
	    if (hours > 0){
		    return strHours+":"+strMinutes+':'+strSeconds; 		

	    } else {

		    return strMinutes+':'+strSeconds; 		
	    }
 	}

	private getRequestOptions() {
		let headers = new Headers();
		
		//headers.append('Content-Type', 'application/json');
    	return new RequestOptions({ headers: headers });
	}

 	public setCurrentTrainingSession(trainingSession: TrainingSession) {
 		this.trainingSession = trainingSession;
 	}
 	public setCurrentTrainingDrill(drill: Drill) {
 		this.drill = drill;
 		//this.drillIdx = drillIdx;
 	}

	public hasNextTrainingsDrill() {
		return this.trainingSession.drills.length > (this.drillIdx+1) && (this.drillIdx+1)>=0;
	}
	public hasPrevTrainingsDrill() {
		return this.trainingSession.drills.length > (this.drillIdx-1) && (this.drillIdx-1)>=0;
	}
}

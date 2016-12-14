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

    	this.initSettings();
    	this.initDrillFilters();
    	

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


	getTrainingSessions() {
		console.log("getTrainingSessions...");
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
		console.debug("getCachedSessions",localTrainingsSession);
		return this.trainingSessions;
	}

	initSettings() {
		let localSettings = localStorage.getItem("settings");
		if (localSettings ==  null) {
			this.settings = { showSummary: false, fiveTime: "", tenTime: "", halfTime:"" };
			localStorage.setItem("settings", JSON.stringify(this.settings));
		} else {
			this.settings = JSON.parse(localSettings);
		}	
		console.debug("Init Settings:",this.settings);

		this.calcTimesPerDistance();
	}

	initDrillFilters() {
		let localDrillFilter = localStorage.getItem("drillFilters");
		if (localDrillFilter ==  null) {
			this.drillFilters = [ 
		      {title: "Inleiding", value: true},
		      {title: "Warming up", value: true},
		      {title: "Core Stability", value: true},
		      {title: "Kring", value: true},
		      {title: "Vierkant", value: true},
		      {title: "400m Baan", value: true},
		      {title: "Loopscholing", value: true},
		      {title: "Tussenprogramma", value: true},
		      {title: "Hoofdprogramma", value: true},
		      {title: "Cooling down", value: true},
		      {title: "Overig", value: true}
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

 	public setCurrentTrainingSession(trainingSession: TrainingSession) {
 		this.trainingSession = trainingSession;
 	}
 	public setCurrentTrainingDrill(drill: Drill) {
 		this.drill = drill;
 	}

 	public getTimeForDistance(distance:number, speedRef:string) {
 		let result = 0;
 		for (let i in this.timesPerDistance) {
 console.log("loop:"+this.timesPerDistance[i].distance);
 			if (this.timesPerDistance[i].distanceMeters == distance) {
 console.log("found dist:"+ distance+":"+speedRef);
 				if (speedRef=='5') {
 					result = this.timeToSeconds(this.timesPerDistance[i].timeFive);
 					break;
 				} else if (speedRef=='10') {
 					result = this.timeToSeconds(this.timesPerDistance[i].timeTen);
 					break;
 				} else if (speedRef=='21') {
 					result = this.timeToSeconds(this.timesPerDistance[i].timeHalf);
 					break;
 				} 				
 			}
 		}
console.log("result:"+result); 		
 		return result;
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
	 	if (timeSecsFive > 0 && timeSecsTen == 0) {
	 		timeSecsTen = Math.floor(timeSecsFive*2.085);
	 		this.settings.tenTime = this.secondsToTime(timeSecsTen);
		}	
	 	if (timeSecsTen > 0 && timeSecsHalf == 0) {
	 		timeSecsHalf = Math.floor(timeSecsTen*2.20625);
	 		this.settings.halfTime = this.secondsToTime(timeSecsHalf);
		}	
console.log("timeSecsFive-:"+timeSecsFive);
console.log("timeSecsTen-:"+timeSecsTen);
console.log("timeSecsHalf-:"+timeSecsHalf);

		for (let i = 0; i < distances.length; i++) { 
			let distance =  distances[i];
			let timeStrFive = this.secondsToTime(Math.floor((distance/5000)*timeSecsFive));
			let timeStrTen = this.secondsToTime(Math.floor((distance/10000)*timeSecsTen));
			let timeStrHalf = this.secondsToTime(Math.floor((distance/21100)*timeSecsHalf));
			this.timesPerDistance.push({ distanceMeters: distance, distance: distance + " meter", timeFive: timeStrFive, timeTen: timeStrTen, timeHalf:timeStrHalf});
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

}

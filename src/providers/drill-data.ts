import {Injectable} from '@angular/core';
import { Http, Headers, RequestOptions } from '@angular/http';
import { AppSettings } from './app-settings';
import {UserData} from './user-data';
import {Network} from '@ionic-native/network';
import { LoadingController } from 'ionic-angular';
import 'rxjs/add/operator/map';
import {Observable} from "rxjs/Rx";


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
	public drill: Drill;
	public trainingSessions: TrainingSession[];
	public trainingSession: TrainingSession;
	private http: Http;
	private userData: UserData;
	private errorMessage: string;
	private drillFilters: any[];
	public isConnected: boolean;
	public settings: any;
	public timesPerDistance: any[];
	public defaultImg:string;
	public coreStretchDrills: TrainingSession;
	public loopscholingDrills: TrainingSession;
	public kernDrills: TrainingSession;
	public athleteTimes: any;
	public intervalPauzes: any;

	public intervalSettings:any;

	public reloadVideo: boolean=false;

	private drillIdx:number = 0;
	private network: Network;
	private loader: any;

	public menuItemColors = [ "pastelorange","pastelred","pastelgreen", "pastelcafenoir" ];

	static get parameters(){

		return [[Http],[UserData], [LoadingController]];
	}	
	constructor(http: Http, userData: UserData, public loadingCtrl: LoadingController) {
		this.network = new Network();
		this.isConnected = true;
		if (this.network.type == "none") {
			this.isConnected = false;
		}
		this.http = http;
		this.userData = userData;
    	this.errorMessage = '';
    	this.defaultImg =AppSettings.defaultImg;

    	this.intervalSettings = { distances: [ 100, 200, 300, 400, 500, 600, 700, 800, 1000, 1200, 1500], 
		pacebaceBaseDistance: "10K", intervalPace: "Ext.", intervalDistance: 400, allIntervalTimes: { 	"5K": { "5K": {},"10K": {}, "H.Mar.": {}, "Int.": {}, "Ext.": {}},
									"10K": { "5K": {},"10K": {}, "H.Mar.": {}, "Int.": {}, "Ext.": {}}}};

    	this.initSettings();
    	this.initDrillFilters();
	}

/*	private handleError (error: any) {
		// In a real world app, we might use a remote logging infrastructure
		// We'd also dig deeper into the error to get a better message
		let errMsg = (error.message) ? error.message :
		  error.status ? `${error.status} - ${error.statusText}` : 'Server error';
		console.error(errMsg); // log to console instead
		this.errorMessage = 'Server error';
		return Promise.reject(errMsg);
	}*/

	changeTimeTen(timeSecsTen: string) {
		if (timeSecsTen) {
			this.settings.tenTime = timeSecsTen;
			this.settings.fiveTime = '';
			this.settings.halfTime = '';
			this.calcTimesPerDistanceForSettings();
		} 

	}
	changeTimeFive(timeSecsFive: string) {
		if (timeSecsFive) {
			this.settings.tenTime = '';
			this.settings.fiveTime = timeSecsFive;
			this.settings.halfTime = '';
			this.calcTimesPerDistanceForSettings();
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

	getAthleteTimes() {
		console.log("athleteTimes...");
		return this.http.get(AppSettings.BASE_API_URL + "/athletetimes/", this.getRequestOptions()).map(res => {
		    let result = res.json();
			if (result.status === false) {
				this.errorMessage = result.message;
				return this.athleteTimes;
			} else {
				return result.data;
			}		    
		});
	}

	getIntervalTimes() {
		console.log("getIntervalTimes...");
		return this.http.get(AppSettings.BASE_API_URL + "/intervaltimes/", this.getRequestOptions()).map(res => {
		    let result = res.json();
   			this.athleteTimes = result.data['athleteTimes'];
			this.intervalPauzes = result.data['intervalPauzes'];
			localStorage.setItem("athleteTimes", JSON.stringify(this.athleteTimes));
			localStorage.setItem("intervalPauzes", JSON.stringify(this.intervalPauzes));
			return result.data;
		    
		});
	}	

	getTrainingSessions() {
		//console.log("getTrainingSessions...");
		return this.http.get(AppSettings.BASE_API_URL + "/trainingsessions/", this.getRequestOptions()).map(res => {
		    let result = res.json();
			if (result.status === false) {
				this.errorMessage = result.message;
				return this.trainingSessions;
			} else {
				this.trainingSessions = result.data;
				localStorage.setItem("trainingSessions", JSON.stringify(this.trainingSessions));
				this.filterOnUserGroups();
				return this.trainingSessions;
			}		    
		});
	}

	getCategoryDrills(cat: number) {
		return this.http.get(AppSettings.BASE_API_URL + "/drillsforcategory/"+cat, this.getRequestOptions()).map(res => {
		    let result = res.json();
			if (result.status === false) {
				this.errorMessage = result.message;
				return false;
			} else {
				console.debug("getCategoryDrills:",result.data);
				if (cat == 2) {
					this.coreStretchDrills = result.data;
					localStorage.setItem("coreStretchDrills", JSON.stringify(result.data));
				} else if (cat == 3) {
					this.loopscholingDrills = result.data;
					localStorage.setItem("loopscholingDrills", JSON.stringify(result.data));
				} else if (cat == 4) {
					this.kernDrills = result.data;
					localStorage.setItem("kernDrills", JSON.stringify(result.data));
				}
				return result.data;
			}		    
		});

	}

	filterOnUserGroups() {
		let runningGroups = this.userData.getRunningGroups();
		if (typeof this.trainingSessions !== "undefined") {

			for(var i = 0; i < this.trainingSessions.length; i++) {
				this.trainingSessions[i].show = false;
				if (this.trainingSessions[i].userGroupName == "alle") {
					this.trainingSessions[i].show = true;
				} else {
					for (let j in runningGroups) {
						console.log("name:"+runningGroups[j].name);
						if (runningGroups[j].name == this.trainingSessions[i].userGroupName && runningGroups[j].value===true) {
							this.trainingSessions[i].show = true;
						}
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

		//this.calcTimesPerDistanceForSettings();
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

	initData() {

		if (this.isConnected) {
			console.log("Is connected, get data from server...");
			this.presentLoading("Loading data...");
			Observable.zip(
				this.getTrainingSessions(),
				this.getIntervalTimes(),
				this.getCategoryDrills(2),
				this.getCategoryDrills(3),
				this.getCategoryDrills(4)
			).subscribe(() => {
				this.calcAllIntervalTimes();
				console.log("Init data, all done");
				this.loader.dismiss();

			});
	    } else {
	    	console.log("Is NOT connected, get cached data...");
			this.trainingSessions = JSON.parse(localStorage.getItem("trainingSessions"));
			this.athleteTimes = JSON.parse(localStorage.getItem("athleteTimes"));
			this.intervalPauzes = JSON.parse(localStorage.getItem("intervalPauzes"));	
			this.coreStretchDrills = JSON.parse(localStorage.getItem("coreStretchDrills"));	
			this.loopscholingDrills = JSON.parse(localStorage.getItem("loopscholingDrills"));	
			this.kernDrills = JSON.parse(localStorage.getItem("kernDrills"));
			this.calcAllIntervalTimes();
	    }
	}

	public getDrillFilters(){
		return this.drillFilters;

	}
	
	public toggleDrillFilter(idx: number) {
    	this.drillFilters[idx].value = (!this.drillFilters[idx].value);
    	localStorage.setItem("drillFilters", JSON.stringify(this.drillFilters));
 	}
	public toggleSetting(name: string) {
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

	public calcAllIntervalTimes() {

		if (localStorage.getItem("IntervalSettings") != null) {
			this.intervalSettings = JSON.parse(localStorage.getItem("IntervalSettings"));
		}

console.debug("calcAllIntervalTimes()",AppSettings.tempos)
		let intervalsForFive = this.getDropDownIntervalsForFive();
		let intervalsForTen = this.getDropDownIntervalsForTen();

		for (let i = 0; i < this.intervalSettings.distances.length; i++) {
			let distance = this.intervalSettings.distances[i];
			this.intervalSettings.allIntervalTimes["5K"]["5K"][distance] = [];
			this.intervalSettings.allIntervalTimes["5K"]["10K"][distance] = [];
			this.intervalSettings.allIntervalTimes["5K"]["H.Mar."][distance] = [];
			this.intervalSettings.allIntervalTimes["5K"]["Int."][distance] = [];
			this.intervalSettings.allIntervalTimes["5K"]["Ext."][distance] = [];
			for (let k=0; k<intervalsForFive.length; k++){
				let timeSecsFive = this.timeToSeconds(intervalsForFive[k]);
				let timePerDistance:any = this.calcTimesPerDistance(timeSecsFive, 0, 0, distance);
				this.intervalSettings.allIntervalTimes["5K"]["5K"][distance].push({pace: intervalsForFive[k], time: timePerDistance.timeFive});
				this.intervalSettings.allIntervalTimes["5K"]["10K"][distance].push({pace: intervalsForFive[k], time: timePerDistance.timeTen});
				this.intervalSettings.allIntervalTimes["5K"]["H.Mar."][distance].push({pace: intervalsForFive[k], time: timePerDistance.timeHalf});
				this.intervalSettings.allIntervalTimes["5K"]["Int."][distance].push({pace: intervalsForFive[k], time: timePerDistance.timeInt});
				this.intervalSettings.allIntervalTimes["5K"]["Ext."][distance].push({pace: intervalsForFive[k], time: timePerDistance.timeExt});
			}
		}

		for (let i = 0; i < this.intervalSettings.distances.length; i++) {
			let distance = this.intervalSettings.distances[i];
			this.intervalSettings.allIntervalTimes["10K"]["5K"][distance] = [];
			this.intervalSettings.allIntervalTimes["10K"]["10K"][distance] = [];
			this.intervalSettings.allIntervalTimes["10K"]["H.Mar."][distance] = [];
			this.intervalSettings.allIntervalTimes["10K"]["Int."][distance] = [];
			this.intervalSettings.allIntervalTimes["10K"]["Ext."][distance] = [];
			for (let k=0; k<intervalsForTen.length; k++){
				let timeSecsTen = this.timeToSeconds(intervalsForTen[k]);
				let timePerDistance:any = this.calcTimesPerDistance(0, timeSecsTen, 0, distance);
				this.intervalSettings.allIntervalTimes["10K"]["5K"][distance].push({pace: intervalsForTen[k], time: timePerDistance.timeFive});
				this.intervalSettings.allIntervalTimes["10K"]["10K"][distance].push({pace: intervalsForTen[k], time: timePerDistance.timeTen});
				this.intervalSettings.allIntervalTimes["10K"]["H.Mar."][distance].push({pace: intervalsForTen[k], time: timePerDistance.timeHalf});
				this.intervalSettings.allIntervalTimes["10K"]["Int."][distance].push({pace: intervalsForTen[k], time: timePerDistance.timeInt});
				this.intervalSettings.allIntervalTimes["10K"]["Ext."][distance].push({pace: intervalsForTen[k], time: timePerDistance.timeExt});
			}
		}
		this.storeIntervalSettings();

		console.debug("calcAllIntervalTimes:", this.intervalSettings.allIntervalTimes);
	
		

		/*
		arr['10K']['int'][100][0]['pace'] = ...
		arr['10K']['int'][100][0]['time'] = ...

		*/
	}

	public storeIntervalSettings() {
		//localStorage.setItem("IntervalSettings",JSON.stringify(this.intervalSettings));
	}


 	public calcTimesPerDistanceForSettings() {
 		

 		this.timesPerDistance = [];
 		let timeSecsFive = this.timeToSeconds(this.settings.fiveTime);
 		let timeSecsTen = this.timeToSeconds(this.settings.tenTime);
 		let timeSecsHalf = this.timeToSeconds(this.settings.halfTime);

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
		for (let i = 0; i < this.intervalSettings.distances.length; i++) { 
			this.timesPerDistance.push(this.calcTimesPerDistance(timeSecsFive, timeSecsTen, timeSecsHalf, this.intervalSettings.distances[i]));
		}
	}

 	public calcTimesPerDistance(timeSecsFive: number, timeSecsTen: number, timeSecsHalf: number, distance:number) {

	 	if (timeSecsTen == 0) {
	 		timeSecsTen = Math.floor(timeSecsFive*(AppSettings.tempos['wds']['10k']/AppSettings.tempos['wds']['5k']));
		} else {
			timeSecsFive = Math.floor(timeSecsTen * (AppSettings.tempos['wds']['5k']/AppSettings.tempos['wds']['10k']));
		}

		let baseInt = timeSecsTen/10;
		let timeStrFive = this.secondsToTime(Math.floor((distance/5000)*timeSecsFive));
		let timeStrTen = this.secondsToTime(Math.floor((distance/10000)*timeSecsTen));
		let timeStrHalf = this.secondsToTime(Math.floor((distance/21100)*timeSecsHalf)); 
		let timeStrInt = '';
		if (typeof <number>AppSettings.tempos['int'][distance+'m'] !== "undefined") {
			timeStrInt = this.secondsToTime(Math.floor(baseInt* <number>AppSettings.tempos['int'][distance+'m']));
		}
		let timeStrExt = '';
		if (typeof AppSettings.tempos['ext'][distance+'m'] !== "undefined") {
			timeStrExt = this.secondsToTime(Math.floor(baseInt*AppSettings.tempos['ext'][distance+'m']));
		}
		return 	{ distanceMeters: distance, distance: distance + "", timeFive: timeStrFive
			, timeTen: timeStrTen, timeHalf:timeStrHalf, timeInt:timeStrInt, timeExt:timeStrExt};	
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

	private presentLoading(message: string) {
		this.loader = this.loadingCtrl.create({
		content: message
		});
    	this.loader.present();

	}	
}

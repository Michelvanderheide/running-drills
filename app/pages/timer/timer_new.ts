import {CountdownTimer} from './countdownTimer';
import { DrillData } from "../../providers/drill-data";
import {NavController, NavParams, Page} from 'ionic-angular'; 
import {NativeAudio, Geolocation, Geoposition} from 'ionic-native';
import { AppSettings } from '../../providers//app-settings';
import { NgZone } from '@angular/core';
 
@Page({
	templateUrl: 'build/pages/timer/timer.html'
})


export class TimerPage {
	private intervals: any[];
	private intervalIdx:number = 0;
	private stActive:string = 'background:blue';
	private timeOut: any;
	private drillData : DrillData;
	private timer: CountdownTimer;
	private timeInSeconds:number;
	private countdownTime:number = 0;
	private intervalDistance = 0;
	private prevLatLong = { lat:0, lon:0 };
	private watch:any;
	 
	constructor(drillData : DrillData) {
		this.drillData = drillData;
		this.initIntervals(drillData.trainingSession.intervals);
		NativeAudio.preloadSimple('countdown', 'build/audio/countdown-5.mp3').then(function() {}, function() {});
		if (AppSettings.isNative) {
			this.countdownTime = 5;
		}
	}

	initIntervals (strIntervals) {
		//"200mv-100mp-e5,200mv,100mp,200mv,100mp,200mv,100mp,200mv,100mp,200mv,100mp,200mv,100mp,200mv,100mp,...."

		let arrIntervals = strIntervals.replace(/\s/g, '').split(",");
		this.intervals = [];
		for (let i in arrIntervals) {
			let strVlot = '', strPauze = '';
			let arrVP = [];
			let speedRef = null;
			let strItemP = null;
			let strItemV = null;
			if (arrIntervals[i].search('-') > 0) {
				arrVP = arrIntervals[i].split('-');
			} else {
				arrVP.push(arrIntervals[i]);
			}
			let item = {
				distance: 0,
				time: 0,
				timeRest: 0,
				styleActive: 0,
				displayTime: '00:00',
				displayTimeRest: '00:00'
			};		

			// determine subitems
			for (let j in arrVP) {
				let strItem = arrVP[j];
				strItem = strItem.toLowerCase();

console.log("strItem:"+strItem);

				if (strItem.search('p') > 0) {
					// pauze
					strItemP = strItem.replace('p', '');
				} else if (strItem.search('v') > 0) {
					// vlot
					strItemV = strItem.replace('v', '');
				} else if (strItem.search('e') !== -1) {
					speedRef = strItem.replace('e', '');
				}
			}

console.log("e:" + speedRef+":"+strItemP+":"+strItemV);

			if (strItemP != null) {
				if (strItemP.search('m') !== -1) {
					item.timeRest = Math.round(1.5*this.calcTime(parseInt(strItemP.replace('m', '')), speedRef));
				} else if (strItemP.search('s') !== -1) {
					item.timeRest  = parseInt(strItemP.replace('s', ''));
				} 
			}
			if (strItemV != null) {
				if (strItemV.search('m') !== -1) {
					// meters
					item.distance = parseInt(strItemV.replace('m', ''));
					item.time  = this.calcTime(item.distance, speedRef);

				} else if (strItemV.search('s') !== -1) {
					// seconds, convert to meters
					//item.distance = this.calcDistance(strItemV, speedRef);
					item.time  = parseInt(strItemV.replace('s', ''));
				}
			}

console.debug("item:",item);
			item.displayTimeRest = this.getSecondsAsDigitalClock(item.timeRest);
			item.displayTime = this.getSecondsAsDigitalClock(item.time);

			this.intervals.push(item);
			
			
		}
		console.debug("Int:",this.intervals);	
	}

	private calcTime(distance: number, speedRef:string) {
		return this.drillData.getTimeForDistance(distance, speedRef);
	}

	private calcDistance(time: number, speedRef:string) {
		return this.drillData.getTimeForDistance(time, speedRef);
	}
	 
	ngOnInit() {
		this.initTimer();
	}
	 
	hasFinished() {
		return this.timer.hasFinished;
	}
	 
	initTimer() {
		this.intervalIdx = 0;

		this.timeInSeconds = this.intervals[this.intervalIdx].time;
		 
		this.timer = <CountdownTimer>{
			seconds: this.timeInSeconds,
			runTimer: false,
			hasStarted: false,
			hasFinished: false,
			secondsRemaining: this.timeInSeconds,
			hasRest: false
		};

		this.trackDistance();
	 
		this.timer.displayTime = this.getSecondsAsDigitalClock(this.timer.secondsRemaining);
console.debug('clock:',this.timer);		
	}
	 
	startCountdown() {
		console.log("startCountdown");
		if (this.countdownTime > 0) {
			NativeAudio.play('countdown', function () {
				console.log('uniqueId1 is done playing');
			});
		}		
	}

	trackDistance() {

		let options = {
				enableHighAccuracy: true
		};

		console.log("getPosition");
		this.watch = Geolocation.watchPosition(options).subscribe(pos => {
			console.debug(":",pos);
			let position = <Geoposition> pos;
			console.log('lat: ' + position.coords.latitude + ', lon: ' + position.coords.longitude);
			let lat:number = position.coords.latitude;
			let lon:number = position.coords.longitude;
			//let lon2:number = position.coords.longitude+0.2;
			//lat: 52.2374485, lon: 6.586051899999999
			console.debug("prevLatLong",this.prevLatLong);
			if (this.prevLatLong.lat > 0 && this.prevLatLong.lon > 0) {
				this.intervalDistance += this.getDistanceFromLatLonInKm(this.prevLatLong.lat,this.prevLatLong.lon,lat,lon);
			}
			this.prevLatLong = {lat: lat, lon:lon};

		});
	}

	getDistanceFromLatLonInKm(lat1:number,lon1,lat2,lon2) {
		let R = 6371; // Radius of the earth in km
		let dLat = this.deg2rad(lat2-lat1);  // deg2rad below
		let dLon = this.deg2rad(lon2-lon1); 
		let a = 
		Math.sin(dLat/2) * Math.sin(dLat/2) +
		Math.cos(this.deg2rad(lat1)) * Math.cos(this.deg2rad(lat2)) * 
		Math.sin(dLon/2) * Math.sin(dLon/2)
		; 
		let c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
		let d:number = R * c; // Distance in km
		d = Math.round(d * 1000);
		console.log("dist:"+d);
		return d;
	}

	deg2rad(deg) {
	  return deg * (Math.PI/180)
	}

	startTimer(idx) {
		
		clearTimeout(this.timeOut);
		this.intervalDistance = 0;
		this.prevLatLong = {lat:0, lon:0};
		this.intervals[this.intervalIdx].styleActive = 0;
		this.intervalIdx = idx;
		this.timer.hasStarted = true;
		this.timer.runTimer = true;
		this.intervals[this.intervalIdx].styleActive = 1;
		this.timer.secondsRemaining = this.intervals[this.intervalIdx].time;
		
		this.timerTick();	 
	}

	pauseTimer(item) {
		this.timer.runTimer = false;
	}

	resumeTimer(item) {
		this.timer.runTimer = true;
		this.timerTick();
	}

	resumeOrPauseTimer() {
		clearTimeout(this.timeOut);
		if (!this.timer.hasStarted) {
			this.startTimer(0);
		} else {
			if (this.timer.runTimer) {
				this.timer.runTimer = false;
			} else {
				this.timer.runTimer = true;
				this.timerTick();
			}
		}
	}

	delayTimer(timeSecs: number) {
		this.timer.secondsRemaining += timeSecs;
	}

	endStepNow() {
		this.timer.secondsRemaining = 1;
	}
	 
	setIntervalIdx(idx:number) {
		this.intervalIdx = idx;
		return true;
	}

	hasMoreIntervals() {
		return (this.intervalIdx < (this.intervals.length-1));
	}

 
	timerTick() {
		this.watch.unsubscribe();
		if ((this.timer.secondsRemaining%4)==0)  {
			this.trackDistance();
		}
		this.timeOut = setTimeout(() => {
			if (!this.timer.runTimer) { return; }
			this.timer.secondsRemaining--;
			this.timer.displayTime = this.getSecondsAsDigitalClock(this.timer.secondsRemaining);
			if ((this.timer.secondsRemaining)> 0) {
				
				if ((this.timer.secondsRemaining  - this.countdownTime) == 0) {
					setTimeout(this.startCountdown());
				}
				
				this.timerTick();
			}
			else {
				if (this.timer.hasRest) {
					console.log("hasRest 1");
					this.intervals[this.intervalIdx].styleActive = 0;
					if (this.hasMoreIntervals()) {
						//this.startCountdown();
						this.intervalDistance = 0;
						this.intervalIdx++;
						this.intervals[this.intervalIdx].styleActive = 1;
						this.timer.secondsRemaining = this.intervals[this.intervalIdx].timeRest;
						this.timer.hasRest = false;
						this.timerTick();
						
					} else {
						console.log("finished");
						this.timer.hasFinished = true;
					}
				} else {
					console.log("hasNo Rest");
					//this.startTimerCountdown();	
					
					this.timer.hasRest = true;
					this.intervals[this.intervalIdx].styleActive = 2;
					this.timer.secondsRemaining = this.intervals[this.intervalIdx].timeRest;
					this.timerTick();
					
				}
	
			}
		}, 1000);
	}
	 
	getSecondsAsDigitalClock(inputSeconds: number) {
		var sec_num = parseInt(inputSeconds.toString(), 10); // don't forget the second param
		var hours = Math.floor(sec_num / 3600);
		var minutes = Math.floor((sec_num - (hours * 3600)) / 60);
		var seconds = sec_num - (hours * 3600) - (minutes * 60);
		var hoursString = '';
		var minutesString = '';
		var secondsString = '';
		hoursString = (hours < 10) ? "0" + hours : hours.toString();
		minutesString = (minutes < 10) ? "0" + minutes : minutes.toString();
		secondsString = (seconds < 10) ? "0" + seconds : seconds.toString();
		return minutesString + ':' + secondsString;
	}
}

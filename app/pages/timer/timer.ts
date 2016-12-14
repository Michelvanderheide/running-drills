import {CountdownTimer} from './countdownTimer';
import { DrillData } from "../../providers/drill-data";
import {NavController, NavParams, Page} from 'ionic-angular'; 
 
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
	 
	constructor(drillData : DrillData) {
		this.drillData = drillData;
		this.initIntervals(drillData.trainingSession.intervals);
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
				styleActive: 0
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
	 
		this.timer.displayTime = this.getSecondsAsDigitalClock(this.timer.secondsRemaining);
console.debug('clock:',this.timer);		
	}
	 
	startTimer(idx:number) {
		clearTimeout(this.timeOut);
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
		this.timeOut = setTimeout(() => {
			if (!this.timer.runTimer) { return; }
			this.timer.secondsRemaining--;
			this.timer.displayTime = this.getSecondsAsDigitalClock(this.timer.secondsRemaining);
			if (this.timer.secondsRemaining > 0) {
				this.timerTick();
			}
			else {
				if (this.timer.hasRest) {
					console.log("hasRest 1");
					this.intervals[this.intervalIdx].styleActive = 0;
					if (this.hasMoreIntervals()) {
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

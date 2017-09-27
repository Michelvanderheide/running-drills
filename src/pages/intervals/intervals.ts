import { Component } from '@angular/core';

import { NavController } from 'ionic-angular';
import { DrillData } from "../../providers/drill-data";


@Component({
	templateUrl: 'intervals.html'
})
export class IntervalsPage {
	intervalTimes: any[];
	athleteIntervalTimes: any;
	pauseTime: string;


	constructor(public navCtrl: NavController, public drillData: DrillData) {
		//this.myform.myTenTime = 150;
		this.drillData = drillData;
        console.log("intervals...");
        this.setIntervalTimes();
	}

	ngOnInit() {

    }

	changePaceBaseDistance(pacebaceBaseDistance: string) {
		console.log("changePaceBaseDistance:"+pacebaceBaseDistance);
		this.drillData.intervalSettings.pacebaceBaseDistance = pacebaceBaseDistance;
		this.setIntervalTimes();
	}

	changeIntervalPace(intervalPace: string) {
		console.log("changePaceBaseDistance:"+intervalPace);
		this.drillData.intervalSettings.intervalPace = intervalPace;
		this.setIntervalTimes();
	}	
	changeIntervalDistance(intervalDistance: number) {
		console.log("changePaceBaseDistance:"+intervalDistance);
		this.drillData.intervalSettings.intervalDistance = intervalDistance;
		this.setIntervalTimes();
	}
	setIntervalTimes() {
		this.intervalTimes = this.drillData.intervalSettings.allIntervalTimes[this.drillData.intervalSettings.pacebaceBaseDistance][this.drillData.intervalSettings.intervalPace][this.drillData.intervalSettings.intervalDistance];

		this.pauseTime = this.drillData.intervalPauzes[this.drillData.intervalSettings.intervalPace][this.drillData.intervalSettings.intervalDistance];
		this.drillData.storeIntervalSettings();
		console.debug("setIntervalTimes:",this.intervalTimes);	
		this.handleAthleteTimes();

	}

	handleAthleteTimes() {
		console.log("handleAthleteTimes:"+this.intervalTimes.length);
		console.debug(this.drillData.athleteTimes);
		this.athleteIntervalTimes = [];

		let idx=0;
		for (let i=0; i < this.intervalTimes.length; i++) {
			let intervalTime = this.intervalTimes[i];
			for (let name in this.drillData.athleteTimes) {
				if (this.drillData.athleteTimes[name] == intervalTime.pace) {
					console.log("FOUND ATHLETE...");
					if (typeof this.athleteIntervalTimes[idx] == "undefined" || this.athleteIntervalTimes[idx].pace !== intervalTime.pace) {
						this.athleteIntervalTimes.push({ names: [name], pace: intervalTime.pace, time:intervalTime.time});
						idx = this.athleteIntervalTimes.length-1;
					} else {
						this.athleteIntervalTimes[idx].names.push(name);
					}
				}
			}
		}
	}


}

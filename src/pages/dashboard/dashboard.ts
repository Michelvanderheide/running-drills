import { Component } from '@angular/core';

import { NavController } from 'ionic-angular';
import { DrillData } from "../../providers/drill-data";


@Component({
	templateUrl: 'dashboard.html'
})
export class DashboardPage {
	//public myform:any = { myTenTime: number };
	selectedTime: string;
	mytentime:number = 2500;
	myRange: any;
	happy: any = {'lower':5}; 
	dropDownIntervals: any[];
	myRaceTime: number;


	constructor(public navCtrl: NavController, public drillData: DrillData) {
		//this.myform.myTenTime = 150;
		this.drillData = drillData;
		this.myRange= {"lower": "0", "upper": "20"};
        //this.dropDownIntervals = this.drillData.getDropDownIntervalsForTen();
        this.initDropDown();
        console.log("dashboard...")
	}

	ngOnInit() {
        //this.myform.myTenTime = 150;
        this.mytentime = 2400;
        this.myRaceTime = 1000;
    }

	changeTimes() {
		console.log("changeTimes:"+this.selectedTime);
		if (this.drillData.settings.setTenTime) {
			this.drillData.changeTimeTen(this.selectedTime);
		} else {
			this.drillData.changeTimeFive(this.selectedTime);
		}
		this.drillData.storeSettings();
	}

	changeMyTime() {
		console.log("changeMyTime:");
	}
	
	toggleFiveTenTime() {
		this.drillData.toggleSetting('setTenTime');
		this.drillData.settings.fiveTime = this.drillData.settings.tenTime = this.drillData.settings.halfTime = this.selectedTime = '';
		this.initDropDown();
	}

	initDropDown() {
		if (this.drillData.settings.setTenTime) {
			this.selectedTime = this.drillData.settings.tenTime;
			this.dropDownIntervals = this.drillData.getDropDownIntervalsForTen();
			if (!this.selectedTime) {
				this.selectedTime = "50:00";
			}
		} else {
			this.selectedTime = this.drillData.settings.fiveTime;
			this.dropDownIntervals = this.drillData.getDropDownIntervalsForFive();
			if (!this.selectedTime) {
				this.selectedTime = "25:00";
			}			
		}
	}




}
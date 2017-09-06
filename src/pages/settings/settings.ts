import { Component } from '@angular/core';


import { NavController } from 'ionic-angular';
import { FormBuilder,  Validators, AbstractControl} from '@angular/forms';

import { SessionListPage } from '../session-list/session-list';
import { DrillData } from '../../providers/drill-data';
import { UserData } from '../../providers/user-data';


@Component({
	templateUrl: 'settings.html'
})
export class SettingsPage {
	private myTenTime: number;
	selectedTime: string;
	dropDownIntervals: any[];

	static get parameters() {
		return [[NavController], [DrillData], [UserData]];
	}	

	constructor(public navCtrl: NavController, public drillData: DrillData, public userData:UserData) {

		this.drillData = drillData; 
		this.userData = userData;
		this.navCtrl = navCtrl;
		this.initDropDown();
		this.changeTimes();
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


	changeMyTime() {
		console.log("changeMyTime");
	}

	changeTimes() {
		//alert ("change times");
		if (this.drillData.settings.setTenTime) {
			console.log("changeTimes 10:"+this.selectedTime);
			this.drillData.changeTimeTen(this.selectedTime);
		} else {
			console.log("changeTimes 5:"+this.selectedTime);
			this.drillData.changeTimeFive(this.selectedTime);
		}
		this.drillData.storeSettings();
	}	

	toggleRunningGroup(idx: number) {
		this.userData.toggleRunningGroup(idx);
		this.drillData.filterOnUserGroups();
	}
	toggleFiveTenTime() {
		this.drillData.toggleSetting('setTenTime');
		this.drillData.settings.fiveTime = this.drillData.settings.tenTime = this.drillData.settings.halfTime = this.selectedTime = '';
		this.initDropDown();
	}	

	/*
	setDistanceTimeKeyDown(event:any, dist:number) {
		console.debug(event);

		//backspace
		if (event.keyCode==8)
			return;

		if (dist == 5) {
			this.drillData.settings.fiveTime = this.parseTime(this.drillData.settings.fiveTime);
			console.debug("dist:"+this.drillData.settings.fiveTime);
		} else if (dist == 10) {
			this.drillData.settings.tenTime = this.parseTime(this.drillData.settings.tenTime);
			console.debug("dist:"+this.drillData.settings.tenTime);
		} else if (dist == 21) {
			this.drillData.settings.halfTime = this.parseTime(this.drillData.settings.halfTime);
			console.debug("dist:"+this.drillData.settings.halfTime);
		}
		
	}
	*/



	setDistanceTime(dist:number) {
		if (dist == 5) {
			this.drillData.settings.fiveTime = this.drillData.parseTime(this.drillData.settings.fiveTime);
			console.debug("dist:"+this.drillData.settings.fiveTime);
		} else if (dist == 10) {
			this.drillData.settings.tenTime = this.drillData.parseTime(this.drillData.settings.tenTime);
			console.debug("dist:"+this.drillData.settings.tenTime);
		} else if (dist == 21) {
			this.drillData.settings.halfTime = this.drillData.parseTime(this.drillData.settings.halfTime);
			console.debug("dist:"+this.drillData.settings.halfTime);
		}
		console.debug("dist("+dist+"):"+this.drillData.settings);
		this.drillData.storeSettings();
		this.drillData.calcTimesPerDistance();
	}

	done() {
		this.userData.setInitialized();
		this.navCtrl.pop();
	}
}
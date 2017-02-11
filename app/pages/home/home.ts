import { Page} from 'ionic-angular';

import { NavController } from 'ionic-angular';
import { DrillData } from "../../providers/drill-data";
import { SessionListPage } from "../session-list/session-list";
import { DrillListPage } from "../drill-list/drill-list";
import { SettingsPage } from '../../pages/settings/settings'
import { DashboardPage } from "../dashboard/dashboard";
import { UserData } from "../../providers/user-data";


@Page({
	templateUrl: 'build/pages/home/home.html'
})
export class HomePage {

	static get parameters() {
		return [[NavController], [DrillData], [UserData]];
	}	
	//public myform:any = { myTenTime: number };
	selectedTime: string;
	mytentime:number = 2500;
	myRange: any;
	happy: any = {'lower':5}; 
	dropDownIntervals: any[];
	pages = [ SessionListPage, 
		SessionListPage, 
		SessionListPage, 
		SessionListPage,
		DashboardPage,
		DashboardPage
	];
	userData: UserData;


	constructor(public navCtrl: NavController, public drillData: DrillData, userData: UserData) {
		//this.myform.myTenTime = 150;
		this.drillData = drillData;
		this.navCtrl = navCtrl;
		this.userData = userData;

    	for (var i=2; i<=4; i++) {
 			drillData.getCategoryDrills(i).subscribe(drills => {
				console.debug("loaded..."+drills);
			});		
    	}
	    if (!this.userData.isInitialized()) {
	      //console.log("settings..");
	      this.navCtrl.push(SettingsPage);
	    }    	
	}
	gotoPage(idx: number) {
		console.log("Gotopage:"+idx);
		if (idx==0) {
			this.drillData.setCurrentTrainingSession(this.drillData.coreStretchDrills);
			this.navCtrl.push(DrillListPage, {trainingSession:this.drillData.coreStretchDrills});			
		} else if (idx==1) {
			this.drillData.setCurrentTrainingSession(this.drillData.loopscholingDrills);
			this.navCtrl.push(DrillListPage, {trainingSession:this.drillData.loopscholingDrills});			
		} else if (idx==2) {
			this.drillData.setCurrentTrainingSession(this.drillData.kernDrills);
			this.navCtrl.push(DrillListPage, {trainingSession:this.drillData.kernDrills});			
		} else if (idx==3) {
			this.navCtrl.push(SessionListPage);			
		} else {
			console.log("hother...")
			this.navCtrl.push(DashboardPage);
		}

	}
}
import {NavController, NavParams, Page, ActionSheet} from 'ionic-angular';
import {DrillDetailPage} from '../drill-detail/drill-detail';
import {DetailTabsPage} from '../detail-tabs/detail-tabs';
import { DrillData } from "../../providers/drill-data";
//import * as jQuery from 'jquery';


@Page({
	templateUrl: 'build/pages/drill-list/drill-list.html'
})
export class DrillListPage {
	nav: NavController;
	trainingSession: TrainingSession;
	drillData: DrillData;
	drills: any;
	groups: any;
	isSummary: boolean;
	static get parameters() {
		return [[NavController], [NavParams], [DrillData]];
	}

	constructor(nav: NavController, navParams: NavParams, drillData: DrillData) {
		this.nav = nav;
		this.drillData = drillData;
		this.trainingSession = navParams.get("trainingSession");
		this.drills = this.trainingSession.drills;
		this.groups = [];
		this.isSummary = true;
		this.trainingSession.groups.forEach(group => {
			console.debug("sessionGroup():",group.groupName);
			this.drillData.getDrillFilters().forEach(drillFilter => {
				//console.debug("drillFilter:",drillFilter.title);
				if (drillFilter.value == true && group.groupName.search(drillFilter.title) >= 0) {

					console.debug("groups:",this.groups);
					console.debug("group:",this.groups);

					let found = false;
					this.groups.forEach(function(mygroup) {
						console.debug("group:"+mygroup);
						if (mygroup.groupName == group.groupName) {
							found = true;
						}
					});
					if (!found) {
						this.groups.push(group);
					}
				}
			})
		});
	}


	goToDrillDetails(drill) {
		//let idx = jQuery.inArray(drill, this.drills);
		this.drillData.setCurrentTrainingDrill(drill);
		this.nav.push(DrillDetailPage, {drill:drill});
	}

	toggleShowSummary() {
		console.log("toggle");
		this.drillData.toggleSetting("showSummary");
	}

}

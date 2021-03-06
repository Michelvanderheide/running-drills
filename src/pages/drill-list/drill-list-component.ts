import { Component } from '@angular/core';
import {NavController, NavParams} from 'ionic-angular';
import {DrillDetailPage} from '../drill-detail/drill-detail';
import { DrillData } from "../../providers/drill-data";
//import * as jQuery from 'jquery';


@Component({
	selector: 'drill-list-component',
	templateUrl: 'drill-list-component.html'
})
export class DrillListComponent {
	nav: NavController;
	trainingSession: TrainingSession;
	drillData: DrillData;
	drills: any;
	groups: any;
	isSummary: boolean;
	drillIdx: number;
	static get parameters() {
		return [[NavController], [NavParams], [DrillData]];
	}

	constructor(nav: NavController, navParams: NavParams, drillData: DrillData) {
		this.nav = nav;
		this.drillData = drillData;
		this.trainingSession = navParams.get("trainingSession");
		this.drills = this.trainingSession.drills;
		console.debug("Drills:",this.drills);
		this.groups = [];
		this.isSummary = true;
		this.trainingSession.groups.forEach(group => {
			//console.debug("sessionGroup():",group.groupName);
			this.drillData.getDrillFilters().forEach(drillFilter => {
				//console.debug("drillFilter:",drillFilter.title);
				if (drillFilter.value == true && group.groupName.toLowerCase().search(drillFilter.title.toLowerCase()) >= 0) {

					//console.debug("groups:",this.groups);
					//console.debug("group:",this.groups);

					let found = false;
					this.groups.forEach(function(mygroup:any) {
						//console.debug("group:"+mygroup);
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


	goToDrillDetails(drill: Drill, groupIdx: number, drillIdx:number) {
		//let idx = jQuery.inArray(drill, this.drills);
		this.drillIdx = drillIdx;
		console.log("goto drill:",drill);
		this.drillData.setCurrentTrainingDrill(drill);
		this.nav.push(DrillDetailPage, {drill:drill});
	}

	toggleShowSummary() {
		//console.log("toggle");
		this.drillData.toggleSetting("showSummary");
	}

}

import {NavController, NavParams, Page, ActionSheet} from 'ionic-angular';
import {DrillDetailPage} from '../drill-detail/drill-detail';
import {DetailTabsPage} from '../detail-tabs/detail-tabs';
import { DrillData } from "../../providers/drill-data";
import * as jQuery from 'jquery';


@Page({
  templateUrl: 'build/pages/drill-list/drill-list.html'
})
export class DrillListPage {
  nav: NavController;
  trainingSession: TrainingSession;
  drillData: DrillData;
  drills: any;
  groups: any;
  static get parameters() {
    return [[NavController], [NavParams], [DrillData]];
  }

  constructor(nav: NavController, navParams: NavParams, drillData: DrillData) {
    this.nav = nav;
    this.drillData = drillData;
    this.trainingSession = navParams.get("trainingSession");
    this.drills = this.trainingSession.drills;
    this.groups = [];
//console.debug("this.drillData:",drillData);
//console.debug("getDrillFilters:",this.drillData.getDrillFilters());
     this.trainingSession.groups.forEach(group => {
       console.log("sessionGroup():",group.groupName);
       this.drillData.getDrillFilters().forEach(drillFilter => {
         //console.debug("drillFilter:",drillFilter.title);
         if (drillFilter.value == true && group.groupName.search(drillFilter.title) >= 0) {
           if (jQuery.inArray(group, this.groups) == -1) {
             this.groups.push(group); // = this.trainingSession.groups;
           }
         }
       })
     });
  }

  goToDrillDetails(drill) {
    //let idx = jQuery.inArray(drill, this.drills);
    this.nav.push(DrillDetailPage, {drill:drill, drills:this.drills});
  }  

}

import {NavController, NavParams, Page, ActionSheet} from 'ionic-angular';
import {DrillDetailPage} from '../drill-detail/drill-detail';
import {DetailTabsPage} from '../detail-tabs/detail-tabs';
import { DrillData } from "../../providers/drill-data";


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
    return [[NavController], [NavParams]];
  }

  constructor(nav: NavController, navParams: NavParams, drillData: DrillData) {
    this.nav = nav;
    this.drillData = drillData;
    this.trainingSession = navParams.get("trainingSession");
    this.drills = this.trainingSession.drills;
    this.groups = this.trainingSession.groups;

  }

  goToDrillDetails(drill) {
    this.nav.push(DrillDetailPage, {drill});
  }  

}

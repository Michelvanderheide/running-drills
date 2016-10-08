import {NavController, Page, ActionSheet} from 'ionic-angular';
import {DrillListPage} from '../drill-list/drill-list';
import { DrillData } from "../../providers/drill-data";


@Page({
  templateUrl: 'build/pages/session-list/session-list.html'
})
export class SessionListPage {
  nav: NavController;
  drillData: DrillData;
  trainingSessions: any;
  static get parameters() {
    return [[NavController], [DrillData]];
  }

  constructor(nav: NavController, drillData: DrillData) {
    this.nav = nav;
    this.drillData = drillData;
    this.trainingSessions = [];

    drillData.getTrainingSessions().then(trainingSessions => {
      this.trainingSessions = trainingSessions;
    });
  }

  goToDrillList(trainingSession) {
    console.log("goToDrillList");
    console.debug(trainingSession);
    this.nav.push(DrillListPage, {trainingSession});
  }

}

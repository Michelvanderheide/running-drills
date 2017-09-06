import { Component } from '@angular/core';
import {NavController, ActionSheet} from 'ionic-angular';
import {DrillListPage} from '../drill-list/drill-list';
import { DrillData } from "../../providers/drill-data";
import {SettingsPage} from '../../pages/settings/settings';
import { UserData } from "../../providers/user-data";



@Component({
  templateUrl: 'session-list.html'
})
export class SessionListPage {
  nav: NavController;
  drillData: DrillData;
  userData: UserData;
  trainingSessions: any;
  static get parameters() {
    return [[NavController], [DrillData], [UserData]];
  }

  constructor(nav: NavController, drillData: DrillData, userData: UserData) {
    this.nav = nav;
    this.drillData = drillData;
    this.userData = userData;
    this.trainingSessions = [];

    if (drillData.isConnected) {
      //console.log("Is connected")
      drillData.getTrainingSessions().subscribe(trainingSessions => {
        this.trainingSessions = trainingSessions;
      });
    } else{
      console.log("Is not connected")
      this.trainingSessions = drillData.getCachedSessions();
    }
  }

  goToDrillList(trainingSession: any) {
    //console.log("goToDrillList");
    //console.debug(trainingSession);
    this.drillData.setCurrentTrainingSession(trainingSession);
    this.nav.push(DrillListPage, {trainingSession});
  }

}

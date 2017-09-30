import { Component } from '@angular/core';
import {NavController} from 'ionic-angular';
import { DrillData } from "../../providers/drill-data";
import { UserData } from "../../providers/user-data";



@Component({
  templateUrl: 'session-details.html'
})
export class SessionDetailsPage {
  nav: NavController;
  drillData: DrillData;
  userData: UserData;
  static get parameters() {
    return [[NavController], [DrillData], [UserData]];
  }

  constructor(nav: NavController, drillData: DrillData, userData: UserData) {
    this.nav = nav;
    this.drillData = drillData;
    this.userData = userData;
    console.log("In session list:"+this.drillData.trainingSessions.length);
  }


}

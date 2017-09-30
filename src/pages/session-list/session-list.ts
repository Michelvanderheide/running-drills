import { Component } from '@angular/core';
import {NavController} from 'ionic-angular';
import { DrillData } from "../../providers/drill-data";
import { SessionDetailsPage } from "../session-details/session-details";


@Component({
  templateUrl: 'session-list.html'
})
export class SessionListPage {
  nav: NavController;
  drillData: DrillData;
  static get parameters() {
    return [[NavController], [DrillData]];
  }

  constructor(nav: NavController, drillData: DrillData) {
    this.nav = nav;
    this.drillData = drillData;
  }

  gotoSessionDetails(trainingSession: any) {
    this.drillData.setCurrentTrainingSession(trainingSession);
    this.nav.push(SessionDetailsPage, {trainingSession});
  }
}

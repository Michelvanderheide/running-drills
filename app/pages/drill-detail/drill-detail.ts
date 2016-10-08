import {NavController, NavParams, Page} from 'ionic-angular';
import {DrillYoutubePage} from '../drill-youtube/drill-youtube';

@Page({
  templateUrl: 'build/pages/drill-detail/drill-detail.html'
})
export class DrillDetailPage {
  nav: NavController;
  navParams: NavParams;
  drill: any;
  static get parameters() {
    return [[NavController], [NavParams]];
  }

  constructor(nav: NavController, navParams: NavParams) {
    console.log("Passed params", navParams.data);
    this.nav = nav;
    this.navParams = navParams;
    this.drill = navParams.get("drill"); //navParams.data;
  }
  goBack():void {
    this.nav.rootNav.pop();
  }
  goToYoutube(drill):void {
    this.nav.push(DrillYoutubePage, {drill});
  }
}



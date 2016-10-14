import {NavController, NavParams, Page} from 'ionic-angular';
import {DrillYoutubePage} from '../drill-youtube/drill-youtube';

@Page({
  templateUrl: 'build/pages/drill-detail/drill-detail.html'
})
export class DrillDetailPage {
  nav: NavController;
  navParams: NavParams;
  drill: any;
  drills: any[];
  idx: number;
  slideOptions: any;
  static get parameters() {
    return [[NavController], [NavParams]];
  }

  constructor(nav: NavController, navParams: NavParams) {
    console.log("Passed params", navParams.data);
    this.nav = nav;
    this.navParams = navParams;
    this.drill = navParams.get("drill"); //navParams.data;
    this.idx = navParams.get("idx"); //navParams.data;
    this.drills = navParams.get("drills"); //navParams.data;
    this.slideOptions = { direction: "horizontal", initialSlide:this.idx};
  }
  goBack():void {
    this.nav.rootNav.pop();
  }
  goToYoutube(drill):void {
    this.nav.push(DrillYoutubePage, {drill});
  }
  swipeEvent(e) {
    console.debug("Swipe event:"+e.direction);
    if (e.direction == 2 && this.drills.length > this.idx+1) {
      this.idx++;
      this.drill = this.drills[this.idx];
    } else if (e.direction == 4 && this.idx > 0) {
      this.idx--;
      this.drill = this.drills[this.idx];
    }

  }
}



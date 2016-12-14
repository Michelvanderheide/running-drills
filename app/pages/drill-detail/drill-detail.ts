import {NavController, NavParams, Page} from 'ionic-angular';
import {DrillYoutubePage} from '../drill-youtube/drill-youtube';
import { DrillData } from "../../providers/drill-data";
import {TimerPage} from '../timer/timer';

@Page({
  templateUrl: 'build/pages/drill-detail/drill-detail.html'
})
export class DrillDetailPage {
  nav: NavController;
  navParams: NavParams;
  drillData: DrillData;
  drill: Drill;
  drills: Drill[];
  idx: number;
  slideOptions: any;
  static get parameters() {
    return [[NavController], [NavParams], [DrillData]];
  }

  constructor(nav: NavController, navParams: NavParams, drillData: DrillData) {
    console.log("Passed params", navParams.data);
    this.nav = nav;
    this.navParams = navParams;
    this.drillData = drillData;


    this.drill = navParams.get("drill"); //navParams.data;
    this.drill.description;
    this.idx = this.drill.drillIdx-1;
    this.drills = this.drillData.trainingSession.drills.slice(this.idx, this.idx+1);
    console.debug("drills"+this.idx+":",this.drills);
    this.slideOptions = { direction: "horizontal"};
    console.debug(this.slideOptions);
  }
  goBack():void {
    this.nav.rootNav.pop();
  }
  goToYoutube(drill):void {
    this.nav.push(DrillYoutubePage, {drill});
  }

  goToTiming() {
     this.nav.push(TimerPage); 
  }
  
  swipeEvent(offset:number) {
console.log("length"+this.idx+":"+offset);
    
    if (this.drillData.trainingSession.drills.length > (this.idx+offset) && (this.idx+offset)>=0) {
      this.idx = this.idx+offset;
      console.log("slice:"+this.idx);
      this.drills = this.drillData.trainingSession.drills.slice(this.idx, this.idx+1);
      this.drillData.setCurrentTrainingDrill(this.drills[0]);
    }
    console.debug("->",this.drills);
  }

 
}



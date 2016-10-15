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
  allDrills: any[];
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
    this.allDrills = navParams.get("drills"); //navParams.data;
    this.idx = this.drill.drillIdx;
    this.setSlidesStack(this.idx);
    this.slideOptions = { direction: "horizontal", initialSlide:1};
    console.debug(this.slideOptions);
  }
  goBack():void {
    this.nav.rootNav.pop();
  }
  goToYoutube(drill):void {
    this.nav.push(DrillYoutubePage, {drill});
  }
  
  swipeEvent(swiper:any, drillIdx) {
    console.debug("Swipe event:"+ swiper);
    let newIdx = drillIdx;
    let backward = swiper.swipeDirection === 'prev';
    if (backward) {
       console.debug("Swipe back:"+ drillIdx);
      //this.setSlidesStack(drillIdx-1); 

    } else {
      console.debug("Swipe forward:"+ drillIdx);
      //this.setSlidesStack(drillIdx+1); 
    }
   
    //this.drills = [this.drill];

  }

  setSlidesStack(slideIdx) {
    console.log("setSlidesStack:",slideIdx);
    this.drills = [];
    for (let i=-1; i<2; i++) {
      if (this.allDrills[slideIdx+i]) {
        this.drills.push(this.allDrills[slideIdx-1]);
      }
    }
  }
  
}



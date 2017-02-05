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
	hasPrev: boolean;
	hasNext: boolean;
	idx: number;
	slideOptions: any;
	reloadVideo: boolean= false;
	static get parameters() {
	return [[NavController], [NavParams], [DrillData]];
}

constructor(nav: NavController, navParams: NavParams, drillData: DrillData) {
	//console.log("Passed params", navParams.data);
	this.nav = nav;
	this.navParams = navParams;
	this.drillData = drillData;


	//this.drill = navParams.get("drill"); //navParams.data;
	this.idx = this.drillData.drill.drillIdx-1;

	console.log("idx:"+this.idx);
	this.init();
	//this.drills = this.drillData.trainingSession.drills.slice(this.idx, this.idx+1);
	//console.debug("drills"+this.idx+":",this.drills);
	//this.slideOptions = { direction: "horizontal"};
	//console.debug(this.slideOptions);
}

init() {
	this.hasNext = this.hasNextDrill();
	this.hasPrev = this.hasPrevDrill();
}

goBack():void {
	this.nav.rootNav.pop();
}

onPageWillEnter() {
     // You can execute what you want here and it will be executed right before you enter the view
     console.log("enter....");
     if (this.drillData.reloadVideo) {
     	this.goToYoutube(this.drillData.drill);
     }
}
goToYoutube(drill):void {
	this.nav.push(DrillYoutubePage, {drill});
}

goToTiming() {
	this.nav.push(TimerPage); 
}

gotoNextDrill() {
	this.idx++;
	this.init();
	this.drillData.setCurrentTrainingDrill(this.drillData.trainingSession.drills[this.idx]);
}

gotoPrevDrill() {
	this.idx--;
	this.init();
	this.drillData.setCurrentTrainingDrill(this.drillData.trainingSession.drills[this.idx]);
}

hasNextDrill() {
	return this.drillData.trainingSession.drills.length > (this.idx+1) && (this.idx+1)>=0;
}
hasPrevDrill() {
	return this.drillData.trainingSession.drills.length > (this.idx-1) && (this.idx-1)>=0;
}
/*
swipeEvent(offset:number) {
//console.log("length"+this.idx+":"+offset);

if (this.drillData.trainingSession.drills.length > (this.idx+offset) && (this.idx+offset)>=0) {
  this.idx = this.idx+offset;
  //console.log("slice:"+this.idx);

}
//console.debug("->",this.drills);
}
*/

}



import { Component, ViewChild } from '@angular/core';
import {NavController, NavParams} from 'ionic-angular';
import {DrillYoutubePage} from '../drill-youtube/drill-youtube';
import { DrillData } from "../../providers/drill-data";
import {DomSanitizer, SafeUrl} from '@angular/platform-browser';
import { Slides } from 'ionic-angular';

@Component({
	templateUrl: 'drill-detail.html'
})
export class DrillDetailPage {
	@ViewChild(Slides) slides: Slides;

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
	youtubeUrl:SafeUrl;
	static get parameters() {
		return [[NavController], [NavParams], [DrillData], [DomSanitizer]];
	}

constructor(nav: NavController, navParams: NavParams, drillData: DrillData, private sanitizer: DomSanitizer) {
	//console.log("Passed params", navParams.data);
	this.nav = nav;
	this.navParams = navParams;
	this.drillData = drillData;

	this.drills = this.drillData.trainingSession.drills;




	//this.drill = navParams.get("drill"); //navParams.data;
	this.idx = this.drillData.drill.drillIdx-1;

	console.log("idx...:"+this.idx);
	console.debug("sanitizer:",this.sanitizer);
	this.youtubeUrl = this.sanitizer.bypassSecurityTrustResourceUrl(this.drillData.drill.videoUrl);
	this.init();

	this.slideOptions = { initialSlide: 4};

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
	this.nav.pop();
}

ngOnInit() {
	console.log("slide to....")
	//this.slides.slideTo(3, 500);
}
	
ngAfterViewInit() {
	console.debug("drills:",this.drills);
	console.debug("slides:",this.slides);
	console.debug("slides:",this.slides.length);
	//this.slides.slideTo(3, 500);
}

onPageWillEnter() {
     // You can execute what you want here and it will be executed right before you enter the view
     console.log("enter....");
     if (this.drillData.reloadVideo) {
     	this.goToYoutube(this.drillData.drill);
     }
}
goToYoutube(drill:Drill):void {
	this.nav.push(DrillYoutubePage, {drill});
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
getVideoUrl() {
	console.debug("URL:",this.sanitizer.bypassSecurityTrustUrl(this.drillData.drill.videoUrl));
	return 
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



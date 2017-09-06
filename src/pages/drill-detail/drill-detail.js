var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};
import { Component } from '@angular/core';
import { NavController, NavParams } from 'ionic-angular';
import { DrillYoutubePage } from '../drill-youtube/drill-youtube';
import { DrillData } from "../../providers/drill-data";
import { TimerPage } from '../timer/timer';
var DrillDetailPage = (function () {
    function DrillDetailPage(nav, navParams, drillData) {
        this.reloadVideo = false;
        //console.log("Passed params", navParams.data);
        this.nav = nav;
        this.navParams = navParams;
        this.drillData = drillData;
        //this.drill = navParams.get("drill"); //navParams.data;
        this.idx = this.drillData.drill.drillIdx - 1;
        console.log("idx:" + this.idx);
        this.init();
        //this.drills = this.drillData.trainingSession.drills.slice(this.idx, this.idx+1);
        //console.debug("drills"+this.idx+":",this.drills);
        //this.slideOptions = { direction: "horizontal"};
        //console.debug(this.slideOptions);
    }
    Object.defineProperty(DrillDetailPage, "parameters", {
        get: function () {
            return [[NavController], [NavParams], [DrillData]];
        },
        enumerable: true,
        configurable: true
    });
    DrillDetailPage.prototype.init = function () {
        this.hasNext = this.hasNextDrill();
        this.hasPrev = this.hasPrevDrill();
    };
    DrillDetailPage.prototype.goBack = function () {
        this.nav.pop();
    };
    DrillDetailPage.prototype.onPageWillEnter = function () {
        // You can execute what you want here and it will be executed right before you enter the view
        console.log("enter....");
        if (this.drillData.reloadVideo) {
            this.goToYoutube(this.drillData.drill);
        }
    };
    DrillDetailPage.prototype.goToYoutube = function (drill) {
        this.nav.push(DrillYoutubePage, { drill: drill });
    };
    DrillDetailPage.prototype.goToTiming = function () {
        this.nav.push(TimerPage);
    };
    DrillDetailPage.prototype.gotoNextDrill = function () {
        this.idx++;
        this.init();
        this.drillData.setCurrentTrainingDrill(this.drillData.trainingSession.drills[this.idx]);
    };
    DrillDetailPage.prototype.gotoPrevDrill = function () {
        this.idx--;
        this.init();
        this.drillData.setCurrentTrainingDrill(this.drillData.trainingSession.drills[this.idx]);
    };
    DrillDetailPage.prototype.hasNextDrill = function () {
        return this.drillData.trainingSession.drills.length > (this.idx + 1) && (this.idx + 1) >= 0;
    };
    DrillDetailPage.prototype.hasPrevDrill = function () {
        return this.drillData.trainingSession.drills.length > (this.idx - 1) && (this.idx - 1) >= 0;
    };
    DrillDetailPage.prototype.getVideoUrl = function () {
        return drillData.drill.videoUrl;
    };
    return DrillDetailPage;
}());
DrillDetailPage = __decorate([
    Component({
        templateUrl: 'drill-detail.html'
    }),
    __metadata("design:paramtypes", [NavController, NavParams, DrillData])
], DrillDetailPage);
export { DrillDetailPage };
//# sourceMappingURL=drill-detail.js.map
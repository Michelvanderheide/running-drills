"use strict";
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};
var ionic_angular_1 = require('ionic-angular');
var drill_youtube_1 = require('../drill-youtube/drill-youtube');
var drill_data_1 = require("../../providers/drill-data");
var DrillDetailPage = (function () {
    function DrillDetailPage(nav, navParams, drillData) {
        console.log("Passed params", navParams.data);
        this.nav = nav;
        this.navParams = navParams;
        this.drillData = drillData;
        this.drill = navParams.get("drill"); //navParams.data;
        this.drill.description;
        this.idx = this.drill.drillIdx - 1;
        this.drills = this.drillData.trainingSession.drills.slice(this.idx, this.idx + 1);
        console.debug("drills" + this.idx + ":", this.drills);
        this.slideOptions = { direction: "horizontal" };
        console.debug(this.slideOptions);
    }
    Object.defineProperty(DrillDetailPage, "parameters", {
        get: function () {
            return [[ionic_angular_1.NavController], [ionic_angular_1.NavParams], [drill_data_1.DrillData]];
        },
        enumerable: true,
        configurable: true
    });
    DrillDetailPage.prototype.goBack = function () {
        this.nav.rootNav.pop();
    };
    DrillDetailPage.prototype.goToYoutube = function (drill) {
        this.nav.push(drill_youtube_1.DrillYoutubePage, { drill: drill });
    };
    DrillDetailPage.prototype.swipeEvent = function (offset) {
        console.log("length" + this.idx + ":" + offset);
        if (this.drillData.trainingSession.drills.length > (this.idx + offset) && (this.idx + offset) >= 0) {
            this.idx = this.idx + offset;
            console.log("slice:" + this.idx);
            this.drills = this.drillData.trainingSession.drills.slice(this.idx, this.idx + 1);
            this.drillData.setCurrentTrainingDrill(this.drills[0]);
        }
        console.debug("->", this.drills);
    };
    DrillDetailPage = __decorate([
        ionic_angular_1.Page({
            templateUrl: 'build/pages/drill-detail/drill-detail.html'
        }), 
        __metadata('design:paramtypes', [ionic_angular_1.NavController, ionic_angular_1.NavParams, drill_data_1.DrillData])
    ], DrillDetailPage);
    return DrillDetailPage;
}());
exports.DrillDetailPage = DrillDetailPage;

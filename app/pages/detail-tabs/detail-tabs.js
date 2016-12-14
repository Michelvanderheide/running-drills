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
var drill_detail_1 = require('../drill-detail/drill-detail');
var drill_youtube_1 = require('../drill-youtube/drill-youtube');
var DetailTabsPage = (function () {
    function DetailTabsPage(navParams) {
        this.mySelectedIndex = navParams.data.tabIndex || 0;
        this.drill = navParams.get("drill");
        console.log("Drill:");
        console.debug(this.drill);
        // set the root pages for each tab
        this.tab1Root = drill_detail_1.DrillDetailPage;
        this.tab2Root = drill_youtube_1.DrillYoutubePage;
    }
    Object.defineProperty(DetailTabsPage, "parameters", {
        get: function () {
            return [[ionic_angular_1.NavParams]];
        },
        enumerable: true,
        configurable: true
    });
    DetailTabsPage = __decorate([
        ionic_angular_1.Page({
            templateUrl: 'build/pages/detail-tabs/detail-tabs.html'
        }), 
        __metadata('design:paramtypes', [Object])
    ], DetailTabsPage);
    return DetailTabsPage;
}());
exports.DetailTabsPage = DetailTabsPage;

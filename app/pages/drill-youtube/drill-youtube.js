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
var platform_browser_1 = require('@angular/platform-browser');
var DrillYoutubePage = (function () {
    function DrillYoutubePage(nav, navParams, sanitizer) {
        this.sanitizer = sanitizer;
        this.nav = nav;
        this.navParams = navParams;
        //this.drill = navParams.data;
        this.drill = navParams.get("drill");
    }
    Object.defineProperty(DrillYoutubePage, "parameters", {
        get: function () {
            return [[ionic_angular_1.NavController], [ionic_angular_1.NavParams]];
        },
        enumerable: true,
        configurable: true
    });
    DrillYoutubePage.prototype.goBack = function () {
        this.nav.rootNav.pop();
    };
    DrillYoutubePage.prototype.updateVideoUrl = function (url) {
        // Appending an ID to a YouTube URL is safe.
        // Always make sure to construct SafeValue objects as
        // close as possible to the input data, so
        // that it's easier to check if the value is safe.
        //let dangerousVideoUrl = 'https://www.youtube.com/watch?v=jnS8UT6_Uws';
        return this.sanitizer.bypassSecurityTrustResourceUrl(url);
    };
    DrillYoutubePage = __decorate([
        ionic_angular_1.Page({
            templateUrl: 'build/pages/drill-youtube/drill-youtube.html'
        }), 
        __metadata('design:paramtypes', [ionic_angular_1.NavController, ionic_angular_1.NavParams, platform_browser_1.DomSanitizationService])
    ], DrillYoutubePage);
    return DrillYoutubePage;
}());
exports.DrillYoutubePage = DrillYoutubePage;

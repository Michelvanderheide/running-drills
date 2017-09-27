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
import { NavController } from 'ionic-angular';
import { DrillData } from "../../providers/drill-data";
var DashboardPage = (function () {
    function DashboardPage(navCtrl, drillData) {
        this.navCtrl = navCtrl;
        this.drillData = drillData;
        this.mytentime = 2500;
        this.happy = { 'lower': 5 };
        //this.myform.myTenTime = 150;
        this.drillData = drillData;
        this.myRange = { "lower": "0", "upper": "20" };
        //this.dropDownIntervals = this.drillData.getDropDownIntervalsForTen();
        this.initDropDown();
        console.log("dashboard...");
    }
    DashboardPage.prototype.ngOnInit = function () {
        //this.myform.myTenTime = 150;
        this.mytentime = 2400;
        this.myRaceTime = 1000;
    };
    DashboardPage.prototype.changeTimes = function () {
        console.log("changeTimes:" + this.selectedTime);
        if (this.drillData.settings.setTenTime) {
            this.drillData.changeTimeTen(this.selectedTime);
        }
        else {
            this.drillData.changeTimeFive(this.selectedTime);
        }
        this.drillData.storeSettings();
    };
    DashboardPage.prototype.changeMyTime = function () {
        console.log("changeMyTime:");
    };
    DashboardPage.prototype.toggleFiveTenTime = function () {
        console.log("toggleFiveTenTime...");
        this.drillData.toggleSetting('setTenTime');
        this.drillData.settings.fiveTime = this.drillData.settings.tenTime = this.drillData.settings.halfTime = this.selectedTime = '';
        this.initDropDown();
    };
    DashboardPage.prototype.initDropDown = function () {
        if (this.drillData.settings.setTenTime) {
            this.selectedTime = this.drillData.settings.tenTime;
            this.dropDownIntervals = this.drillData.getDropDownIntervalsForTen();
            if (!this.selectedTime) {
                this.selectedTime = "50:00";
            }
        }
        else {
            this.selectedTime = this.drillData.settings.fiveTime;
            this.dropDownIntervals = this.drillData.getDropDownIntervalsForFive();
            if (!this.selectedTime) {
                this.selectedTime = "25:00";
            }
        }
    };
    return DashboardPage;
}());
DashboardPage = __decorate([
    Component({
        templateUrl: 'dashboard.html'
    }),
    __metadata("design:paramtypes", [NavController, DrillData])
], DashboardPage);
export { DashboardPage };
//# sourceMappingURL=dashboard.js.map
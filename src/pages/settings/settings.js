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
import { DrillData } from '../../providers/drill-data';
import { UserData } from '../../providers/user-data';
var SettingsPage = (function () {
    function SettingsPage(navCtrl, drillData, userData) {
        this.navCtrl = navCtrl;
        this.drillData = drillData;
        this.userData = userData;
        this.drillData = drillData;
        this.userData = userData;
        this.navCtrl = navCtrl;
        this.initDropDown();
        this.changeTimes();
    }
    Object.defineProperty(SettingsPage, "parameters", {
        get: function () {
            return [[NavController], [DrillData], [UserData]];
        },
        enumerable: true,
        configurable: true
    });
    SettingsPage.prototype.initDropDown = function () {
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
    SettingsPage.prototype.changeMyTime = function () {
        console.log("changeMyTime");
    };
    SettingsPage.prototype.changeTimes = function () {
        //alert ("change times");
        if (this.drillData.settings.setTenTime) {
            console.log("changeTimes 10:" + this.selectedTime);
            this.drillData.changeTimeTen(this.selectedTime);
        }
        else {
            console.log("changeTimes 5:" + this.selectedTime);
            this.drillData.changeTimeFive(this.selectedTime);
        }
        this.drillData.storeSettings();
    };
    SettingsPage.prototype.toggleRunningGroup = function (idx) {
        this.userData.toggleRunningGroup(idx);
        this.drillData.filterOnUserGroups();
    };
    SettingsPage.prototype.toggleFiveTenTime = function () {
        this.drillData.toggleSetting('setTenTime');
        this.drillData.settings.fiveTime = this.drillData.settings.tenTime = this.drillData.settings.halfTime = this.selectedTime = '';
        this.initDropDown();
    };
    /*
    setDistanceTimeKeyDown(event:any, dist:number) {
        console.debug(event);

        //backspace
        if (event.keyCode==8)
            return;

        if (dist == 5) {
            this.drillData.settings.fiveTime = this.parseTime(this.drillData.settings.fiveTime);
            console.debug("dist:"+this.drillData.settings.fiveTime);
        } else if (dist == 10) {
            this.drillData.settings.tenTime = this.parseTime(this.drillData.settings.tenTime);
            console.debug("dist:"+this.drillData.settings.tenTime);
        } else if (dist == 21) {
            this.drillData.settings.halfTime = this.parseTime(this.drillData.settings.halfTime);
            console.debug("dist:"+this.drillData.settings.halfTime);
        }
        
    }
    */
    SettingsPage.prototype.setDistanceTime = function (dist) {
        if (dist == 5) {
            this.drillData.settings.fiveTime = this.drillData.parseTime(this.drillData.settings.fiveTime);
            console.debug("dist:" + this.drillData.settings.fiveTime);
        }
        else if (dist == 10) {
            this.drillData.settings.tenTime = this.drillData.parseTime(this.drillData.settings.tenTime);
            console.debug("dist:" + this.drillData.settings.tenTime);
        }
        else if (dist == 21) {
            this.drillData.settings.halfTime = this.drillData.parseTime(this.drillData.settings.halfTime);
            console.debug("dist:" + this.drillData.settings.halfTime);
        }
        console.debug("dist(" + dist + "):" + this.drillData.settings);
        this.drillData.storeSettings();
        this.drillData.calcTimesPerDistance(this.drillData.settings.fiveTime, this.drillData.settings.tenTime, this.drillData.settings.halfTime);
    };
    SettingsPage.prototype.done = function () {
        this.userData.setInitialized();
        this.navCtrl.pop();
    };
    return SettingsPage;
}());
SettingsPage = __decorate([
    Component({
        templateUrl: 'settings.html'
    }),
    __metadata("design:paramtypes", [NavController, DrillData, UserData])
], SettingsPage);
export { SettingsPage };
//# sourceMappingURL=settings.js.map
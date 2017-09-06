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
import { SessionListPage } from "../session-list/session-list";
import { DrillListPage } from "../drill-list/drill-list";
import { SettingsPage } from '../../pages/settings/settings';
import { DashboardPage } from "../dashboard/dashboard";
import { UserData } from "../../providers/user-data";
var HomePage = (function () {
    function HomePage(navCtrl, drillData, userData) {
        this.navCtrl = navCtrl;
        this.drillData = drillData;
        this.mytentime = 2500;
        this.happy = { 'lower': 5 };
        this.pages = [SessionListPage,
            SessionListPage,
            SessionListPage,
            SessionListPage,
            DashboardPage,
            DashboardPage
        ];
        //this.myform.myTenTime = 150;
        this.drillData = drillData;
        this.navCtrl = navCtrl;
        this.userData = userData;
        for (var i = 2; i <= 4; i++) {
            drillData.getCategoryDrills(i).subscribe(function (drills) {
                console.debug("loaded..." + drills);
            });
        }
        if (!this.userData.isInitialized()) {
            //console.log("settings..");
            this.navCtrl.push(SettingsPage);
        }
    }
    Object.defineProperty(HomePage, "parameters", {
        get: function () {
            return [[NavController], [DrillData], [UserData]];
        },
        enumerable: true,
        configurable: true
    });
    HomePage.prototype.gotoPage = function (idx) {
        console.log("Gotopage:" + idx);
        if (idx == 0) {
            this.drillData.setCurrentTrainingSession(this.drillData.coreStretchDrills);
            this.navCtrl.push(DrillListPage, { trainingSession: this.drillData.coreStretchDrills });
        }
        else if (idx == 1) {
            this.drillData.setCurrentTrainingSession(this.drillData.loopscholingDrills);
            this.navCtrl.push(DrillListPage, { trainingSession: this.drillData.loopscholingDrills });
        }
        else if (idx == 2) {
            this.drillData.setCurrentTrainingSession(this.drillData.kernDrills);
            this.navCtrl.push(DrillListPage, { trainingSession: this.drillData.kernDrills });
        }
        else if (idx == 3) {
            this.navCtrl.push(SessionListPage);
        }
        else {
            console.log("hother...");
            this.navCtrl.push(DashboardPage);
        }
    };
    return HomePage;
}());
HomePage = __decorate([
    Component({
        templateUrl: 'home.html'
    }),
    __metadata("design:paramtypes", [NavController, DrillData, UserData])
], HomePage);
export { HomePage };
//# sourceMappingURL=home.js.map
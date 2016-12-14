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
var drill_list_1 = require('../drill-list/drill-list');
var drill_data_1 = require("../../providers/drill-data");
var SessionListPage = (function () {
    function SessionListPage(nav, drillData) {
        var _this = this;
        this.nav = nav;
        this.drillData = drillData;
        this.trainingSessions = [];
        if (drillData.isConnected) {
            console.log("Is connected");
            drillData.getTrainingSessions().subscribe(function (trainingSessions) {
                _this.trainingSessions = trainingSessions;
            });
        }
        else {
            console.log("Is not connected");
            this.trainingSessions = drillData.getCachedSessions();
        }
    }
    Object.defineProperty(SessionListPage, "parameters", {
        get: function () {
            return [[ionic_angular_1.NavController], [drill_data_1.DrillData]];
        },
        enumerable: true,
        configurable: true
    });
    SessionListPage.prototype.goToDrillList = function (trainingSession) {
        console.log("goToDrillList");
        console.debug(trainingSession);
        this.drillData.setCurrentTrainingSession(trainingSession);
        this.nav.push(drill_list_1.DrillListPage, { trainingSession: trainingSession });
    };
    SessionListPage = __decorate([
        ionic_angular_1.Page({
            templateUrl: 'build/pages/session-list/session-list.html'
        }), 
        __metadata('design:paramtypes', [ionic_angular_1.NavController, drill_data_1.DrillData])
    ], SessionListPage);
    return SessionListPage;
}());
exports.SessionListPage = SessionListPage;

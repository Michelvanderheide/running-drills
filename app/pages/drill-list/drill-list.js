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
var drill_data_1 = require("../../providers/drill-data");
//import * as jQuery from 'jquery';
var DrillListPage = (function () {
    function DrillListPage(nav, navParams, drillData) {
        var _this = this;
        this.nav = nav;
        this.drillData = drillData;
        this.trainingSession = navParams.get("trainingSession");
        this.drills = this.trainingSession.drills;
        this.groups = [];
        this.isSummary = true;
        this.trainingSession.groups.forEach(function (group) {
            console.debug("sessionGroup():", group.groupName);
            _this.drillData.getDrillFilters().forEach(function (drillFilter) {
                //console.debug("drillFilter:",drillFilter.title);
                if (drillFilter.value == true && group.groupName.search(drillFilter.title) >= 0) {
                    console.debug("groups:", _this.groups);
                    console.debug("group:", _this.groups);
                    var found_1 = false;
                    _this.groups.forEach(function (mygroup) {
                        console.debug("group:" + mygroup);
                        if (mygroup.groupName == group.groupName) {
                            found_1 = true;
                        }
                    });
                    if (!found_1) {
                        _this.groups.push(group);
                    }
                }
            });
        });
    }
    Object.defineProperty(DrillListPage, "parameters", {
        get: function () {
            return [[ionic_angular_1.NavController], [ionic_angular_1.NavParams], [drill_data_1.DrillData]];
        },
        enumerable: true,
        configurable: true
    });
    DrillListPage.prototype.goToDrillDetails = function (drill) {
        //let idx = jQuery.inArray(drill, this.drills);
        this.drillData.setCurrentTrainingDrill(drill);
        this.nav.push(drill_detail_1.DrillDetailPage, { drill: drill });
    };
    DrillListPage.prototype.toggleShowSummary = function () {
        console.log("toggle");
        this.drillData.toggleSetting("showSummary");
    };
    DrillListPage = __decorate([
        ionic_angular_1.Page({
            templateUrl: 'build/pages/drill-list/drill-list.html'
        }), 
        __metadata('design:paramtypes', [ionic_angular_1.NavController, ionic_angular_1.NavParams, drill_data_1.DrillData])
    ], DrillListPage);
    return DrillListPage;
}());
exports.DrillListPage = DrillListPage;

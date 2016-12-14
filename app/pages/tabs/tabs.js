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
var dashboard_1 = require('../dashboard/dashboard');
var session_list_1 = require('../session-list/session-list');
var TabsPage = (function () {
    function TabsPage(navParams) {
        this.mySelectedIndex = navParams.data.tabIndex || 0;
        // set the root pages for each tab
        this.tab1Root = session_list_1.SessionListPage;
        this.tab2Root = dashboard_1.DashboardPage;
    }
    Object.defineProperty(TabsPage, "parameters", {
        get: function () {
            return [[ionic_angular_1.NavParams]];
        },
        enumerable: true,
        configurable: true
    });
    TabsPage = __decorate([
        ionic_angular_1.Page({
            templateUrl: 'build/pages/tabs/tabs.html'
        }), 
        __metadata('design:paramtypes', [Object])
    ], TabsPage);
    return TabsPage;
}());
exports.TabsPage = TabsPage;

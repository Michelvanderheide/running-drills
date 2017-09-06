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
import { NavParams } from 'ionic-angular';
import { DashboardPage } from '../dashboard/dashboard';
import { HomePage } from '../home/home';
var TabsPage = (function () {
    function TabsPage(navParams) {
        this.mySelectedIndex = navParams.data.tabIndex || 0;
        // set the root pages for each tab
        //this.tab1Root = SessionListPage;
        this.tab1Root = HomePage;
        this.tab2Root = DashboardPage;
    }
    Object.defineProperty(TabsPage, "parameters", {
        get: function () {
            return [[NavParams]];
        },
        enumerable: true,
        configurable: true
    });
    return TabsPage;
}());
TabsPage = __decorate([
    Component({
        templateUrl: 'tabs.html'
    }),
    __metadata("design:paramtypes", [Object])
], TabsPage);
export { TabsPage };
//# sourceMappingURL=tabs.js.map
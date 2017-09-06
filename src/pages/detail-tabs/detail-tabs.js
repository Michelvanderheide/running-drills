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
import { DrillDetailPage } from '../drill-detail/drill-detail';
import { DrillYoutubePage } from '../drill-youtube/drill-youtube';
var DetailTabsPage = (function () {
    function DetailTabsPage(navParams) {
        this.mySelectedIndex = navParams.data.tabIndex || 0;
        this.drill = navParams.get("drill");
        //console.log("Drill:");
        //console.debug(this.drill);
        // set the root pages for each tab
        this.tab1Root = DrillDetailPage;
        this.tab2Root = DrillYoutubePage;
    }
    Object.defineProperty(DetailTabsPage, "parameters", {
        get: function () {
            return [[NavParams]];
        },
        enumerable: true,
        configurable: true
    });
    return DetailTabsPage;
}());
DetailTabsPage = __decorate([
    Component({
        templateUrl: 'detail-tabs.html'
    }),
    __metadata("design:paramtypes", [Object])
], DetailTabsPage);
export { DetailTabsPage };
//# sourceMappingURL=detail-tabs.js.map
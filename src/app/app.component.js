var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};
import { Component, ViewChild } from '@angular/core';
import { Events, Platform, MenuController } from 'ionic-angular';
import { StatusBar } from '@ionic-native/status-bar';
import { Network } from '@ionic-native/network';
import { SplashScreen } from '@ionic-native/splash-screen';
import { TabsPage } from '../pages/tabs/tabs';
import { DrillData } from '../providers/drill-data';
import { AppSettings } from '../providers/app-settings';
import { UserData } from '../providers/user-data';
var KettinglopersApp = (function () {
    function KettinglopersApp(events, drillData, userData, platform, menu) {
        var _this = this;
        this.events = events;
        this.menu = menu;
        this.drillData = drillData;
        this.userData = userData;
        this.network = new Network();
        this.splashScreen = new SplashScreen();
        this.statusBar = new StatusBar();
        //console.log("location...."+ window.location.hostname);
        if (window.location.hostname.search("local") > -1) {
            AppSettings.setDevEnvironment();
        }
        AppSettings.isNative = platform.is('cordova');
        // watch network for a disconnect
        this.network.onDisconnect().subscribe(function () {
            //console.log('network was disconnected :-(');
            _this.drillData.isConnected = false;
        });
        // watch network for a connection
        this.network.onConnect().subscribe(function () {
            //console.log('network connected!');
            // We just got a connection but we need to wait briefly
            // before we determine the connection type.  Might need to wait
            // prior to doing any api requests as well.  
            setTimeout(function () {
                _this.drillData.isConnected = true;
                if (_this.network.type === 'wifi') {
                    //console.log('we got a wifi connection, woohoo!');
                }
            }, 3000);
        });
        // Call any initial plugins when ready
        platform.ready().then(function () {
            _this.statusBar.styleDefault();
            _this.splashScreen.hide();
        });
        // We plan to add auth to only show the login page if not logged in
        this.root = TabsPage;
        this.userData.hasLoggedIn;
        // decide which menu items should be hidden by current login status stored in local storage
        if (!this.userData.hasLoggedIn()) {
            //this.root = LoginPage;
        }
        // create an list of pages that can be navigated to from the left menu
        // the left menu only works after login
        // the login page disables the left menu
        this.appPages = [
            { title: 'Tabs', component: TabsPage, icon: 'tabs' }
        ];
    }
    Object.defineProperty(KettinglopersApp, "parameters", {
        get: function () {
            return [
                [Events], [DrillData], [UserData], [Platform], [MenuController]
            ];
        },
        enumerable: true,
        configurable: true
    });
    KettinglopersApp.prototype.openPage = function (page) {
        // find the nav component and set what the root page should be
        // reset the nav to remove previous pages and only have this page
        // we wouldn't want the back button to show in this scenario
        if (page.index) {
            this.nav.setRoot(page.component, { tabIndex: page.index });
        }
        else {
            this.nav.setRoot(page.component);
        }
    };
    KettinglopersApp.prototype.setToggleFilter = function (idx) {
        this.drillData.toggleDrillFilter(idx);
    };
    KettinglopersApp.prototype.toggleRunningGroup = function (idx) {
        this.userData.toggleRunningGroup(idx);
        this.drillData.filterOnUserGroups();
    };
    KettinglopersApp.prototype.toggleSetting = function (name) {
        this.drillData.toggleSetting(name);
    };
    KettinglopersApp.prototype.setDistanceTime = function (dist) {
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
    return KettinglopersApp;
}());
KettinglopersApp = __decorate([
    Component({
        templateUrl: 'app.template.html',
        providers: [DrillData, UserData],
        queries: {
            nav: new ViewChild('content')
        }
    }),
    __metadata("design:paramtypes", [Events, DrillData, UserData, Platform, MenuController])
], KettinglopersApp);
export { KettinglopersApp };
//# sourceMappingURL=app.component.js.map
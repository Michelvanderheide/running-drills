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
var core_1 = require('@angular/core');
var ionic_angular_1 = require('ionic-angular');
var ionic_native_1 = require('ionic-native');
var drill_data_1 = require('./providers/drill-data');
var user_data_1 = require('./providers/user-data');
var tabs_1 = require('./pages/tabs/tabs');
var app_settings_1 = require('./providers/app-settings');
var RunningDrillsApp = (function () {
    function RunningDrillsApp(events, drillData, userData, platform, menu) {
        var _this = this;
        this.events = events;
        this.menu = menu;
        this.drillData = drillData;
        this.userData = userData;
        console.log("location...." + window.location.hostname);
        if (window.location.hostname.search("local") > -1) {
            app_settings_1.AppSettings.setDevEnvironment();
        }
        // watch network for a disconnect
        var disconnectSubscription = ionic_native_1.Network.onDisconnect().subscribe(function () {
            console.log('network was disconnected :-(');
            _this.drillData.isConnected = false;
        });
        // watch network for a connection
        var connectSubscription = ionic_native_1.Network.onConnect().subscribe(function () {
            console.log('network connected!');
            // We just got a connection but we need to wait briefly
            // before we determine the connection type.  Might need to wait
            // prior to doing any api requests as well.  
            setTimeout(function () {
                _this.drillData.isConnected = true;
                if (ionic_native_1.Network.connection === 'wifi') {
                    console.log('we got a wifi connection, woohoo!');
                }
            }, 3000);
        });
        // Call any initial plugins when ready
        platform.ready().then(function () {
            ionic_native_1.StatusBar.styleDefault();
            ionic_native_1.Splashscreen.hide();
        });
        // We plan to add auth to only show the login page if not logged in
        this.root = tabs_1.TabsPage;
        this.userData.hasLoggedIn;
        // decide which menu items should be hidden by current login status stored in local storage
        if (!this.userData.hasLoggedIn()) {
        }
        // create an list of pages that can be navigated to from the left menu
        // the left menu only works after login
        // the login page disables the left menu
        this.appPages = [
            { title: 'Tabs', component: tabs_1.TabsPage, icon: 'tabs' }
        ];
    }
    Object.defineProperty(RunningDrillsApp, "parameters", {
        get: function () {
            return [
                [ionic_angular_1.Events], [drill_data_1.DrillData], [user_data_1.UserData], [ionic_angular_1.Platform], [ionic_angular_1.MenuController]
            ];
        },
        enumerable: true,
        configurable: true
    });
    RunningDrillsApp.prototype.openPage = function (page) {
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
    RunningDrillsApp.prototype.setToggleFilter = function (idx) {
        this.drillData.toggleDrillFilter(idx);
    };
    RunningDrillsApp.prototype.toggleRunningGroup = function (idx) {
        this.userData.toggleRunningGroup(idx);
    };
    RunningDrillsApp.prototype.toggleSetting = function (name) {
        this.drillData.toggleSetting(name);
    };
    RunningDrillsApp.prototype.setDistanceTime = function (dist) {
        this.drillData.storeSettings();
        this.drillData.calcTimesPerDistance();
    };
    RunningDrillsApp = __decorate([
        ionic_angular_1.App({
            templateUrl: 'build/app.html',
            providers: [drill_data_1.DrillData, user_data_1.UserData],
            // Set any config for your app here, see the docs for
            // more ways to configure your app:
            // http://ionicframework.com/docs/v2/api/config/Config/
            config: {
                // Place the tabs on the bottom for all platforms
                // See the theming docs for the default values:
                // http://ionicframework.com/docs/v2/theming/platform-specific-styles/
                tabbarPlacement: "bottom"
            },
            queries: {
                nav: new core_1.ViewChild('content')
            }
        }), 
        __metadata('design:paramtypes', [ionic_angular_1.Events, drill_data_1.DrillData, user_data_1.UserData, ionic_angular_1.Platform, ionic_angular_1.MenuController])
    ], RunningDrillsApp);
    return RunningDrillsApp;
}());
exports.RunningDrillsApp = RunningDrillsApp;

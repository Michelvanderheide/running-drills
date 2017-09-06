var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
import { BrowserModule } from '@angular/platform-browser';
import { HttpModule } from '@angular/http';
import { NgModule, ErrorHandler } from '@angular/core';
import { IonicApp, IonicModule, IonicErrorHandler } from 'ionic-angular';
import { InAppBrowser } from '@ionic-native/in-app-browser';
import { SplashScreen } from '@ionic-native/splash-screen';
import { IonicStorageModule } from '@ionic/storage';
import { KettinglopersApp } from './app.component';
import { DashboardPage } from '../pages/dashboard/dashboard';
import { DetailTabsPage } from '../pages/detail-tabs/detail-tabs';
import { DrillDetailPage } from '../pages/drill-detail/drill-detail';
import { DrillListPage } from '../pages/drill-list/drill-list';
import { DrillYoutubePage } from '../pages/drill-youtube/drill-youtube';
import { HomePage } from '../pages/home/home';
import { SessionListPage } from '../pages/session-list/session-list';
import { SettingsPage } from '../pages/settings/settings';
import { TabsPage } from '../pages/tabs/tabs';
import { TimerPage } from '../pages/timer/timer';
import { DrillData } from '../providers/drill-data';
import { AppSettings } from '../providers/app-settings';
import { UserData } from '../providers/user-data';
var AppModule = (function () {
    function AppModule() {
    }
    return AppModule;
}());
AppModule = __decorate([
    NgModule({
        declarations: [
            KettinglopersApp,
            DashboardPage,
            DetailTabsPage,
            DrillDetailPage,
            DrillListPage,
            DrillYoutubePage,
            HomePage,
            SessionListPage,
            SettingsPage,
            TabsPage,
            TimerPage
        ],
        imports: [
            BrowserModule,
            HttpModule,
            IonicModule.forRoot(KettinglopersApp, {}, {
                links: [
                    { component: TabsPage, name: 'TabsPage', segment: 'tabs' },
                    { component: DashboardPage, name: 'Dashboard', segment: 'dashboard' },
                    { component: DetailTabsPage, name: 'DetailTabs', segment: 'detailTabs' },
                    { component: DrillDetailPage, name: 'DrillDetail', segment: 'drillDetail/:id' },
                    { component: DrillListPage, name: 'DrillList', segment: 'drillList' },
                    { component: DrillYoutubePage, name: 'DrillYoutube', segment: 'drillYoutube' },
                    { component: HomePage, name: 'Home', segment: 'home' },
                    { component: SessionListPage, name: 'SessionList', segment: 'sessionList' },
                    { component: SettingsPage, name: 'Settings', segment: 'settings' },
                    { component: TabsPage, name: 'Tabs', segment: 'tabs' },
                    { component: TimerPage, name: 'TimerPage', segment: 'timer' }
                ]
            }),
            IonicStorageModule.forRoot()
        ],
        bootstrap: [IonicApp],
        entryComponents: [
            KettinglopersApp,
            TabsPage,
            DashboardPage,
            DetailTabsPage,
            DrillDetailPage,
            DrillListPage,
            DrillYoutubePage,
            HomePage,
            SessionListPage,
            SettingsPage,
            TabsPage,
            TimerPage
        ],
        providers: [
            { provide: ErrorHandler, useClass: IonicErrorHandler },
            AppSettings,
            DrillData,
            UserData,
            InAppBrowser,
            SplashScreen
        ]
    })
], AppModule);
export { AppModule };
//# sourceMappingURL=app.module.js.map
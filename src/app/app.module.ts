import { BrowserModule } from '@angular/platform-browser';
import { HttpModule } from '@angular/http';
import { NgModule, ErrorHandler } from '@angular/core';

import { IonicApp, IonicModule, IonicErrorHandler } from 'ionic-angular';

import { InAppBrowser } from '@ionic-native/in-app-browser';
import { SplashScreen } from '@ionic-native/splash-screen';

import { IonicStorageModule } from '@ionic/storage';
import { KettinglopersApp } from './app.component';
import { DashboardPage } from '../pages/dashboard/dashboard';
import { IntervalsPage } from '../pages/intervals/intervals';
import { DetailTabsPage } from '../pages/detail-tabs/detail-tabs';
import { DrillDetailPage } from '../pages/drill-detail/drill-detail';
import { DrillListPage } from '../pages/drill-list/drill-list';
import { DrillYoutubePage } from '../pages/drill-youtube/drill-youtube';
import { HomePage } from '../pages/home/home';
import { SessionListPage } from '../pages/session-list/session-list';
import { SettingsPage } from '../pages/settings/settings';
import { TabsPage } from '../pages/tabs/tabs';

import { DrillData } from '../providers/drill-data';
import { AppSettings } from '../providers/app-settings';
import { UserData } from '../providers/user-data';
import { HideHeaderDirective } from '../directives/hide-header/hide-header';


@NgModule({
  declarations: [
    KettinglopersApp,
    DashboardPage,
    IntervalsPage,
    DetailTabsPage,
    DrillDetailPage,
    DrillListPage,
    DrillYoutubePage,
    HomePage,
    SessionListPage,
    SettingsPage,
    TabsPage,
    HideHeaderDirective
  ],
  imports: [
    BrowserModule,
    HttpModule,
    IonicModule.forRoot(KettinglopersApp, {}, {
      links: [
        { component: TabsPage, name: 'TabsPage', segment: 'tabs' },
        { component: DashboardPage, name: 'Dashboard', segment: 'dashboard' },
        { component: IntervalsPage, name: 'Intervals', segment: 'intervals' },
        { component: DetailTabsPage, name: 'DetailTabs', segment: 'detailTabs' },
        { component: DrillDetailPage, name: 'DrillDetail', segment: 'drillDetail/:id' },
        { component: DrillListPage, name: 'DrillList', segment: 'drillList' },
        { component: DrillYoutubePage, name: 'DrillYoutube', segment: 'drillYoutube' },
        { component: HomePage, name: 'Home', segment: 'home' },
        { component: SessionListPage, name: 'SessionList', segment: 'sessionList' },
        { component: SettingsPage, name: 'Settings', segment: 'settings' },
        { component: TabsPage, name: 'Tabs', segment: 'tabs' }
      ]
    }),
    IonicStorageModule.forRoot()
  ],
  bootstrap: [IonicApp],
  entryComponents: [
    KettinglopersApp,
    TabsPage,
    DashboardPage,
    IntervalsPage,
    DetailTabsPage,
    DrillDetailPage,
    DrillListPage,
    DrillYoutubePage,
    HomePage,
    SessionListPage,
    SettingsPage,
    TabsPage
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
export class AppModule { }

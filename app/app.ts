import {ViewChild} from '@angular/core';
import {App, Events, Platform, MenuController, NavController} from 'ionic-angular';
import {StatusBar, Splashscreen} from 'ionic-native';
import {DrillData} from './providers/drill-data';
import {TabsPage} from './pages/tabs/tabs';
import {SessionListPage} from './pages/session-list/session-list';
import { AppSettings } from './providers/app-settings';


@App({
  templateUrl: 'build/app.html',
  providers: [DrillData],
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
    nav: new ViewChild('content')
  }
})
class RunningDrillsApp {
  nav: NavController;
  events: Events;
  menu: MenuController;
  appPages: any[];
  root: any;
  static get parameters() {
    return [
      [Events], [DrillData], [Platform], [MenuController]
    ]
  }

  constructor(events: Events, drillData:DrillData, platform: Platform, menu: MenuController) {
    this.events = events;
    this.menu = menu;

      console.log("location...."+ window.location.hostname);
      if (window.location.hostname.search("local") > -1) {
        AppSettings.setDevEnvironment();
      }


    // Call any initial plugins when ready
    platform.ready().then(() => {
      StatusBar.styleDefault();
      Splashscreen.hide();
    });

    // We plan to add auth to only show the login page if not logged in
    this.root = SessionListPage;

    // create an list of pages that can be navigated to from the left menu
    // the left menu only works after login
    // the login page disables the left menu
    this.appPages = [
      { title: 'Sessions', component: SessionListPage, icon: 'session-list' },
    ];

  }

  openPage(page) {
    // find the nav component and set what the root page should be
    // reset the nav to remove previous pages and only have this page
    // we wouldn't want the back button to show in this scenario
    if (page.index) {
      this.nav.setRoot(page.component, {tabIndex: page.index});
    } else {
      this.nav.setRoot(page.component);
    }

  }

}

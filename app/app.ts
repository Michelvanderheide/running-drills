import {ViewChild} from '@angular/core';
import {App, Events, Platform, MenuController, NavController} from 'ionic-angular';
import {StatusBar, Splashscreen, Network} from 'ionic-native';
import {DrillData} from './providers/drill-data';
import {UserData} from './providers/user-data';
import {TabsPage} from './pages/tabs/tabs';
import {SessionListPage} from './pages/session-list/session-list';
import {LoginPage} from './pages/login/login';
import { AppSettings } from './providers/app-settings';


@App({
  templateUrl: 'build/app.html',
  providers: [DrillData, UserData],
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
export class RunningDrillsApp {
  nav: NavController;
  events: Events;
  menu: MenuController;
  appPages: any[];
  root: any;
  drillData: DrillData;
  userData: UserData;
  static get parameters() {
    return [
      [Events], [DrillData], [UserData], [Platform], [MenuController]
    ]
  }

  constructor(events: Events, drillData:DrillData, userData:UserData, platform: Platform, menu: MenuController) {
    this.events = events;
    this.menu = menu;
    this.drillData = drillData;
    this.userData = userData;

      console.log("location...."+ window.location.hostname);
      if (window.location.hostname.search("local") > -1) {
        AppSettings.setDevEnvironment();
      }

// watch network for a disconnect
let disconnectSubscription = Network.onDisconnect().subscribe(() => {
  console.log('network was disconnected :-(');
  this.drillData.isConnected = false;
});

// watch network for a connection
let connectSubscription = Network.onConnect().subscribe(() => {
  console.log('network connected!'); 
  // We just got a connection but we need to wait briefly
   // before we determine the connection type.  Might need to wait 
  // prior to doing any api requests as well.  
  setTimeout(() => {
    this.drillData.isConnected = true;
    if (Network.connection === 'wifi') {
      console.log('we got a wifi connection, woohoo!');

    }
  }, 3000);
});



    // Call any initial plugins when ready
    platform.ready().then(() => {
      StatusBar.styleDefault();
      Splashscreen.hide();
    });

    // We plan to add auth to only show the login page if not logged in
    this.root = TabsPage;


    this.userData.hasLoggedIn
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

  setToggleFilter(idx) {
    this.drillData.toggleDrillFilter(idx);
  }

  toggleRunningGroup(idx) {
    this.userData.toggleRunningGroup(idx);
    this.drillData.filterOnUserGroups();
  }

  toggleSetting(name) {
    this.drillData.toggleSetting(name);
  }

  setDistanceTime(dist) {
    this.drillData.storeSettings();
    this.drillData.calcTimesPerDistance();


  }
}

import { Component, ViewChild } from '@angular/core';

import { Events, Platform, MenuController, NavController} from 'ionic-angular';

import { StatusBar } from '@ionic-native/status-bar';
import { Network } from '@ionic-native/network';
import { SplashScreen } from '@ionic-native/splash-screen';


import {TabsPage} from '../pages/tabs/tabs'

import { DrillData } from '../providers/drill-data';
import { AppSettings } from '../providers/app-settings';
import { UserData } from '../providers/user-data';

export interface PageInterface {
  title: string;
  name: string;
  component: any;
  icon: string;
  logsOut?: boolean;
  index?: number;
  tabName?: string;
  tabComponent?: any;
}

@Component({
  templateUrl: 'app.template.html',
  providers: [DrillData, UserData],
  queries: {
    nav: new ViewChild('content')
  }
})
export class KettinglopersApp {
  nav: NavController;
  events: Events;
  menu: MenuController;
  appPages: any[];
  root: any;
  drillData: DrillData;
  userData: UserData;

  private network: Network;
  private splashScreen: SplashScreen;
  private statusBar:StatusBar;

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
    this.network = new Network();
    this.splashScreen = new SplashScreen();
    this.statusBar = new StatusBar();


      //console.log("location...."+ window.location.hostname);
      if (window.location.hostname.search("local") > -1) {
        AppSettings.setDevEnvironment();
      }

      AppSettings.isNative = platform.is('cordova');

// watch network for a disconnect
this.network.onDisconnect().subscribe(() => {
  //console.log('network was disconnected :-(');
  this.drillData.isConnected = false;
});

// watch network for a connection
this.network.onConnect().subscribe(() => {
  //console.log('network connected!'); 
  // We just got a connection but we need to wait briefly
   // before we determine the connection type.  Might need to wait 
  // prior to doing any api requests as well.  
  setTimeout(() => {
    this.drillData.isConnected = true;
    if (this.network.type === 'wifi') {
      //console.log('we got a wifi connection, woohoo!');

    }
  }, 3000);
});


  
    // Call any initial plugins when ready
    platform.ready().then(() => {
      this.statusBar.styleDefault();
      this.splashScreen.hide();
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

  openPage(page:any) {
    // find the nav component and set what the root page should be
    // reset the nav to remove previous pages and only have this page
    // we wouldn't want the back button to show in this scenario
    if (page.index) {
      this.nav.setRoot(page.component, {tabIndex: page.index});
    } else {
      this.nav.setRoot(page.component);
    }

  }

  setToggleFilter(idx:number) {
    this.drillData.toggleDrillFilter(idx);
  }

  toggleRunningGroup(idx:number) {
    this.userData.toggleRunningGroup(idx);
    this.drillData.filterOnUserGroups();
  }

  toggleSetting(name:string) {
    this.drillData.toggleSetting(name);
  }

  setDistanceTime(dist:number) {
    if (dist == 5) {
      this.drillData.settings.fiveTime = this.drillData.parseTime(this.drillData.settings.fiveTime);
      console.debug("dist:"+this.drillData.settings.fiveTime);
    } else if (dist == 10) {
      this.drillData.settings.tenTime = this.drillData.parseTime(this.drillData.settings.tenTime);
      console.debug("dist:"+this.drillData.settings.tenTime);
    } else if (dist == 21) {
      this.drillData.settings.halfTime = this.drillData.parseTime(this.drillData.settings.halfTime);
      console.debug("dist:"+this.drillData.settings.halfTime);
    }
    console.debug("dist("+dist+"):"+this.drillData.settings);
    this.drillData.storeSettings();
    this.drillData.calcTimesPerDistanceForSettings();
  }  
}
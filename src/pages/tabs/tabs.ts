import { Component } from '@angular/core';
import { NavParams} from 'ionic-angular';
import {DashboardPage} from '../dashboard/dashboard';
import {HomePage} from '../home/home';


@Component({
  templateUrl: 'tabs.html'
})
export class TabsPage {
  tab1Root: any;
  tab2Root: any;
  tab3Root: any;
  mySelectedIndex: number;

  static get parameters() {
    return [[NavParams]];
  }

  constructor(navParams: any) {
    this.mySelectedIndex = navParams.data.tabIndex || 0;

    // set the root pages for each tab
    //this.tab1Root = SessionListPage;
    this.tab1Root = HomePage;
    this.tab2Root = DashboardPage;
  }


}

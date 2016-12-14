import {Page, NavParams} from 'ionic-angular';
import {DashboardPage} from '../dashboard/dashboard';
import {SessionListPage} from '../session-list/session-list';


@Page({
  templateUrl: 'build/pages/tabs/tabs.html'
})
export class TabsPage {
  tab1Root: any;
  tab2Root: any;
  tab3Root: any;
  mySelectedIndex: number;

  static get parameters() {
    return [[NavParams]];
  }

  constructor(navParams) {
    this.mySelectedIndex = navParams.data.tabIndex || 0;

    // set the root pages for each tab
    this.tab1Root = SessionListPage;
    this.tab2Root = DashboardPage;
  }
}

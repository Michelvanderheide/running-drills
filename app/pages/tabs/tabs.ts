import {Page, NavParams} from 'ionic-angular';
import {DrillListPage} from '../drill-list/drill-list';


@Page({
  templateUrl: 'build/pages/tabs/tabs.html'
})
export class TabsPage {
  tab1Root: any;
  tab2Root: any;
  tab3Root: any;
  tab4Root: any;
  mySelectedIndex: number;

  static get parameters() {
    return [[NavParams]];
  }

  constructor(navParams) {
    this.mySelectedIndex = navParams.data.tabIndex || 0;

    // set the root pages for each tab
    this.tab1Root = DrillListPage;
    this.tab2Root = DrillListPage;
    this.tab3Root = DrillListPage;
    this.tab4Root = DrillListPage;
  }
}

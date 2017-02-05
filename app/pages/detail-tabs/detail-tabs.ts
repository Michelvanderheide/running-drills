import {Page, NavParams} from 'ionic-angular';
import {DrillDetailPage} from '../drill-detail/drill-detail';
import {DrillYoutubePage} from '../drill-youtube/drill-youtube';


@Page({
  templateUrl: 'build/pages/detail-tabs/detail-tabs.html'
})
export class DetailTabsPage {
  mySelectedIndex: number;
  tab1Root: any;
  tab2Root: any;
  drill: any;
  static get parameters() {
    return [[NavParams]];
  }

  constructor(navParams) {
    this.mySelectedIndex = navParams.data.tabIndex || 0;
    this.drill = navParams.get("drill");
    //console.log("Drill:");
    //console.debug(this.drill);
    // set the root pages for each tab
    this.tab1Root = DrillDetailPage;
    this.tab2Root = DrillYoutubePage;
  }
}

import {NavController, NavParams, Page} from 'ionic-angular';
import {DomSanitizationService} from '@angular/platform-browser';


@Page({
  templateUrl: 'build/pages/drill-youtube/drill-youtube.html'
})
export class DrillYoutubePage {
  nav: NavController;
  navParams: NavParams;
  drill: any;
  static get parameters() {
    return [[NavController], [NavParams]];
  }

  constructor(nav: NavController, navParams: NavParams, public sanitizer: DomSanitizationService) {
    this.nav = nav;
    this.navParams = navParams;
    //this.drill = navParams.data;
    this.drill = navParams.get("drill");
  }
  goBack():void {
    this.nav.rootNav.pop();
  }  

  updateVideoUrl(url: string) {
          // Appending an ID to a YouTube URL is safe.
          // Always make sure to construct SafeValue objects as
          // close as possible to the input data, so
          // that it's easier to check if the value is safe.
          //let dangerousVideoUrl = 'https://www.youtube.com/watch?v=jnS8UT6_Uws';
          return this.sanitizer.bypassSecurityTrustResourceUrl(url);
  }
}



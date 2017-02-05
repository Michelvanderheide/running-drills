import {NavController, NavParams, Page} from 'ionic-angular';
import {DomSanitizationService} from '@angular/platform-browser';
import { DrillData } from "../../providers/drill-data";
import { File } from 'ionic-native';

declare var cordova: any;

@Page({
  templateUrl: 'build/pages/drill-youtube/drill-youtube.html'
})
export class DrillYoutubePage {
  nav: NavController;
  navParams: NavParams;
  drillData:DrillData;
  drill: any;
  localVideoUrl:string;
  videoFile: string;
  static get parameters() {
    return [[NavController], [NavParams] ,[DrillData]];
  }

  constructor(nav: NavController, navParams: NavParams, drillData:DrillData, public sanitizer: DomSanitizationService) {
    this.nav = nav;
    this.navParams = navParams;
    //this.drill = navParams.data;
    this.drill = navParams.get("drill");
    this.drillData = drillData;
    this.drillData.reloadVideo = false;
    if (this.drill.hasVideo) {
      //File.checkFile(path, file)

      if (this.drill.videoUrl && this.drill.videoUrl.search("youtube") == -1) {
        this.videoFile = (this.drill.id+".mp4").toLowerCase();
        this.drill.videoUrl = 'http://www.avgoor.nl/wp-content/images/drills/videos/'+this.videoFile;
      //this.localVideoUrl = cordova.file.applicationDirectory+'www/build/video/'+file;

      //console.log("this.localVideoUrl:"+this.localVideoUrl);

         if (typeof cordova !== "undefined") {

    /*
            File.listDir(cordova.file.applicationDirectory, 'www/build/video').then(function(entries){
              console.log("NEtries....");
              entries.forEach(function(entry) {
                  console.log("entry:"+entry.fullPath);
              });
            });
    */
            console.log("check file exists..."); 
            File.checkFile(cordova.file.applicationDirectory, 'www/build/video/'+this.videoFile).then(
              (fileExists) => {
                  if (fileExists) {
                    
                    this.drill.videoUrl = cordova.file.applicationDirectory+'www/build/video/'+this.videoFile;
                    console.log("File exists:"+this.drill.videoUrl);
                  } else {
                    console.log("File NOT exists:");
                  }
              }
            );
          }

       }

      
    }

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
  startYoutube() {
    this.drillData.reloadVideo = true;
    this.goBack();
    //this.nav.rootNav.pop();
    //this.nav.push(DrillYoutubePage, {drill: this.drill});
    //console.debug(window.frames['drillvideo']); 
    //window.frames['drillvideo'].location.reload();
  }
}



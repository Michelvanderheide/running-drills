var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};
import { Component } from '@angular/core';
import { NavController, NavParams } from 'ionic-angular';
import { DomSanitizer } from '@angular/platform-browser';
import { DrillData } from "../../providers/drill-data";
import { File } from '@ionic-native/file';
var DrillYoutubePage = (function () {
    function DrillYoutubePage(nav, navParams, drillData, sanitizer, file) {
        var _this = this;
        this.sanitizer = sanitizer;
        this.file = file;
        this.nav = nav;
        this.navParams = navParams;
        //this.drill = navParams.data;
        this.drill = navParams.get("drill");
        this.drillData = drillData;
        this.drillData.reloadVideo = false;
        if (this.drill.hasVideo) {
            //File.checkFile(path, file)
            if (this.drill.videoUrl && this.drill.videoUrl.search("youtube") == -1) {
                this.videoFile = (this.drill.id + ".mp4").toLowerCase();
                this.drill.videoUrl = 'http://www.avgoor.nl/wp-content/images/drills/videos/' + this.videoFile;
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
                    this.file.checkFile(cordova.file.applicationDirectory, 'www/build/video/' + this.videoFile).then(function (fileExists) {
                        if (fileExists) {
                            _this.drill.videoUrl = cordova.file.applicationDirectory + 'www/build/video/' + _this.videoFile;
                            console.log("File exists:" + _this.drill.videoUrl);
                        }
                        else {
                            console.log("File NOT exists:");
                        }
                    });
                }
            }
        }
    }
    Object.defineProperty(DrillYoutubePage, "parameters", {
        get: function () {
            return [[NavController], [NavParams], [DrillData]];
        },
        enumerable: true,
        configurable: true
    });
    DrillYoutubePage.prototype.goBack = function () {
        this.nav.pop();
    };
    DrillYoutubePage.prototype.updateVideoUrl = function (url) {
        // Appending an ID to a YouTube URL is safe.
        // Always make sure to construct SafeValue objects as
        // close as possible to the input data, so
        // that it's easier to check if the value is safe.
        //let dangerousVideoUrl = 'https://www.youtube.com/watch?v=jnS8UT6_Uws';
        return this.sanitizer.bypassSecurityTrustResourceUrl(url);
    };
    DrillYoutubePage.prototype.startYoutube = function () {
        this.drillData.reloadVideo = true;
        this.goBack();
        //this.nav.rootNav.pop();
        //this.nav.push(DrillYoutubePage, {drill: this.drill});
        //console.debug(window.frames['drillvideo']); 
        //window.frames['drillvideo'].location.reload();
    };
    return DrillYoutubePage;
}());
DrillYoutubePage = __decorate([
    Component({
        templateUrl: 'drill-youtube.html'
    }),
    __metadata("design:paramtypes", [NavController, NavParams, DrillData, DomSanitizer, File])
], DrillYoutubePage);
export { DrillYoutubePage };
//# sourceMappingURL=drill-youtube.js.map
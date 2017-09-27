var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};
import { Injectable } from '@angular/core';
import { Http, Headers, RequestOptions } from '@angular/http';
import { AppSettings } from './app-settings';
import { UserData } from './user-data';
import { Network } from '@ionic-native/network';
import 'rxjs/add/operator/map';
/*
drill
{
    id: 1,
    title: "Beenzwaai op plaats, met hang naar voren",
    description: "Zwaaibeweging been op de plaats. Evenwicht houden. Daarna stilhangen lichaam naar voren 1 been achter",
    tags: [ "warming up", "core" ],
    locations: [ "circle" ],
    media: [ 'beenzwaai-1.jpg', 'picture1.jpg'],
    musclegroups: [ "rug", "quadricepts"],
}

*/
var DrillData = (function () {
    function DrillData(http, userData) {
        this.reloadVideo = false;
        this.drillIdx = 0;
        this.network = new Network();
        this.isConnected = true;
        if (this.network.type == "none") {
            this.isConnected = false;
        }
        this.http = http;
        this.userData = userData;
        this.errorMessage = '';
        this.defaultImg = AppSettings.defaultImg;
        this.initSettings();
        this.initDrillFilters();
        this.calcAllIntervalTimes();
        //this.settings.tenTimeSecs = 2500;
    }
    Object.defineProperty(DrillData, "parameters", {
        get: function () {
            return [[Http], [UserData]];
        },
        enumerable: true,
        configurable: true
    });
    /*	private handleError (error: any) {
            // In a real world app, we might use a remote logging infrastructure
            // We'd also dig deeper into the error to get a better message
            let errMsg = (error.message) ? error.message :
              error.status ? `${error.status} - ${error.statusText}` : 'Server error';
            console.error(errMsg); // log to console instead
            this.errorMessage = 'Server error';
            return Promise.reject(errMsg);
        }*/
    DrillData.prototype.changeTimeTen = function (timeSecsTen) {
        if (timeSecsTen) {
            this.settings.tenTime = timeSecsTen;
            this.settings.fiveTime = '';
            this.settings.halfTime = '';
            this.calcTimesPerDistance(this.settings.fiveTime, this.settings.tenTime, this.settings.halfTime);
        }
    };
    DrillData.prototype.changeTimeFive = function (timeSecsFive) {
        if (timeSecsFive) {
            this.settings.tenTime = '';
            this.settings.fiveTime = timeSecsFive;
            this.settings.halfTime = '';
            this.calcTimesPerDistance(this.settings.fiveTime, this.settings.tenTime, this.settings.halfTime);
        }
    };
    DrillData.prototype.getDropDownIntervalsForTen = function () {
        var result = [];
        for (var i = 33; i < 70; i++) {
            result.push(i + ":00");
            result.push(i + ":30");
        }
        return result;
    };
    DrillData.prototype.getDropDownIntervalsForFive = function () {
        var result = [];
        for (var i = 16; i < 35; i++) {
            result.push(i + ":00");
            result.push(i + ":30");
        }
        return result;
    };
    DrillData.prototype.getTrainingSessions = function () {
        var _this = this;
        //console.log("getTrainingSessions...");
        return this.http.get(AppSettings.BASE_API_URL + "/trainingsessions/", this.getRequestOptions()).map(function (res) {
            var result = res.json();
            if (result.status === false) {
                _this.errorMessage = result.message;
                return _this.trainingSessions;
            }
            else {
                _this.trainingSessions = result.data;
                console.debug("getTrainingSessions:", _this.trainingSessions);
                localStorage.setItem("trainingSessions", JSON.stringify(_this.trainingSessions));
                console.debug("getTrainingSessions 2:", localStorage.getItem("trainingSessions"));
                _this.filterOnUserGroups();
                return _this.trainingSessions;
            }
        });
    };
    DrillData.prototype.getCategoryDrills = function (cat) {
        var _this = this;
        return this.http.get(AppSettings.BASE_API_URL + "/drillsforcategory/" + cat, this.getRequestOptions()).map(function (res) {
            var result = res.json();
            if (result.status === false) {
                _this.errorMessage = result.message;
                return false;
            }
            else {
                console.debug("getCategoryDrills:", result.data);
                if (cat == 2) {
                    _this.coreStretchDrills = result.data;
                    localStorage.setItem("coreStretchDrills", JSON.stringify(result.data));
                }
                else if (cat == 3) {
                    _this.loopscholingDrills = result.data;
                    localStorage.setItem("loopscholingDrills", JSON.stringify(result.data));
                }
                else if (cat == 4) {
                    _this.kernDrills = result.data;
                    localStorage.setItem("kernDrills", JSON.stringify(result.data));
                }
                return result.data;
            }
        });
    };
    DrillData.prototype.filterOnUserGroups = function () {
        var runningGroups = this.userData.getRunningGroups();
        if (typeof this.trainingSessions !== "undefined") {
            for (var i = 0; i < this.trainingSessions.length; i++) {
                this.trainingSessions[i].show = false;
                if (this.trainingSessions[i].userGroupName == "alle") {
                    this.trainingSessions[i].show = true;
                }
                else {
                    for (var j in runningGroups) {
                        console.log("name:" + runningGroups[j].name);
                        if (runningGroups[j].name == this.trainingSessions[i].userGroupName && runningGroups[j].value === true) {
                            this.trainingSessions[i].show = true;
                        }
                    }
                }
            }
        }
    };
    DrillData.prototype.getCachedSessions = function () {
        var localTrainingsSession = localStorage.getItem("trainingSessions");
        if (localTrainingsSession !== null) {
            this.trainingSessions = JSON.parse(localTrainingsSession);
        }
        //console.debug("getCachedSessions",localTrainingsSession);
        return this.trainingSessions;
    };
    DrillData.prototype.initSettings = function () {
        var localSettings = localStorage.getItem("settings");
        if (localSettings == null) {
            this.settings = { showSummary: false, fiveTime: "", tenTime: "", halfTime: "", setTenTime: true };
            localStorage.setItem("settings", JSON.stringify(this.settings));
        }
        else {
            this.settings = JSON.parse(localSettings);
        }
        //console.debug("Init Settings:",this.settings);
        this.calcTimesPerDistance(this.settings.fiveTime, this.settings.tenTime, this.settings.halfTime);
    };
    DrillData.prototype.initDrillFilters = function () {
        var localDrillFilter = localStorage.getItem("drillFilters");
        if (localDrillFilter == null) {
            this.drillFilters = [
                { title: "Warming up", value: true },
                { title: "Core stability", value: true },
                { title: "Loopscholing", value: true },
                { title: "Kern", value: true },
                { title: "Cooling down", value: true },
            ];
            localStorage.setItem("drillFilters", JSON.stringify(this.drillFilters));
        }
        else {
            this.drillFilters = JSON.parse(localDrillFilter);
        }
    };
    DrillData.prototype.getDrillFilters = function () {
        return this.drillFilters;
    };
    DrillData.prototype.toggleDrillFilter = function (idx) {
        this.drillFilters[idx].value = (!this.drillFilters[idx].value);
        localStorage.setItem("drillFilters", JSON.stringify(this.drillFilters));
    };
    DrillData.prototype.toggleSetting = function (name) {
        this.settings[name] = (!this.settings[name]);
        localStorage.setItem("settings", JSON.stringify(this.settings));
    };
    DrillData.prototype.storeSettings = function () {
        this.validateSettings();
        localStorage.setItem("settings", JSON.stringify(this.settings));
    };
    DrillData.prototype.validateSettings = function () {
        if (this.settings.fiveTime) {
            this.settings.fiveTime = this.settings.fiveTime.replace(/\D/g, ':');
        }
        if (this.settings.tenTime) {
            this.settings.tenTime = this.settings.tenTime.replace(/\D/g, ':');
            if (this.settings.tenTime.indexOf("00:") == 0) {
                this.settings.tenTime = this.settings.tenTime.substring(3);
            }
        }
        if (this.settings.halfTime) {
            this.settings.halfTime = this.settings.halfTime.replace(/\D/g, ':');
        }
    };
    DrillData.prototype.getTimeForDistance = function (distance, speedRef) {
        var result = 0;
        for (var i in this.timesPerDistance) {
            //console.log("loop:"+this.timesPerDistance[i].distance);
            if (this.timesPerDistance[i].distanceMeters == distance) {
                //console.log("found dist:"+ distance+":"+speedRef);
                if (speedRef == '5') {
                    result = this.timeToSeconds(this.timesPerDistance[i].timeFive);
                    break;
                }
                else if (speedRef == '10') {
                    result = this.timeToSeconds(this.timesPerDistance[i].timeTen);
                    break;
                }
                else if (speedRef == '21') {
                    result = this.timeToSeconds(this.timesPerDistance[i].timeHalf);
                    break;
                }
                else if (speedRef == 'i') {
                    result = this.timeToSeconds(this.timesPerDistance[i].timeInt);
                    break;
                }
                else if (speedRef == 'x') {
                    result = this.timeToSeconds(this.timesPerDistance[i].timeExt);
                    break;
                }
            }
        }
        //console.log("result:"+result); 		
        return result;
    };
    DrillData.prototype.parseTime = function (time) {
        var len = time.length;
        var i;
        if (len == 4 && parseInt(time[2]) >= 0) {
            time = time.substring(0, 2) + ":" + time.substring(2, 7);
            len++;
        }
        if (len == 7) {
            if (time[0] != '0') {
                time = '0' + time;
                len++;
            }
            if (parseInt(time[5]) >= 0) {
                time = time.substring(0, 5) + ":" + time.substring(5, 7);
                len++;
            }
        }
        var result = time;
        for (i = 0; i < len; i++) {
            if (i != 2 && i != 5) {
                if (parseInt(time[i]) >= 0) {
                    console.log("parsed(" + i + "):" + time[i]);
                }
                else {
                    console.log("not parsed(" + i + "):" + time[i]);
                    break;
                }
            }
        }
        if (i == 2) {
            result += ":";
            i++;
        }
        result = result.replace(".", ":");
        return result.substring(0, i);
    };
    DrillData.prototype.calcAllIntervalTimes = function () {
        var intervalsForTen = this.getDropDownIntervalsForTen();
        var intervalsForFive = this.getDropDownIntervalsForFive();
        this.allIntervalTimes = [];
        for (var i in intervalsForFive) {
            var timesPerDistance = this.calcTimesPerDistance(intervalsForFive[i], '', '');
            console.debug("handle interval:" + intervalsForFive[i] + ":", timesPerDistance);
            for (var j in timesPerDistance) {
                this.allIntervalTimes;
                timesPerDistance.distance;
            }
        }
        for (var i in intervalsForTen) {
            var timesPerDistance = this.calcTimesPerDistance('', intervalsForTen[i], '');
            console.debug("handle interval:" + intervalsForTen[i] + ":", timesPerDistance);
        }
        /*


        arr['10K']['int'][100][0]['pace'] = ...
        arr['10K']['int'][100][0]['time'] = ...

        */
    };
    DrillData.prototype.calcTimesPerDistanceForSettings = function () {
        var distances = [100, 200, 300, 400, 500, 600, 700, 800, 900, 1000, 1200, 1500, 2000, 3000];
        this.timesPerDistance = [];
        var timeSecsFive = this.timeToSeconds(fiveTime);
        var timeSecsTen = this.timeToSeconds(tenTime);
        var timeSecsHalf = this.timeToSeconds(halfTime);
        if (timeSecsFive > 0 && timeSecsTen == 0) {
            //timeSecsTen = Math.floor(timeSecsFive*2.085);
            timeSecsTen = Math.floor(timeSecsFive * (AppSettings.tempos['wds']['10k'] / AppSettings.tempos['wds']['5k']));
            this.settings.tenTime = this.secondsToTime(timeSecsTen);
        }
        if (timeSecsTen > 0 && timeSecsHalf == 0) {
            //timeSecsHalf = Math.floor(timeSecsTen*2.20625);
            timeSecsHalf = Math.floor(timeSecsTen * (AppSettings.tempos['wds']['21k'] / AppSettings.tempos['wds']['10k']));
            this.settings.halfTime = this.secondsToTime(timeSecsHalf);
        }
        if (timeSecsTen > 0 && timeSecsFive == 0) {
            //timeSecsFive = Math.floor(timeSecsTen/2.085);
            timeSecsFive = Math.floor(timeSecsTen * (AppSettings.tempos['wds']['5k'] / AppSettings.tempos['wds']['10k']));
            this.settings.fiveTime = this.secondsToTime(timeSecsFive);
        }
        this.calcTimesPerDistance(fiveTime, string, tenTime, string, halfTime, string);
    };
    DrillData.prototype.calcTimesPerDistance = function (timeSecsFive, tenTime, halfTime) {
        var distances = [100, 200, 300, 400, 500, 600, 700, 800, 900, 1000, 1200, 1500, 2000, 3000];
        this.timesPerDistance = [];
        var timeSecsFive = this.timeToSeconds(fiveTime);
        var timeSecsTen = this.timeToSeconds(tenTime);
        var timeSecsHalf = this.timeToSeconds(halfTime);
        if (timeSecsFive > 0 && timeSecsTen == 0) {
            //timeSecsTen = Math.floor(timeSecsFive*2.085);
            timeSecsTen = Math.floor(timeSecsFive * (AppSettings.tempos['wds']['10k'] / AppSettings.tempos['wds']['5k']));
            this.settings.tenTime = this.secondsToTime(timeSecsTen);
        }
        if (timeSecsTen > 0 && timeSecsHalf == 0) {
            //timeSecsHalf = Math.floor(timeSecsTen*2.20625);
            timeSecsHalf = Math.floor(timeSecsTen * (AppSettings.tempos['wds']['21k'] / AppSettings.tempos['wds']['10k']));
            this.settings.halfTime = this.secondsToTime(timeSecsHalf);
        }
        if (timeSecsTen > 0 && timeSecsFive == 0) {
            //timeSecsFive = Math.floor(timeSecsTen/2.085);
            timeSecsFive = Math.floor(timeSecsTen * (AppSettings.tempos['wds']['5k'] / AppSettings.tempos['wds']['10k']));
            this.settings.fiveTime = this.secondsToTime(timeSecsFive);
        }
        var baseInt = timeSecsTen / 10;
        for (var i = 0; i < distances.length; i++) {
            var distance = distances[i];
            var timeStrFive = this.secondsToTime(Math.floor((distance / 5000) * timeSecsFive));
            var timeStrTen = this.secondsToTime(Math.floor((distance / 10000) * timeSecsTen));
            var timeStrHalf = this.secondsToTime(Math.floor((distance / 21100) * timeSecsHalf));
            var timeStrInt = '';
            if (typeof AppSettings.tempos['int'][distance + 'm'] !== "undefined") {
                timeStrInt = this.secondsToTime(Math.floor(baseInt * AppSettings.tempos['int'][distance + 'm']));
            }
            var timeStrExt = '';
            if (typeof AppSettings.tempos['ext'][distance + 'm'] !== "undefined") {
                timeStrExt = this.secondsToTime(Math.floor(baseInt * AppSettings.tempos['ext'][distance + 'm']));
            }
            this.timesPerDistance.push({ distanceMeters: distance, distance: distance + "", timeFive: timeStrFive,
                timeTen: timeStrTen, timeHalf: timeStrHalf, timeInt: timeStrInt, timeExt: timeStrExt });
        }
        return this.timesPerDistance;
    };
    DrillData.prototype.timeToSeconds = function (timeStr) {
        // time to seconds
        var timeSecs = 0;
        if (timeStr.indexOf(":")) {
            if (timeStr.length == 5) {
                timeStr = "00:" + timeStr;
            }
            var arr = timeStr.split(":");
            if (arr.length === 3) {
                var hours = parseInt(arr[0]);
                var minutes = parseInt(arr[1]);
                var seconds = parseInt(arr[2]);
                if (!(isNaN(hours) || isNaN(minutes) || isNaN(seconds))) {
                    timeSecs = hours * 3600 + minutes * 60 + seconds;
                }
            }
        }
        return timeSecs;
    };
    DrillData.prototype.secondsToTime = function (timeSecs) {
        var hours = Math.floor(timeSecs / 3600);
        var minutes = Math.floor((timeSecs - (hours * 3600)) / 60);
        var seconds = timeSecs - (hours * 3600) - (minutes * 60);
        var strHours = "" + hours;
        var strMinutes = "" + minutes;
        var strSeconds = "" + seconds;
        if (hours < 10) {
            strHours = "0" + hours;
        }
        if (minutes < 10) {
            strMinutes = "0" + minutes;
        }
        if (seconds < 10) {
            strSeconds = "0" + seconds;
        }
        if (hours > 0) {
            return strHours + ":" + strMinutes + ':' + strSeconds;
        }
        else {
            return strMinutes + ':' + strSeconds;
        }
    };
    DrillData.prototype.getRequestOptions = function () {
        var headers = new Headers();
        //headers.append('Content-Type', 'application/json');
        return new RequestOptions({ headers: headers });
    };
    DrillData.prototype.setCurrentTrainingSession = function (trainingSession) {
        this.trainingSession = trainingSession;
    };
    DrillData.prototype.setCurrentTrainingDrill = function (drill) {
        this.drill = drill;
        //this.drillIdx = drillIdx;
    };
    DrillData.prototype.hasNextTrainingsDrill = function () {
        return this.trainingSession.drills.length > (this.drillIdx + 1) && (this.drillIdx + 1) >= 0;
    };
    DrillData.prototype.hasPrevTrainingsDrill = function () {
        return this.trainingSession.drills.length > (this.drillIdx - 1) && (this.drillIdx - 1) >= 0;
    };
    return DrillData;
}());
DrillData = __decorate([
    Injectable(),
    __metadata("design:paramtypes", [Http, UserData])
], DrillData);
export { DrillData };
//# sourceMappingURL=drill-data.js.map
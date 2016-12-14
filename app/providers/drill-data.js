"use strict";
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};
var core_1 = require('@angular/core');
var http_1 = require('@angular/http');
var app_settings_1 = require('./app-settings');
var ionic_native_1 = require('ionic-native');
require('rxjs/add/operator/map');
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
    function DrillData(http) {
        this.isConnected = true;
        if (ionic_native_1.Network.connection == "none") {
            this.isConnected = false;
        }
        this.http = http;
        this.errorMessage = '';
        this.initSettings();
        this.initDrillFilters();
    }
    Object.defineProperty(DrillData, "parameters", {
        get: function () {
            return [[http_1.Http]];
        },
        enumerable: true,
        configurable: true
    });
    DrillData.prototype.handleError = function (error) {
        // In a real world app, we might use a remote logging infrastructure
        // We'd also dig deeper into the error to get a better message
        var errMsg = (error.message) ? error.message :
            error.status ? error.status + " - " + error.statusText : 'Server error';
        console.error(errMsg); // log to console instead
        this.errorMessage = 'Server error';
        return Promise.reject(errMsg);
    };
    DrillData.prototype.getTrainingSessions = function () {
        var _this = this;
        console.log("getTrainingSessions...");
        return this.http.get(app_settings_1.AppSettings.BASE_API_URL + "/trainingsessions", this.getRequestOptions()).map(function (res) {
            var result = res.json();
            if (result.status === false) {
                _this.errorMessage = result.message;
                return _this.trainingSessions;
            }
            else {
                _this.trainingSessions = result.data;
                console.debug("getTrainingSessions:", _this.trainingSessions);
                localStorage.setItem("trainingSessions", JSON.stringify(_this.trainingSessions));
                return _this.trainingSessions;
            }
        });
    };
    DrillData.prototype.getCachedSessions = function () {
        var localTrainingsSession = localStorage.getItem("trainingSessions");
        if (localTrainingsSession !== null) {
            this.trainingSessions = JSON.parse(localTrainingsSession);
        }
        console.debug("getCachedSessions", localTrainingsSession);
        return this.trainingSessions;
    };
    DrillData.prototype.initSettings = function () {
        var localSettings = localStorage.getItem("settings");
        if (localSettings == null) {
            this.settings = { showSummary: false, fiveTime: "", tenTime: "" };
            localStorage.setItem("settings", JSON.stringify(this.settings));
        }
        else {
            this.settings = JSON.parse(localSettings);
        }
        console.debug("Init Settings:", this.settings);
        this.calcTimesPerDistance();
    };
    DrillData.prototype.initDrillFilters = function () {
        var localDrillFilter = localStorage.getItem("drillFilters");
        if (localDrillFilter == null) {
            this.drillFilters = [
                { title: "Inleiding", value: true },
                { title: "Warming up", value: true },
                { title: "Core Stability", value: true },
                { title: "Kring", value: true },
                { title: "Vierkant", value: true },
                { title: "400m Baan", value: true },
                { title: "Loopscholing", value: true },
                { title: "Tussenprogramma", value: true },
                { title: "Hoofdprogramma", value: true },
                { title: "Overig", value: true }
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
        if (this.settings.tenTime) {
            this.settings.tenTime = this.settings.tenTime.replace(/\D/g, ':');
            if (this.settings.tenTime.indexOf("00:") == 0) {
                this.settings.tenTime = this.settings.tenTime.substring(3);
            }
        }
        if (this.settings.fiveTime) {
            this.settings.fiveTime = this.settings.fiveTime.replace(/\D/g, ':');
        }
        if (this.settings.halfMarathonTime) {
            this.settings.halfMarathonTime = this.settings.fiveTime.replace(/\D/g, ':');
        }
    };
    DrillData.prototype.setCurrentTrainingSession = function (trainingSession) {
        this.trainingSession = trainingSession;
    };
    DrillData.prototype.setCurrentTrainingDrill = function (drill) {
        this.drill = drill;
    };
    DrillData.prototype.calcTimesPerDistance = function () {
        var distances = [100, 200, 300, 400, 500, 600, 700, 800, 900, 1000, 1200, 1500, 2000, 3000];
        this.timesPerDistance = [];
        var timeSecsFive = this.timeToSeconds(this.settings.fiveTime);
        var timeSecsTen = this.timeToSeconds(this.settings.tenTime);
        for (var i = 0; i < distances.length; i++) {
            var distance = distances[i];
            var timeStrFive = this.secondsToTime(Math.floor((distance / 5000) * timeSecsFive));
            var timeStrTen = this.secondsToTime(Math.floor((distance / 10000) * timeSecsTen));
            this.timesPerDistance.push({ distance: distance + " meter", timeFive: timeStrFive, timeTen: timeStrTen });
        }
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
        return strMinutes + ':' + strSeconds;
    };
    DrillData.prototype.getRequestOptions = function () {
        var headers = new http_1.Headers();
        //headers.append('Content-Type', 'application/json');
        return new http_1.RequestOptions({ headers: headers });
    };
    DrillData = __decorate([
        core_1.Injectable(), 
        __metadata('design:paramtypes', [http_1.Http])
    ], DrillData);
    return DrillData;
}());
exports.DrillData = DrillData;

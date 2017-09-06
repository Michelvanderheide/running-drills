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
import { DrillData } from "../../providers/drill-data";
import { NativeAudio } from '@ionic-native/native-audio';
//import { Geolocation, Geoposition } from '@ionic-native/geolocation';
import { AppSettings } from '../../providers/app-settings';
var TimerPage = (function () {
    function TimerPage(drillData, nativeAudio) {
        this.nativeAudio = nativeAudio;
        this.intervalIdx = 0;
        this.stActive = 'background:blue';
        this.countdownTime = 0;
        this.intervalDistance = 0;
        //private totalIntervalDistance = 0;
        this.prevLatLong = { lat: 0, lon: 0 };
        this.drillData = drillData;
        this.initIntervals(drillData.trainingSession.intervals);
        this.nativeAudio.preloadSimple('countdown', 'build/audio/countdown-5.mp3').then(function () { }, function () { });
        this.countdownTime = 5;
        if (AppSettings.isNative) {
            this.countdownTime = 5;
        }
    }
    TimerPage.prototype.ngOnDestroy = function () {
        console.log("leave...");
        clearTimeout(this.timeOut);
    };
    TimerPage.prototype.initIntervals = function (strIntervals) {
        //"200mv-100mp-e5,200mv,100mp,200mv,100mp,200mv,100mp,200mv,100mp,200mv,100mp,200mv,100mp,200mv,100mp,...."
        var arrIntervals = strIntervals.replace(/\s/g, '').split(",");
        this.intervals = [];
        for (var i in arrIntervals) {
            //let strVlot = '', strPauze = '';
            var arrVP = [];
            var speedRef = null;
            var strItemP = null;
            var strItemV = null;
            if (arrIntervals[i].search('-') > 0) {
                arrVP = arrIntervals[i].split('-');
            }
            else {
                arrVP.push(arrIntervals[i]);
            }
            var item = {
                distance: 0,
                time: 0,
                timeRest: 0,
                styleActive: 0,
                displayTime: '00:00',
                displayTimeRest: '00:00'
            };
            // determine subitems
            for (var j in arrVP) {
                var strItem = arrVP[j];
                strItem = strItem.toLowerCase();
                console.log("strItem:" + strItem);
                if (strItem.search('p') > 0) {
                    // pauze
                    strItemP = strItem.replace('p', '');
                }
                else if (strItem.search('v') > 0) {
                    // vlot
                    strItemV = strItem.replace('v', '');
                }
                else if (strItem.search('e') !== -1) {
                    speedRef = strItem.replace('e', '');
                }
                else if (strItem.search('i') !== -1) {
                    speedRef = strItem.toLowerCase();
                }
                else if (strItem.search('x') !== -1) {
                    speedRef = strItem.toLowerCase();
                }
            }
            console.log("e:" + speedRef + ":" + strItemP + ":" + strItemV);
            if (strItemP != null) {
                if (strItemP.search('m') !== -1) {
                    item.timeRest = Math.round(1.5 * this.calcTime(parseInt(strItemP.replace('m', '')), speedRef));
                }
                else if (strItemP.search('s') !== -1) {
                    item.timeRest = parseInt(strItemP.replace('s', ''));
                }
            }
            if (strItemV != null) {
                if (strItemV.search('m') !== -1) {
                    // meters
                    item.distance = parseInt(strItemV.replace('m', ''));
                    item.time = this.calcTime(item.distance, speedRef);
                }
                else if (strItemV.search('s') !== -1) {
                    // seconds, convert to meters
                    //item.distance = this.calcDistance(strItemV, speedRef);
                    item.time = parseInt(strItemV.replace('s', ''));
                }
            }
            console.debug("item:", item);
            item.displayTimeRest = this.getSecondsAsDigitalClock(item.timeRest);
            item.displayTime = this.getSecondsAsDigitalClock(item.time);
            if (item.time > 0) {
                this.intervals.push(item);
            }
        }
        console.debug("Int:", this.intervals);
    };
    TimerPage.prototype.calcTime = function (distance, speedRef) {
        return this.drillData.getTimeForDistance(distance, speedRef);
    };
    TimerPage.prototype.calcDistance = function (time, speedRef) {
        return this.drillData.getTimeForDistance(time, speedRef);
    };
    TimerPage.prototype.ngOnInit = function () {
        this.initTimer();
    };
    TimerPage.prototype.hasFinished = function () {
        return this.timer.hasFinished;
    };
    TimerPage.prototype.initTimer = function () {
        this.intervalIdx = 0;
        this.timeInSeconds = this.intervals[this.intervalIdx].time;
        this.timer = {
            seconds: this.timeInSeconds,
            runTimer: false,
            hasStarted: false,
            hasFinished: false,
            secondsRemaining: this.timeInSeconds,
            hasRest: false
        };
        this.trackDistance();
        this.timer.displayTime = this.getSecondsAsDigitalClock(this.timer.secondsRemaining);
        console.debug('clock:', this.timer);
    };
    TimerPage.prototype.startCountdown = function () {
        console.log("startCountdown");
        if (this.countdownTime > 0) {
            this.nativeAudio.play('countdown', function () {
                console.log('uniqueId1 is done playing');
            });
        }
    };
    TimerPage.prototype.trackDistance = function () {
        var options = {
            enableHighAccuracy: true
        };
        console.log("getPosition");
        /*		this.watch = Geolocation.watchPosition(options).subscribe(pos => {
                    console.debug(":",pos);
                    let position = <Geoposition> pos;
                    console.log('lat: ' + position.coords.latitude + ', lon: ' + position.coords.longitude);
                    let lat:number = position.coords.latitude;
                    let lon:number = position.coords.longitude;
                    //let lon2:number = position.coords.longitude+0.2;
                    //lat: 52.2374485, lon: 6.586051899999999
                    console.debug("prevLatLong",this.prevLatLong);
                    if (this.prevLatLong.lat > 0 && this.prevLatLong.lon > 0) {
                        let distance = this.getDistanceFromLatLonInKm(this.prevLatLong.lat,this.prevLatLong.lon,lat,lon);
                        this.intervalDistance += distance;
                        if (this.timer.runTimer && !this.timer.hasRest) {
                            this.totalIntervalDistance += distance;
                        }
                    }
                    this.prevLatLong = {lat: lat, lon:lon};
        
                });*/
    };
    TimerPage.prototype.getDistanceFromLatLonInKm = function (lat1, lon1, lat2, lon2) {
        var R = 6371; // Radius of the earth in km
        var dLat = this.deg2rad(lat2 - lat1); // deg2rad below
        var dLon = this.deg2rad(lon2 - lon1);
        var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
            Math.cos(this.deg2rad(lat1)) * Math.cos(this.deg2rad(lat2)) *
                Math.sin(dLon / 2) * Math.sin(dLon / 2);
        var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        var d = R * c; // Distance in km
        d = Math.round(d * 1000);
        console.log("dist:" + d);
        return d;
    };
    TimerPage.prototype.deg2rad = function (deg) {
        return deg * (Math.PI / 180);
    };
    TimerPage.prototype.startTimer = function (idx) {
        clearTimeout(this.timeOut);
        this.intervalDistance = 0;
        this.prevLatLong = { lat: 0, lon: 0 };
        this.intervals[this.intervalIdx].styleActive = 0;
        this.intervalIdx = idx;
        this.timer.hasStarted = true;
        this.timer.runTimer = true;
        this.intervals[this.intervalIdx].styleActive = 1;
        this.timer.secondsRemaining = this.intervals[this.intervalIdx].time;
        this.timerTick();
    };
    TimerPage.prototype.pauseTimer = function (item) {
        this.timer.runTimer = false;
    };
    TimerPage.prototype.resumeTimer = function (item) {
        this.timer.runTimer = true;
        this.timerTick();
    };
    TimerPage.prototype.resumeOrPauseTimer = function () {
        clearTimeout(this.timeOut);
        if (!this.timer.hasStarted) {
            this.startTimer(0);
        }
        else {
            if (this.timer.runTimer) {
                this.timer.runTimer = false;
            }
            else {
                this.timer.runTimer = true;
                this.timerTick();
            }
        }
    };
    TimerPage.prototype.delayTimer = function (timeSecs) {
        this.timer.secondsRemaining += timeSecs;
    };
    TimerPage.prototype.endStepNow = function () {
        this.timer.secondsRemaining = 1;
    };
    TimerPage.prototype.setIntervalIdx = function (idx) {
        this.intervalIdx = idx;
        return true;
    };
    TimerPage.prototype.hasMoreIntervals = function () {
        return (this.intervalIdx < (this.intervals.length - 1));
    };
    TimerPage.prototype.timerTick = function () {
        var _this = this;
        //this.watch.unsubscribe();
        if ((this.timer.secondsRemaining % 4) == 0) {
            this.trackDistance();
        }
        this.timeOut = setTimeout(function () {
            if (!_this.timer.runTimer) {
                return;
            }
            _this.timer.secondsRemaining--;
            _this.timer.displayTime = _this.getSecondsAsDigitalClock(_this.timer.secondsRemaining);
            if ((_this.timer.secondsRemaining) > 0) {
                if ((_this.timer.secondsRemaining - _this.countdownTime) == 0) {
                    clearTimeout(_this.countdownTimeout);
                    _this.countdownTimeout = setTimeout(_this.startCountdown());
                }
                _this.timerTick();
            }
            else {
                if (_this.timer.hasRest) {
                    console.log("hasRest 1");
                    _this.intervals[_this.intervalIdx].styleActive = 0;
                    if (_this.hasMoreIntervals()) {
                        _this.intervalDistance = 0;
                        _this.intervalIdx++;
                        _this.intervals[_this.intervalIdx].styleActive = 1;
                        _this.timer.secondsRemaining = _this.intervals[_this.intervalIdx].timeRest;
                        _this.timer.hasRest = false;
                        _this.timerTick();
                    }
                    else {
                        console.log("finished");
                        _this.timer.hasFinished = true;
                    }
                }
                else {
                    console.log("hasNo Rest");
                    //this.startTimerCountdown();	
                    // evaluate time/distance
                    _this.intervalResult = "";
                    if (_this.intervals[_this.intervalIdx].distance > 10 && _this.intervalDistance > 40) {
                        var diff = _this.intervalDistance - _this.intervals[_this.intervalIdx].distance;
                        var offset = (Math.abs(diff) / _this.intervals[_this.intervalIdx].distance) * 100;
                        if (offset < 80 && offset > 5) {
                            if (diff > 0) {
                                _this.intervalResult = Math.round(diff) + " m te snel";
                            }
                            if (diff < 0) {
                                _this.intervalResult = Math.round(-1 * diff) + " m te langzaam";
                            }
                            else {
                                _this.intervalResult = "Juiste snelheid";
                            }
                        }
                    }
                    _this.timer.hasRest = true;
                    _this.intervals[_this.intervalIdx].styleActive = 2;
                    _this.timer.secondsRemaining = _this.intervals[_this.intervalIdx].timeRest;
                    _this.timerTick();
                }
            }
        }, 1000);
    };
    TimerPage.prototype.getSecondsAsDigitalClock = function (inputSeconds) {
        var sec_num = parseInt(inputSeconds.toString(), 10); // don't forget the second param
        var hours = Math.floor(sec_num / 3600);
        var minutes = Math.floor((sec_num - (hours * 3600)) / 60);
        var seconds = sec_num - (hours * 3600) - (minutes * 60);
        var hoursString = '';
        var minutesString = '';
        var secondsString = '';
        hoursString = (hours < 10) ? "0" + hours : hours.toString();
        minutesString = (minutes < 10) ? "0" + minutes : minutes.toString();
        secondsString = (seconds < 10) ? "0" + seconds : seconds.toString();
        return minutesString + ':' + secondsString;
    };
    return TimerPage;
}());
TimerPage = __decorate([
    Component({
        templateUrl: 'timer.html'
    }),
    __metadata("design:paramtypes", [DrillData, NativeAudio])
], TimerPage);
export { TimerPage };
//# sourceMappingURL=timer.js.map
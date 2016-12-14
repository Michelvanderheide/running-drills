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
var ionic_angular_1 = require('ionic-angular');
var UserData = (function () {
    function UserData(events, http) {
        this.events = events;
        this._favorites = [];
        this.HAS_LOGGED_IN = 'hasLoggedIn';
        this.http = http;
        this.initRunningGroups();
    }
    Object.defineProperty(UserData, "parameters", {
        get: function () {
            return [[ionic_angular_1.Events], [http_1.Http]];
        },
        enumerable: true,
        configurable: true
    });
    UserData.prototype.initRunningGroups = function () {
        var localRunningGroups = localStorage.getItem("runningGroups");
        if (localRunningGroups == null) {
            this.runningGroups = [
                { title: "Kettinglopers", name: "kettinglopers", value: true },
                { title: "AV - Goor", name: "avgoor", value: true },
                { title: "MPM - Hengelo", name: "mpm", value: true }
            ];
            localStorage.setItem("runningGroups", JSON.stringify(this.runningGroups));
        }
        else {
            this.runningGroups = JSON.parse(localRunningGroups);
        }
    };
    UserData.prototype.toggleRunningGroup = function (idx) {
        this.runningGroups[idx].value = (!this.runningGroups[idx].value);
        localStorage.setItem("runningGroups", JSON.stringify(this.runningGroups));
    };
    UserData.prototype.setRunningGroups = function (runningGroups) {
        localStorage.setItem("runningGroups", JSON.stringify(this.runningGroups));
    };
    UserData.prototype.hasFavorite = function (sessionName) {
        return (this._favorites.indexOf(sessionName) > -1);
    };
    UserData.prototype.addFavorite = function (sessionName) {
        this._favorites.push(sessionName);
    };
    UserData.prototype.removeFavorite = function (sessionName) {
        var index = this._favorites.indexOf(sessionName);
        if (index > -1) {
            this._favorites.splice(index, 1);
        }
    };
    UserData.prototype.login = function (username) {
        localStorage.setItem(this.HAS_LOGGED_IN, 'true');
        this.setUsername(username);
        this.events.publish('user:login');
    };
    UserData.prototype.signup = function (username) {
        localStorage.setItem(this.HAS_LOGGED_IN, 'true');
        this.setUsername(username);
        this.events.publish('user:signup');
    };
    UserData.prototype.logout = function () {
        localStorage.removeItem(this.HAS_LOGGED_IN);
        localStorage.removeItem('username');
        this.events.publish('user:logout');
    };
    UserData.prototype.setUsername = function (username) {
        return localStorage.setItem('username', username);
    };
    UserData.prototype.getUsername = function () {
        return localStorage.getItem('username');
    };
    UserData.prototype.getUserToken = function () {
        this.userToken = localStorage.getItem('userToken');
        if (!this.userToken) {
            this.userToken = this.guid();
        }
    };
    UserData.prototype.setUserToken = function (userToken) {
        return localStorage.setItem('userToken', userToken);
    };
    // return a promise
    UserData.prototype.hasLoggedIn = function () {
        return false;
        //return (localStorage.getItem(this.HAS_LOGGED_IN) === 'true');
    };
    UserData.prototype.guid = function () {
        function s4() {
            return Math.floor((1 + Math.random()) * 0x10000)
                .toString(16)
                .substring(1);
        }
        return s4() + s4() + '-' + s4() + '-' + s4() + '-' +
            s4() + '-' + s4() + s4() + s4();
    };
    UserData = __decorate([
        core_1.Injectable(), 
        __metadata('design:paramtypes', [ionic_angular_1.Events, http_1.Http])
    ], UserData);
    return UserData;
}());
exports.UserData = UserData;

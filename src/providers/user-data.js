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
import { Http } from '@angular/http';
import { Events } from 'ionic-angular';
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
            return [[Events], [Http]];
        },
        enumerable: true,
        configurable: true
    });
    UserData.prototype.initRunningGroups = function () {
        this.initialized = localStorage.getItem("initialized") != null;
        var localRunningGroups = localStorage.getItem("runningGroups");
        if (localRunningGroups == null) {
            this.runningGroups = [
                { title: "Clinic 5 km", name: "clinic-5k", value: false },
                { title: "Clinic 10 km", name: "clinic-10k", value: false },
                { title: "AV Goor", name: "avgoor", value: false },
                { title: "MPM - Hengelo", name: "mpm", value: false }
            ];
            localStorage.setItem("runningGroups", JSON.stringify(this.runningGroups));
        }
        else {
            this.runningGroups = JSON.parse(localRunningGroups);
        }
    };
    UserData.prototype.isInitialized = function () {
        return this.initialized;
    };
    UserData.prototype.setInitialized = function () {
        localStorage.setItem("initialized", "true");
    };
    UserData.prototype.toggleRunningGroup = function (idx) {
        this.runningGroups[idx].value = (!this.runningGroups[idx].value);
        localStorage.setItem("runningGroups", JSON.stringify(this.runningGroups));
    };
    UserData.prototype.setRunningGroups = function (runningGroups) {
        localStorage.setItem("runningGroups", JSON.stringify(this.runningGroups));
    };
    UserData.prototype.getRunningGroups = function () {
        return this.runningGroups;
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
    return UserData;
}());
UserData = __decorate([
    Injectable(),
    __metadata("design:paramtypes", [Events, Http])
], UserData);
export { UserData };
//# sourceMappingURL=user-data.js.map
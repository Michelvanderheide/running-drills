import { Injectable } from '@angular/core';
import { Http, Headers, RequestOptions } from '@angular/http';
import { Events } from 'ionic-angular';
import { AppSettings } from './app-settings';


@Injectable()
export class UserData {
  _favorites = [];
  private runningGroups: RunningGroup[];
  HAS_LOGGED_IN = 'hasLoggedIn';
  private http: Http;
  private userToken: String;

  static get parameters(){
    return [[Events],[Http]];
  }
  constructor(public events: Events, http: Http) {
    this.http = http;
    this.initRunningGroups();
  }

  initRunningGroups() {
    let localRunningGroups = localStorage.getItem("runningGroups");
    if (localRunningGroups ==  null) {
      this.runningGroups = [ 
          {title: "Kettinglopers", name:"kettinglopers", value: true},
          {title: "AV - Goor", name:"avgoor", value: true},
          {title: "MPM - Hengelo", name:"mpm", value: true}
         ];

      localStorage.setItem("runningGroups", JSON.stringify(this.runningGroups));
    } else {
      this.runningGroups = JSON.parse(localRunningGroups);
    }
  }

  public toggleRunningGroup(idx) {
    this.runningGroups[idx].value = (!this.runningGroups[idx].value);
    localStorage.setItem("runningGroups", JSON.stringify(this.runningGroups));
  }

  setRunningGroups(runningGroups) {
    localStorage.setItem("runningGroups", JSON.stringify(this.runningGroups));
  }

  getRunningGroups():RunningGroup[] {
    return this.runningGroups;
  }

  hasFavorite(sessionName) {
    return (this._favorites.indexOf(sessionName) > -1);
  }

  addFavorite(sessionName) {
    this._favorites.push(sessionName);
  }

  removeFavorite(sessionName) {
    let index = this._favorites.indexOf(sessionName);
    if (index > -1) {
      this._favorites.splice(index, 1);
    }
  }

  login(username) {
    localStorage.setItem(this.HAS_LOGGED_IN, 'true');
    this.setUsername(username);
    this.events.publish('user:login');
  }

  signup(username) {
    localStorage.setItem(this.HAS_LOGGED_IN, 'true');
    this.setUsername(username);
    this.events.publish('user:signup');
  }

  logout() {
    localStorage.removeItem(this.HAS_LOGGED_IN);  
    localStorage.removeItem('username');
    this.events.publish('user:logout');
  }

  setUsername(username) {
    return localStorage.setItem('username', username);
  }

  getUsername() {
    return localStorage.getItem('username');
  }

  getUserToken() {
    this.userToken = localStorage.getItem('userToken');
    if (!this.userToken) {
      this.userToken = this.guid();
    }

  }

  setUserToken(userToken) {
    return localStorage.setItem('userToken', userToken);
  }

  // return a promise
  hasLoggedIn() {
    return false; 
    //return (localStorage.getItem(this.HAS_LOGGED_IN) === 'true');

  }

  guid() {
    function s4() {
    return Math.floor((1 + Math.random()) * 0x10000)
    .toString(16)
    .substring(1);
    }
    return s4() + s4() + '-' + s4() + '-' + s4() + '-' +
    s4() + '-' + s4() + s4() + s4();
  }
}
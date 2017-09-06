import { Injectable } from '@angular/core';
import { Http } from '@angular/http';
import { Events } from 'ionic-angular';


@Injectable()
export class UserData {
  private _favorites:any[] = [];
  private runningGroups: RunningGroup[];
  HAS_LOGGED_IN = 'hasLoggedIn';
  private http: Http;
  private userToken: String;
  private initialized: boolean;

  static get parameters(){
    return [[Events],[Http]];
  }
  constructor(public events: Events, http: Http) {
    this.http = http;
    this.initRunningGroups();
  }

  initRunningGroups() {
    this.initialized = localStorage.getItem("initialized") != null;
    let localRunningGroups = localStorage.getItem("runningGroups");
    if (localRunningGroups ==  null) {
      this.runningGroups = [ 
          {title: "Clinic 5 km", name:"clinic-5k", value: false},
          {title: "Clinic 10 km", name:"clinic-10k", value: false},
          {title: "AV Goor", name:"avgoor", value: false},
          {title: "MPM - Hengelo", name:"mpm", value: false}
         ];

      localStorage.setItem("runningGroups", JSON.stringify(this.runningGroups));
    } else {
      this.runningGroups = JSON.parse(localRunningGroups);
    }
  }

  public isInitialized() {
    return this.initialized;
  }

  public setInitialized() {
    localStorage.setItem("initialized", "true");
  }

  public toggleRunningGroup(idx: number) {
    this.runningGroups[idx].value = (!this.runningGroups[idx].value);
    localStorage.setItem("runningGroups", JSON.stringify(this.runningGroups));
  }

  setRunningGroups(runningGroups: string) {
    localStorage.setItem("runningGroups", JSON.stringify(this.runningGroups));
  }

  getRunningGroups():RunningGroup[] {
    return this.runningGroups;
  }

  hasFavorite(sessionName: string) {
    return (this._favorites.indexOf(sessionName) > -1);
  }

  addFavorite(sessionName: string) {
    this._favorites.push(sessionName);
  }

  removeFavorite(sessionName: string) {
    let index = this._favorites.indexOf(sessionName);
    if (index > -1) {
      this._favorites.splice(index, 1);
    }
  }

  login(username: string) {
    localStorage.setItem(this.HAS_LOGGED_IN, 'true');
    this.setUsername(username);
    this.events.publish('user:login');
  }

  signup(username: string) {
    localStorage.setItem(this.HAS_LOGGED_IN, 'true');
    this.setUsername(username);
    this.events.publish('user:signup');
  }

  logout() {
    localStorage.removeItem(this.HAS_LOGGED_IN);  
    localStorage.removeItem('username');
    this.events.publish('user:logout');
  }

  setUsername(username: string) {
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

  setUserToken(userToken: string) {
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
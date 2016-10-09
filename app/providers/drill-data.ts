import {Injectable} from '@angular/core';
import { Http, Headers, RequestOptions } from '@angular/http';
import { AppSettings } from './app-settings';
import {Network, Connection} from 'ionic-native';
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
@Injectable()
export class DrillData {
	private drills: Drill[];
	private drill: Drill;
	private trainingSessions: TrainingSession[];
	private trainingSession: TrainingSession;
	private sessionData: any;
	private http: Http;
	private errorMessage: string;
	private drillFilters: any[];
	public isConnected: boolean;

	static get parameters(){
		return [[Http]];
	}	
	constructor(http: Http) {
		this.isConnected = true;
		if (Network.connection == Connection.NONE) {
			this.isConnected = false;
		}
		this.http = http;
    	this.errorMessage = '';
    	this.initDrillFilters();
	}

	private handleError (error: any) {
		// In a real world app, we might use a remote logging infrastructure
		// We'd also dig deeper into the error to get a better message
		let errMsg = (error.message) ? error.message :
		  error.status ? `${error.status} - ${error.statusText}` : 'Server error';
		console.error(errMsg); // log to console instead
		this.errorMessage = 'Server error';
		return Promise.reject(errMsg);
	}


	getTrainingSessions() {

		return this.http.get(AppSettings.BASE_API_URL + "/trainingsessions", this.getRequestOptions()).toPromise().then(res => {
		    let result = res.json();
			if (result.status === false) {
				this.errorMessage = result.message;
				return this.trainingSessions;
			} else {
				this.trainingSessions = result.data;
				localStorage.setItem("trainingSessions", JSON.stringify(this.trainingSessions));
				return this.trainingSessions;
			}		    
		}).catch(this.handleError);

	}

	getCachedSessions() {

		let localTrainingsSession = localStorage.getItem("trainingSessions");
		if (localTrainingsSession !== null) {
			this.trainingSessions = JSON.parse(localTrainingsSession);
		}
		console.debug("getCachedSessions",localTrainingsSession);
		return this.trainingSessions;
	}

	initDrillFilters() {
		let localDrillFilter = localStorage.getItem("drillFilters");
		if (localDrillFilter ==  null) {
			this.drillFilters = [ 
		      {title: "Warming up", value: true},
		      {title: "Core Stability", value: true},
		      {title: "Kring", value: true},
		      {title: "Vierkant", value: true},
		      {title: "400m Baan", value: true},
		      {title: "Loopscholing", value: true},
		      {title: "Tussenprogramma", value: true},
		      {title: "Hoofdprogramma", value: true},
		      {title: "Overig", value: true}
	   		];

			localStorage.setItem("drillFilters", JSON.stringify(this.drillFilters));
		} else {
			this.drillFilters = JSON.parse(localDrillFilter);
		}
	}

	public getDrillFilters(){
		return this.drillFilters;

	}
	
	public toggleDrillFilter(idx) {
    	this.drillFilters[idx].value = (!this.drillFilters[idx].value);
    	localStorage.setItem("drillFilters", JSON.stringify(this.drillFilters));
 	}

	private getRequestOptions() {
		let headers = new Headers();
		
		//headers.append('Content-Type', 'application/json');
    	return new RequestOptions({ headers: headers });
	}

}

import {Injectable} from '@angular/core';
import { Http, Headers, RequestOptions } from '@angular/http';
import { AppSettings } from './app-settings';
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

	static get parameters(){
		return [[Http]];
	}	
	constructor(http: Http) {
		this.http = http;
    	this.errorMessage = '';
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
		console.log("runningdrils - getTrainingSessions");
		console.log("runningdrils - url:" + AppSettings.BASE_API_URL + "/trainingsessions");
		return this.http.get(AppSettings.BASE_API_URL + "/trainingsessions", this.getRequestOptions()).toPromise().then(res => {
		    let result = res.json();
			if (result.status === false) {
				this.errorMessage = result.message;
				return [];
			} else {
				this.trainingSessions = result.data;
				return this.trainingSessions;
			}		    
		}).catch(this.handleError);		
	}

	private getRequestOptions() {
		let headers = new Headers();
		
		//headers.append('Content-Type', 'application/json');
    	return new RequestOptions({ headers: headers });
	}

}

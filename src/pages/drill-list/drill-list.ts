import { Component } from '@angular/core';
import {NavController, NavParams} from 'ionic-angular';
import { DrillData } from "../../providers/drill-data";


@Component({
	selector: 'drill-list',
	templateUrl: 'drill-list.html'
})
export class DrillListPage {
	static get parameters() {
		return [[NavController], [NavParams], [DrillData]]
	}

	constructor(nav: NavController, navParams: NavParams, public drillData: DrillData) {
	}
}

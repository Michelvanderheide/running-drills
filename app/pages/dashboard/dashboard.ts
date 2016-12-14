import { Page} from 'ionic-angular';

import { NavController } from 'ionic-angular';
import { DrillData } from "../../providers/drill-data";


@Page({
	templateUrl: 'build/pages/dashboard/dashboard.html'
})
export class DashboardPage {
	fiveTime: number;
	dDrillData: DrillData;

	constructor(public navCtrl: NavController, public drillData: DrillData) {
		this.fiveTime = 150;
		this.drillData = drillData;
	}

}
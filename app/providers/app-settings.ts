export class AppSettings {

	public static setDevEnvironment() {
		console.log("set dev environment");
		this.BASE_URL = 'http://runningdrills.local'
		this.BASE_API_URL = this.BASE_URL + '/api'
	}
	public static BASE_URL: string = 'http://www.avgoor.nl';
	public static BASE_API_URL: string = 'http://www.avgoor.nl/api';

	
}


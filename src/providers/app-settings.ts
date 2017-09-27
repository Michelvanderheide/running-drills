export class AppSettings {

	public static setDevEnvironment() {
		console.log("set dev environment");
		//this.BASE_URL = this.BASE_API_URL = 'http://runningdrillsapi.local'; // activate for dev api locally
		this.BASE_URL = 'http://app.kettinglopers.nl';
		this.BASE_API_URL = 'http://api.kettinglopers.nl'; // activate to build android app

	}
	public static BASE_URL: string = 'http://app.kettinglopers.nl';
	public static BASE_API_URL: string = 'http://api.kettinglopers.nl'; //'http://app.kettinglopers.nl/api';
	public static defaultImg:string = 'http://app.kettinglopers.nl/api/images/kettinglopers.png';

	public static isNative:boolean = false;

	public static tempos:any = {
		"wds": {
			"5k": 0.48,
			"10k": 1.00,
			"15k": 1.525,
			"20k": 2.07,
			"21k": 2.279
		},
		ext: {
			"100m": 0.097,
			"200m": 0.19,
			"300m": 0.29,
			"400m": 0.38,
			"500m": 0.497,
			"600m": 0.585,
			"700m": 0.714,
			"800m": 0.80,
			"900m": 0.918,
			"1000m": 1.0,
			"1200m": 1.21,
			"1500m": 1.52			
		},
		int: {
			"100m": 0.082,
			"200m": 0.167,
			"300m": 0.225,
			"400m": 0.342,
			"500m": 0.437,
			"600m": 0.535,
			"700m": 0.617,
			"800m": 0.72,
			"900m": 0.794,
			"1000m": 0.9,
			"1200m": 1.08,
			"1500m": 1.19
		}


//200 m	400 m	600 m	800 m	1000 m	1200 m
//0.167	0.342	0.535	0.72	0.9	1.08

	};

/*

		arr['10K']['int'][100][0]['pace'] = ...
		arr['10K']['int'][100][0]['time'] = ...

		paceAthletes[	name: <string>,
						paceIdx:<number>,
						pace: <string>
						intervalTime: <string>
					]

		paceGroups[	{
					paceIdx:<number>,
					pace: <string>
					intervalTime: <string>,
					athletes: [ <string>,... ]
					} ]


		<groupName> | <pace> | <intervaltime> | <timing-buttons> : <tijd mm:ss>


Timingsbuttons
		Start
		Stop, Ronde
		Reset, Hervatten
									
 

*/
	
}


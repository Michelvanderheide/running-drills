import { Page} from 'ionic-angular';

import { NavController } from 'ionic-angular';
import {FORM_DIRECTIVES, FormBuilder,  ControlGroup, Validators, AbstractControl} from '@angular/common';

import { SignupPage } from '../signup/signup';
import { SessionListPage } from '../session-list/session-list';

import { TabsPage } from '../tabs/tabs';
import { UserData } from '../../providers/user-data';


@Page({
	templateUrl: 'build/pages/login/login.html',
	directives: [FORM_DIRECTIVES]
})
export class LoginPage {
	username:AbstractControl;
	password:AbstractControl;
	authForm: ControlGroup;
	submitted = false;

	constructor(public navCtrl: NavController, public userData: UserData, private fb: FormBuilder) {
			this.authForm = fb.group({  
			'username': ['', Validators.compose([Validators.required])],
			'password': ['', Validators.compose([Validators.required])]
		});

		this.username = this.authForm.controls['username'];
		this.password = this.authForm.controls['password']; 
	}

	onSubmit(login: string): void { 
        if(this.authForm.valid) {
            console.log('Submitted value: ', login);
			this.userData.login(this.username);
			this.navCtrl.push(SessionListPage);            
        }		
	}  

	onSignup() {
		console.log('SignupPage');
		this.navCtrl.push(SignupPage);
	}
}
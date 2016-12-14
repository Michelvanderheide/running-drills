"use strict";
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};
var ionic_angular_1 = require('ionic-angular');
var ionic_angular_2 = require('ionic-angular');
var common_1 = require('@angular/common');
var signup_1 = require('../signup/signup');
var session_list_1 = require('../session-list/session-list');
var user_data_1 = require('../../providers/user-data');
var LoginPage = (function () {
    function LoginPage(navCtrl, userData, fb) {
        this.navCtrl = navCtrl;
        this.userData = userData;
        this.fb = fb;
        this.submitted = false;
        this.authForm = fb.group({
            'username': ['', common_1.Validators.compose([common_1.Validators.required])],
            'password': ['', common_1.Validators.compose([common_1.Validators.required])]
        });
        this.username = this.authForm.controls['username'];
        this.password = this.authForm.controls['password'];
    }
    LoginPage.prototype.onSubmit = function (login) {
        if (this.authForm.valid) {
            console.log('Submitted value: ', login);
            this.userData.login(this.username);
            this.navCtrl.push(session_list_1.SessionListPage);
        }
    };
    LoginPage.prototype.onSignup = function () {
        console.log('SignupPage');
        this.navCtrl.push(signup_1.SignupPage);
    };
    LoginPage = __decorate([
        ionic_angular_1.Page({
            templateUrl: 'build/pages/login/login.html',
            directives: [common_1.FORM_DIRECTIVES]
        }), 
        __metadata('design:paramtypes', [ionic_angular_2.NavController, user_data_1.UserData, common_1.FormBuilder])
    ], LoginPage);
    return LoginPage;
}());
exports.LoginPage = LoginPage;

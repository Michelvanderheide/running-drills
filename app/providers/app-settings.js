"use strict";
var AppSettings = (function () {
    function AppSettings() {
    }
    AppSettings.setDevEnvironment = function () {
        console.log("set dev environment");
        this.BASE_URL = 'http://runningdrills.local';
        this.BASE_API_URL = this.BASE_URL + '/api';
    };
    AppSettings.BASE_URL = 'http://www.avgoor.nl';
    AppSettings.BASE_API_URL = 'http://www.avgoor.nl/api';
    return AppSettings;
}());
exports.AppSettings = AppSettings;

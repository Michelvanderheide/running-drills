# Ionic 2 Running Drills
## File Structure of App

```
running-drills/
├── .github/                           * GitHub files
│   ├── CONTRIBUTING.md                * Documentation on contributing to this repo
│   └── ISSUE_TEMPLATE.md              * Template used to populate issues in this repo
|
├── app/                               * Working directory
│   ├── pages/                         * Contains all of our pages
│   │   │
│   │   │── drill-detail/            * Drill Detail page
│   │   │    ├── drill-detail.html   * DrillDetailPage template
│   │   │    ├── drill-detail.js     * DrillDetailPage code
│   │   │    └── drill-detail.scss   * DrillDetailPage stylesheet
│   │   │
│   │   │── drill-list/              * Drills tab page
│   │   │    ├── drill-list.html     * DrillListPage template
│   │   │    ├── drill-list.js       * DrillListPage code
│   │   │    └── drill-list.scss     * DrillListPage stylesheet
│   │   │
│   │   │── session-list/              * Drill sessionss tab page
│   │        ├── session-list.html     * DrillListPage template
│   │        ├── session-list.js       * DrillListPage code
│   │        └── session-list.scss     * DrillListPage stylesheet│   │   │── tabs/                      * Tabs page
│   │
│   ├── providers/                     * Contains all Injectables
│   │   └── drill-data.js               * DrillData code
│   │
│   ├── theme/                         * App theme files
│   │   ├── app.core.scss              * App Shared Sass Imports
│   │   ├── app.ios.scss               * iOS Sass Imports & Variables
│   │   ├── app.md.scss                * Material Design Sass Imports & Variables
│   │   ├── app.variables.scss         * App Shared Sass Variables
│   │   └── app.wp.scss                * Windows Sass Imports & Variables
│   │
│   ├── app.html                       * Application template
│   └── app.js                         * Main Application configuration
│
├── node_modules/                      * Node dependencies
|
├── platforms/                         * Cordova generated native platform code
|
├── plugins/                           * Cordova native plugins go
|
├── resources/                         * Images for splash screens and icons
|
├── www/                               * Folder that is copied over to platforms www directory
│   │   
│   ├── build/                         * Contains auto-generated compiled content
│   │     ├── css/                     * Compiled CSS
│   │     ├── fonts/                   * Copied Fonts
│   │     ├── js/                      * ES5 compiled JavaScript
│   │     ├── pages/                   * Copied html pages
│   │     └── app.html                 * Copied app entry point
│   │
│   ├── data/                          * Contains data used for the app
│   │     └── data.json                * App data
│   │
│   ├── img/                           * App images
│   │
│   └── index.html                     * Main entry point
|
├── .editorconfig                      * Defines coding styles between editors
├── .gitignore                         * Example git ignore file
├── config.xml                         * Cordova configuration file
├── ionic.config.json                  * Ionic configuration file
├── LICENSE                            * Apache License
├── package.json                       * Our javascript dependencies
└── README.md                          * This file
```

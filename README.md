# Eccomerce
Simple to manage Single product E-commerce store that accepts BTC

### Local Setup
- clone the project using `git clone https://github.com/ConnollySekai/KowloonShirts-v.2.git`
- go to project directory cd Eccomerce
- install composer dependencies `composer install`
- install node dependecies `npm install`
- create a .env file manually or run `cp .env.example .env`. Add your enviroment variables and database credentials
- generate app key `php artisan key:generate`
- run migration and seed `php artisan migrate`
- create a symlink to storage `php artisan storage:link`
- run the app `php artisan serve` for local testing

### Style and Scripts
Eccomerce uses [semantic ui](https://semantic-ui.com) library and some custom CSS to create a simplistic look.
Front-end assets are compiled by Laravel mix.

#### CSS
- The source files can be found on resource/assets folder which is Laravel's default src location.
- The sass folder contains the custom styles and broken down into folders. Base - mostly includes variables, mixin and global styles which are not compiled(except global.scss). Components - styles that are not included in semantic ui and some semantic override. Layouts - are mostly layout related styles.
- All files are imported in app.scss which is then compiled into a single app.css inside public/css folder

#### Javascript
- app.js is compiled into app.js inside public/js folder.
- all global js are inside page-scripts.js which is initialized inside app.js
- local and specific js can be included inside blade files themselves. 3rd party library can be included in page-script-before section and local script can be included in page-script-after section

### Compiling Style and Scripts
- run command `npm run dev` to compile assets
- run command `npm run watch` to watch for changes and use live reloading
- run command `npm run prod` to compile for production


### Gemini and Nexmo
Eccomerce uses Gemini Api to handle BTC transactions. You must setup your api keys on the settings tab on the admin section.
Gemini key type needs to be 'Fund Manager'. This allows for the creation of wallet address, but does not allow assets to be sold or sent.


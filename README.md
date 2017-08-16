American Museum of Natural History "When In The World? Quiz"
==========================

[https://whenintheworld.amnh.org](https://whenintheworld.amnh.org)

### Build
The site is currently deployed to Heroku using *nodejs* and *php* buildpacks. 

To install the required buildpacks run 

```sh
$ heroku buildpacks:add heroku/nodejs
$ heroku buildpacks:add heroku/php
```

To provision the database, use the Heroku Postgres addon.

```sh
$ heroku addons:create heroku-postgresql:hobby-dev
```

### composer.json
There are only a few composer packages used for the application. The first is Silex which is a small framework used to manage PHP sessions, and the second is a PDO service which integrates with Silex. These applications are initiated in config.php.

### package.json
The quiz uses a number of npm packages for development and deployment. Most of these are gulp and gulp helpers but also includes bower. A few things to note:

 - The .bowerrc configuration file is set to install dependencies in the public/vendor directory. 
 - Gulp uses a plugin called main-bower-files which looks for dependencies in public/vendor and adds them to a minified file when running gulp tasks
 - On postinstall, bower downloads all dependencies before running gulp which should put all dependencies and custom CSS, Javascript, and images in the /web/dist directory for usage on the application.

### Database
The quiz uses three tables. The configuration for these tables in included in dq.sql file.

 - questions: holds information about each question including the correct answer and some information about the timeline (used to calculate user score).
 - users: users are created when they answer the first question. The user_id is saved in a session variable and used to update their row in the database as they progress through the quiz.
 - useradmin: There is a single row to hold a username and encrypted (sha512) password.


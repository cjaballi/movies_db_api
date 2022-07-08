This small project is an example of how to use REST Api based on Symfony 5 
and Yarn for building assets with Webpack .  this project uses  themoviedb api ( https://www.themoviedb.org/)

Prerequirements
---------------
* You should have symfony installer ready on local machine to start the symfony internal web server.
* PHP version php7.*
  sudo apt update
  sudo apt install yarn
Installation
------------
1. install project dependencies
``` 
$ composer install
``` 
2. install yarn for assets webpack
``` 
$ curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | sudo apt-key add -
$ echo "deb https://dl.yarnpkg.com/debian/ stable main" | sudo tee /etc/apt/sources.list.d/yarn.list
$ sudo apt update
$ sudo apt install yarn
```
2. Start the symfony internal web server
```
$ symfony serve
```
3. Go to url http://127.0.0.1:8000/ 
4. run the yarn command for building assets with Webpack
```
$ yarn encore dev-server
```
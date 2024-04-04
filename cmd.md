#### Start the services(what's ur password nigga?)
```sh
sudo systemctl start httpd
```

```sh
sudo systemctl start mysqld
```

#### Setup the directories:

```sh
sudo git clone git@github.com:soham1011/phpproject.git
```

```sh
cd phpproject
```

```sh
sudo rm -rdf /var/www/html/*; sudo cp -r * /var/www/html/;
```

Now open [browser](http://localhost:80/)

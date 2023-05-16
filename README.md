## Setup Github
##### Check `~/.ssh/id_rsa.pub`
```sh
Mac
$ less ~/.ssh/id_rsa.pub
```

```
Windows
$ type ~/.ssh/id_rsa.pub
```

##### When you don't have `~/.ssh/id_rsa.pub`
```sh
$ ssh-keygen -t rsa -C "your_github_email@example.com"
```
---
**When asked where to save the new key, hit enter to accept the default location.**
```sh
Generating public/private rsa key pair.
Enter file in which to save the key (/Users/username/.ssh/id_rsa):
```
---

**You will then be asked to provide an optional passphrase. This can be used to make your key even more secure, but for this time you can skip it by hitting enter twice.**
```sh
Enter passphrase (empty for no passphrase):
```

```sh
Enter same passphrase again:
```
---

**When the key generation is complete, you should see the following confirmation:**
```sh
Your identification has been saved in /Users/username/.ssh/id_rsa.
Your public key has been saved in /Users/username/.ssh/id_rsa.pub.
The key fingerprint is:
01:0f:f4:3b:ca:85:d6:17:a1:7d:f0:68:9d:f0:a2:db your@email.com
The key's randomart image is:
+--[ RSA 2048]----+
|                 |
|                 |
|        . E +    |
|       . o = .   |
|      . S =   o  |
|       o.O . o   |
|       o .+ .    |
|      . o+..     |
|       .+=o      |
+-----------------+
```
---
**Go to Github > Settings > SSH and GPG keys**

https://github.com/settings/keys

##### Click 'New SSH key'
<kbd><img width="300" alt="Screenshot 2022-12-04 at 1 37 32 PM" src="https://user-images.githubusercontent.com/42083014/205474847-4dd6ae82-cde1-4712-9aac-4e133389ac32.png"><kbd>

##### Add your public key to GitHub
<kbd><img width="300" alt="Screenshot 2022-12-04 at 1 54 49 PM" src="https://user-images.githubusercontent.com/42083014/205475215-06bfe781-c1af-4f1c-bbc3-e77d43c59be1.png"><kbd>

**Title**: `Name your key something whatever you like`

**Key type**: `Authentication Key`

**Key**: `Copy and paste what you see with below command`

```sh
Mac
$ less ~/.ssh/id_rsa.pub
```

```sh
Windows
$ type ~/.ssh/id_rsa.pub
```
---
**Finally, hit 'Add key' to save. Enter your github password if prompted.**
  
<kbd><img width="300" alt="Screenshot 2022-12-04 at 1 54 49 PM" src="https://user-images.githubusercontent.com/42083014/205476669-0e38e062-79d4-4313-be0e-7a94687eca64.png"><kbd>

## Setup Local (Mac)

##### 1. Clone repository
```
$ git clone git@github.com:kredo-school/english_chat_hub.git
```

##### 2. Go to your directory
```
$ cd Desktop
```

```
$ cd english_chat_hub
```

##### 3. Create .env
```
$ cp .env.example .env
```

##### 4. Modify .env L14
<kbd><img width="400" alt="Screenshot 2022-12-14 at 3 03 57 PM" src="https://user-images.githubusercontent.com/119660809/207519051-4baa21c0-74e2-4d50-9eed-0c4e13f5c981.png"><kbd>
    
##### DB_DATABASE=english_chat_hub

##### 5. install php 
```
$ php -v
```

##### if you don't have any PHP version

```
$ brew install php
```

##### 6. Create Database
```
$ mysql --version
```

##### if you don't have mysql

```
$ brew install mysql
```

##### start mysql server
```
$ mysql.server start
```

##### login mysql 
```
$ mysql -u root
```

##### create your database 
```
> create database english_chat_hub;
```

##### exit mysql 
```
> exit
```

##### 7. Install Composer Libraries
```
$ composer install
```

##### if you encounter error, please try this command
```sh
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === '55ce33d7678c5a611085589f1f3ddf8b3c52d662cd01d4ba75c0ee0459970c2200a51f492d557530c71c15d8dba01eae') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
```

##### 8. Run migration and seeder
```
$ php artisan migrate
```

```
$ php artisan db:seed
```

##### 9. make images folder & Run storage:link
```
$ mkdir storage/app/public/images
```

```
$ php artisan storage:link
```

##### 10. Run npm
```
$ npm install
```

##### if you don't have node, please install from below link

https://codelikes.com/mac-node-install/

```
$ npm run dev
```

##### 11. Set Application key
```
$ php artisan key:generate
```

##### 12. Server start
```
$ php artisan serve
```

##### 13. Visit a website
http://127.0.0.1:8000/

## Set Sequel Ace    
<kbd><img width="400" alt="Screenshot 2022-12-14 at 3 12 15 PM" src="https://user-images.githubusercontent.com/119660809/207520076-f413e459-9ab4-44bb-91fe-6a908dc8283d.png"><kbd>

##### Name: localhost/english_chat_hub
##### HOST: localhost
##### USERNAME: root
##### PASSWORD:     
##### DATABASE: english_chat_hub
##### PORT: 3306

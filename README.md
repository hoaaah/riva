RIVA (WIP)
===================

Aplikasi Pengeloalan Rencana Tindak Sistem Pengendalian Internal Pemerintah (SPIP) untuk Pemerintah Daerah.

1. This template comes with almost all features that default yii2-app-advanced has.
2. It has additional features listed in the next section of this guide.
3. Application structure has been changed to be 'shared hosting friendly'.

Installation
-------------------
>I am assuming that you know how to: install and use Composer, and install additional packages/drivers that may be needed for you to run everything on your system. In case you are new to all of this, you can check my guides for installing default yii2 application templates, provided by yii2 developers, on Windows 8 and Ubuntu based Linux operating systems, posted on www.freetuts.org.

1. Create database that you are going to use for your application (you can use phpMyAdmin or any other tool that you like).

2. Now open up your console and ```cd``` to your web root directory, for example: ``` cd /var/www/html/ ```

3. Run the Composer ```create-project``` command:

   ``` composer create-project nenad/yii2-basic-template basic ```

4. Now you need to tell your application to use database that you have previously created.
Open up db.php config file in ```basic/_protected/config/db.php``` and adjust your connection credentials.

5. Back to the console. Inside your newly installed application, ```cd``` to the ```_protected``` folder.

7. Execute yii migration command that will install necessary database tables:

   ``` ./yii migrate ``` or if you are on Windows ``` yii migrate ```

8. Execute _rbac_ controller _init_ action that will populate our rbac tables with default roles and
permissions:

   ``` ./yii rbac/init ``` or if you are on Windows ``` yii rbac/init ```


You are done, you can start your application in your browser.

> Note: First user that signs up will get 'theCreator' (super admin) role. This is supposed to be you. This role have all possible super powers :-) . Every other user that signs up after the first one will NOT get any role by default. This is because authenticated user (@ by default) is same like our member role. 

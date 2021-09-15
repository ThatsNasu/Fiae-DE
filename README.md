# Fiae-DE
The website i write / wrote for the FIAE-D / FIAE-E classes of 2021.

## Table of contents:
1. [Introduction](#introduction)

2. [Technologies](#technologies)

3. [Purpose of this repoitory](#purpose-of-this-repository)

4. [Data Protection](#data-protection)

5. [Live versions](#live-versions)

6. [Implemented and upcoming features](#implemented-and-upcoming-features)

    6.1. [Implemented](#implemented)

    6.2. [Upcoming](#upcoming)

7. [Disclaimer](#disclaimer)

8. [Copyright](#copyright)

## Introduction:
I'm currently in a retraining to become a software developer and next to me are about 20 people with the same intention. And since i have the possibility to host a website aswell as a database server and a fileserver, i offered to do so, which resulted in me finding myself managing a sftp server, creating logins and do other shinnaningans to keep it up and running. Unfortunately some of my classmembers aren't able to connect to the sftp server, since some ports are blocked on their host systems (which are not their private systems, and thus they are not admin on that machines) and i tried to think of a convenient way to solve the problems of managing the sftp aswell as giving everyone the possibility to use it. So that was the reason i started to build this website. My goal is to allow the registered users (which in this case only will be my classmembers and myself) to download files from the sftp server through their browser, upload files through the browser onto the sftp server, change some settings for their userprofile, like for example the password, shown username, profile images and anything else i think could be fun to implement and make the page more dynamically and less sterile or static. Overall this is a webpage from a user to users.

## Technologies:
This website will be mostly written in Object Oriented PHP, using some SQL aswell as HTML5 and CSS (spoiler alert: i suck with CSS).

## Purpose of this repository:
After releasing the first ever public version of this webpage, i created this repository to be able to backtrack my changes, review my own code, and maybe smile over stupid mistakes or improvements i made during the time (if i make them, tho). Also i want to welcome anybody seeing this code (either by stumbling over this repository by accident, or by obtaining a link to it) to point out my mistakes, make suggestions or fork this repository for own use (as long as it doesn't violate the copyright), or to improve it and sending a pull request.

## Data Protection:
You may be stumbling over some code that references files not provided in this repository. I did not provide this files since they contain sensible information like database logins or userdata

## Live versions:
The development stage aswell as the production stage are hosted on my development webserver at my home, since i didn't want to bother our mainserver with this sideproject. If you are interested in taking a look on either of them, feel free to follow the links to [the poduction stage](https://fiaede.dasnasu.bitbite.dev) or [the development stage](https://dasnasu.bitbite.dev).

## Implemented and upcoming features:
### Implemented:
* Selectable theming
* Object Oriented Navigation

### Upcoming:
* Object Oriented Footer
* Userprofile
* Permissionsystem
* File upload and download
* Editable elements using permission system
* Uniform page design
* Mobile optimizations
* Translations for german and english

## Disclaimer:
I will not be responsible for any harm - physically, mentally or financially - caused by using or not using parts or everything of my code.

## Copyright
This repository uses the MIT License and i expect everyone to respect that.
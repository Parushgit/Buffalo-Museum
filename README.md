# Buffalo Museum - Self Guided Tour (Deployment Instructions)
This document teaches how to install the self guided tour application on a server. 

## Dependencies
- Apache server installed
- PHP and MySQL installed

The available instructions are as follows:

### Clone the repository from GitHub
`git clone git@github.com:Parushgit/Buffalo-Museum.git`

### Source URL
`webmaster/login.html`. As visible from the URL, the `login.html` can be found by `cd` into `webmaster/`.

For example if the host name is `www.i-am-the-host.com` and the whole respository is kept in the root directory, URL would look like `www.i-am-the-host.com/museum/tours/web/login.html`.

### APIs
All apis are stored in folder `api`. 
All configurations are stored in folder `config`.
All objects are stored in folder `objects`.
All the above things are required to make apis working fully.

### Database
Below are the scripts to be executed.
To create tables - 
CREATE_TOURS.sql
CREATE_RESOURCES.sql
CREATE_IMAGES.sql
CREATE_AGE_GROUPS.sql

To insert quests/tours in the tables -
CREATE_QUEST_1.sql
CREATE_QUEST_2.sql
CREATE_TOUR_3.sql

Happy touring :)


Our final application for self guided tours is deployed here

http://www-student.cse.buffalo.edu/museum/tours/web/login.html

login details for admin user are

username : pgarg@buffalo.edu 
password : xyz

All our code is in repo

https://github.com/Parushgit/Buffalo-Museum/

The required documents have all been edited and available at following links

https://docs.google.com/document/d/1nyIMMAxaWY0zUDHUgeZOErINZ7OZJuLi2AYqMVh-Yh8/edit?usp=sharing

https://docs.google.com/document/d/17qRce3d_0U666Ma-SGwi_6yoAWXtuIbpOrz4wH0RAWA/edit?usp=sharing

https://docs.google.com/document/d/1E7Juoxdcxyoq8RV5CPYBWAmkGw7dyczQ219VVuVHNwU/edit?usp=sharing

https://docs.google.com/document/d/16x-rpGWlxcc1W680_qNcYyEFjDgCMhXXviqyspF5O60/edit?usp=sharing

https://docs.google.com/document/d/1rRDraHjvOAi1XtnLfJLzx7wPBO3-91ACPreeoZe230w/edit?usp=sharing

https://docs.google.com/spreadsheets/d/1aO5QlSZAnGHiW1lwSd15kUj9F3cs4FI-S6TI2kPPHi8/edit?usp=sharing

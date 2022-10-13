# Test task for Knowledge City
## Installation
Project contains docker-compose.yml file for quick start, just execute:<br>
```
docker-compose up
```
API should be available at http://localhost:8000/
<br><br>
To seed the database go to http://localhost:8000/api/seed/ <br>
It does not require authorization and is made only for test 
## Usage
API supports 4 requests:<br>
Seed the database
```
GET /api/seed/
```
Get user list (5 per page by default)
```
GET /api/users/?page=n
```
Authorize by login and passwod.<br>
<br>
Example:<br>
"username":"admin"<br>
"password":"123123"<br>
"remember_me":1<br>
```
POST /api/auth/

parameters: 
'username'
'password'
'remember_me'
```
Logout
```
DELETE /api/auth/
```
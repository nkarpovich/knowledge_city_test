# Test task for Knowledge City
## Installation
Project contains docker-compose.yml file for quick start, just execute:<br>

```
docker-compose up
```
Application should be available at http://localhost:8000/
<br>
## Usage
API supports 4 requests:<br>
```
GET /api/seed/
```
Seed the database
```
GET /api/users/?page=n
```
Get user list (5 per page by default)
```
POST /api/auth/

parameters: 
'username'
'password'
'remember_me'
```
Authorize by login and passwod.<br>
Example:<br>
admin<br>
123123
```
DELETE /api/auth/
```
Logout
## Additional information
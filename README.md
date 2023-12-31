# Appyventures stage 2 coding challenge
### Result
Passed

## Tasks Covered [Backend (Laravel)]

> Set up a RESTful API using Laravel to manage tasks.
- Each task should have: id, title, description, due_date, and status (e.g., pending, completed).
- Implement routes for creating, retrieving, updating, and deleting tasks.
- Store tasks in a relational database (e.g., MySQL). Use migrations for setting up the database schema.
- Implement authentication. Users should be able to register and log in. Protect the task routes to ensure only authenticated users can access them.
- Use middleware to handle API versioning.
- Write tests for your API endpoints using PHPUnit.

### Recorded Attempt
https://www.youtube.com/watch?v=EIEs22jkC8c

### Swagger Docs
https://app.swaggerhub.com/apis/ADAMCHILDREN/testswagger/1.0.0

### Postman Collection
Sent in email response

### Jira (Used in video) - Will require access if needed
https://akchildren1.atlassian.net/jira/software/projects/APPY/boards/1

## Setting up locally
### Pre-requisites
- Docker
- curl
- git

### Steps
Do the following below in order using a linux distro of your choice:
1. `git clone https://github.com/akchildren/appyventures-assessment.git`
2.  `cd` to this repository root
3.  `cp .env.example .env`
4. 
    ```shell
    docker run --rm \
        -u "$(id -u):$(id -g)" \
        -v "$(pwd):/var/www/html" \
        -w /var/www/html \
        laravelsail/php82-composer:latest \
        composer install --ignore-platform-reqs
    ```
5. `alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'`
6. `sail up -d`
7. `sail artisan key:generate`
8. `sail artisan migrate:fresh`

Congratulations you should have a localhost accessible at `http://localhost:80` or `http://localhost:80/api/v1` for api routes.

### Running Tests after local setup
`sail artisan test`

### Accessing tasks routes
You will need to register/login using the `login` route provided in the postman collection.

When you have logged in, the response will return a bearer token which can be used for accessing the tasks routes.

#### Note
The postman collection has been setup to use the following env vars:
- `bearer`
- `url`

### Env export of postman
```json
{
	"id": "39c713af-a499-4b5a-8651-9a22dbb2a1d4",
	"name": "ENV",
	"values": [
		{
			"key": "bearer",
			"value": "",
			"type": "secret",
			"enabled": true
		},
		{
			"key": "url",
			"value": "http://localhost/api/v1",
			"type": "default",
			"enabled": true
		}
	],
	"_postman_variable_scope": "environment",
	"_postman_exported_at": "2023-10-20T20:43:11.567Z",
	"_postman_exported_using": "Postman/10.19.6"
}
```

### Final Thoughts
The tasks resourceful routes should not be plural as if this was to follow the correct restful api routing conventioning it would be singular (i.e. `task/`). 

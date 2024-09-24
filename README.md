## How to use
<p>Welcome...</p>
<p>This is the repository for Laravel simple invoice system. To use the system, follow the instructions.</p>

### Install the required packages:
<p>Use composer to install the required packages for the system by running the following command</p>

`composer update`

### Config the .env file:
<p>Configure the <code>.env</code> file with the required information</p>

### Installing Database:
<p>Run the migration code with seeding to migrate the database, but before you need to run the following code first</p>

`php artisan vendor:publish --provider="Spatie\Activitylog\ActivitylogServiceProvider" --tag="activitylog-migrations"`
<p>This code for publishing ActivityLog package database tables, then you can run</p>

`php artisan migrate --seed`
<p>To seed the database and populate the tables with demo data</p>

### Run the server:
<p>It is recommended to use <code>valet</code> on running the project on local. Also, use one of the local SMTP server
to test the emails send to customers.</p>

### Setting up Postman collection:
<p>Along with the project files you will find a Postman collection file.</p>

`Invoice Demo.postman_collection.json`
<p>Use this file to add the API end points to Postman.</p>

### Demo Users:
<p>Along with the demo data you will find two users you can use for testing. The first user is <code>admin@example.com</code> use and the other is <code>employee@example.com</code> user.</p>
<p>Both users accounts have the same password for login: <code>password</code>.</p>

> **Important Note:** The project only contains the essential code for backend, no frontend code is added at all, you can use tinker to test the <code>web</code>
> routs and Postman collection to test the <code>api</code> routes. Also, install <code>VueJS</code> when installing Laravel <code>Breeze</code> and <code>Inertia</code> for frontend.

### Need more info?:
<p>If you need any further information about setting up and running the demo system feel free to contact me.</p>
<p>Best Regards,,,</p>

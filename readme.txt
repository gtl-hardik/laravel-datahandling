Demo contain following items

Please replace http://10.0.3.150:8146 with your actual url for testing 


1. Register
POST http://10.0.3.150:8146/api/register

This method is created for posting and registering a user.

Params:
name
email
password
c_password

Return:
Token to access further api(s) or error on failure



2. Get token
POST http://10.0.3.150:8146/oauth/token

This method is developed to get new token for api access. This token need to be pass in header for api access.

Params:
username
password
grant_type
client_id
client_secret

client_id and client_secret are taken from the auth while creating passport authentication

Return:
Access token and refresh token values.


3. Token refresh
POST http://10.0.3.150:8146/api/token/refresh

This method is created for refreshing a token
Params: 
refresh_token

Return:
Updated values for Access token and refresh token.


4. Create home address
POST http://10.0.3.150:8146/api/address/create

A method for demostration of multilevel validation. Return same input array once validations are successfully met.
We are having a formRequest inherited class Adress which is used to validate actual request.
We have created a trait CommonRules for putting all general kind of validations in a file which are going to be adopt in core class.
In core Address class, we get all addressRules from trait and update rules within that class rules method which will then become final validations.

Return:
Reuring same input array with message, as this method is only for checking validation and no database updates are going in.


5. Delete usermeta
POST http://10.0.3.150:8146/api/users/metadata/destroy
Params:
meta_key
user_id

A method to demostrate parent -> child relationship when a record removed from child it will not touch parent entity.

Return:
Return boolean true or false on validation.


6. Update user
POST http://10.0.3.150:8146/api/user/update

Params:
first_name
last_name
key_name
key_value

A method to demonstrate how a parent and child table updates can be done.


7. Get user
GET http://10.0.3.150:8146/api/user/details

A method to demonstrate how eloquent is working with relational data and getting child entity data along with the single object.

8. User invoice
GET http://10.0.3.150:8146/api/user/invoice

A method to demonstrate how eloquent is working with relational data and getting child entity data along with the single object.

9. Delete user
GET http://10.0.3.150:8146/api/users/25080/destroy

A method to demonstrate how eloquent is removing child object on deletion of parent entity how children entities are removed.
Here we just had a look on your existing data structure and found that it is having foreignkey relationship but did not have on delete cascade method.
Hence we have use observers on deleting method to remove child entities as well. In case if table designs are made strictly using deleting cascade, it will be managed within database itself.


10. Queue management

Queue in laravel can be managed via, several available drivers in laravel.
This example demonstrate for database driver so queue will be managed from database only.
We have created a job using command 'php artisan queue:table'  and then 'php artisan migrate' which will create a table 'jobs' in the database.
We need to update .env file as well for mentioning queue driver database.
Along with table in database, artisan command has created one job class in app\jobs folder, which is having handle method, we need to put core logic over there.

Created a method 'send' in home controller which will send a job in database to run. with some specific time.

We need to keep a process running on the server which will take a raw of job and process it on desired time.
php artisan queue:listen database

11. Token mechanism
As per discussion and updates with Pekko, we have created two separate types of token in the system.
    a. A personal token, should leave long a year.
        We have created a method for getting a personal token based on username and secretId from database.
        This token can be shared by user to his office/someone who can generate invoice and other things on behalf of him.
        The age of this token can be a year.

    b. Normal token, should leave for 30 mins only.
        We have created a method for authenticate user based on username and password from our existing users table.
        This token will leave long for 30 mins only.

User Login for getting token
POST http://10.0.3.150:8146/api/userlogin

A method to authenticate user and get access token.
Params:
email
password


Login for personal token
POST http://10.0.3.150:8146/api/partnerlogin

A method to authenticate user and get access token.
Params:
email
secretId

Along with login methods, we have created registration and refresh token methods as well.

Register a user
http://10.0.3.150:8146/api/registernew

A method to register a user in the system

Params
email
password
confirm_password
isPartner

if isPartner is passed with value 1 then, user will be treated as partner and secret key will saved in database.
In case without that param, no secretId will be saved.


Getting user details
http://10.0.3.150:8146/api/details

A method to check access token is working fine. It will return current user's detail after once verified.




General notes

All api is returning standard output having following attribute
    success: bool true/false
    data: object of actual data related with api
    message: string message either for success or error
}

For general purpose we have used client_id and client_secret for id 2 statically. If in case it require to use it from params we can update accordingly.

As we have tried to use your existing sample data, we have not created seeds for this. You need to import sql just to have a look on this projet.

We have also put postman exported json here for your convenience. You can directly import it and use it.




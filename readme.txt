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

A method to demostrate how a parent and child table updates can be done.


7. Get user
GET http://10.0.3.150:8146/api/user/details

A method to demostrate how eloquent is working with relational data and getting child entity data along with the single object.

8. User invoice
GET http://10.0.3.150:8146/api/user/invoice

A method to demostrate how eloquent is working with relational data and getting child entity data along with the single object.

9. Delete user
GET http://10.0.3.150:8146/api/users/25080/destroy

A method to demostrate how eloquent is removing child object on deletion of parent entity how children entities are removed.
Here we just had a look on your existing data structure and found that it is having foreignkey relationship but did not have on delete cascade method.
Hence we have use observers on deleting method to remove child entities as well. In case if table designs are made strictly using deleting cascade, it will be managed within database itself.






General notes

All api is returning standard output having following attribute
    success: bool true/false
    data: object of actual data related with api
    message: string message either for success or error
}

For general purpose we have used client_id and client_secret for id 2 statically. If in case it require to use it from params we can update accordingly.

As we have tried to use your existing sample data, we have not created seeds for this. You need to import sql just to have a look on this projet.

We have also put postman exported json here for your convenience. You can directly import it and use it.


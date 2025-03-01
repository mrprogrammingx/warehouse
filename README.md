# Warehouse Project 

### This project created with Repository Service Pattern.

## - How to create Request, Repository, Service.

For create them, we can use below commands.
- Request: 
```
php artisan make:request RequestName 
```
- Repository: 
``` 
php artisan make:repository RepositoryName 
```
- Service: 
```
php artisan make:service ServiceName  
```

## - Some points about project.

### 1-	For update status field of requests and request_details table, you should use StatusEvent like below (because save user id and date in log table):

`StatusEvent::dispatch($requestId, $requestDetailId,  $statusId).`
 
 - First Param ($requestId):

This is for id of Requests table.
If first param be null,requests table doesn't update.

- Second Param ($requestDetailId):

This is for id of Requests_details table.
If second param be null, requests_details table doesn't update.
 
 - Third Param ($statusId):

Third param is for status_id.

### 2-	If you have any field in product table that is not in product rayvarz API you should add it to $ourFields variable in product model.
In other side this array is our fields that you need to be in products table and they are not in the API.

`protected $ourFields = [];`

### 3-	When a user create default role is client.
It defines on RolePermissionInterface file:

`const DEFAULT_ROLE = 'client';`

### 4-	All initial value for Centers, Warehouses and Categories, product_persian_fields, files_categories, status, settings, files_categories tables defined on Seeder

### 5-	For get All products from rayvarz you should run this command :
```
php artisan rayvarzproducts:cron 
```

### 6-	You can change time of run cron on Kernel file in console directory for example for special time like 00:00
For now it is daily

### 7-	For create “request_details_edit_logs” table fields, we used  requests_details table fields plus requests_details_id and user_id with default type of string.
### 8-	APIs for rayvarz, they define on .env
- RAYVARZ_PRODUCT_LIST_API: get list of all products
- RAYVARZ_PRODUCT_AMOUNT_API: get amount of each product
- RAYVARZ_CREATE_REMITTANCE_API: create remittance for request
- RAYVARZ_NEXT_DOCUMENT_NUMBER_API: get next document number
- RAYVARZ_TOKEN_API: get token from rayvarz



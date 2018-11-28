# A voucher pool microservice based in PHP.

Done with Slim framework (https://www.slimframework.com/).
And Eloquent. 

## What is a voucher pool?
   A voucher pool is a collection of (voucher) codes that can be used by 
   customers (recipients) to get discounts in a web shop. Each code may 
   only be used once, and we would like to know when it was used by the 
   recipient. Since there can be many recipients in a voucher pool, we 
   need a call that auto-generates voucher codes for each recipient.
   
## Add to valet [see laravel]
    
    cd public
    valet link voucher-api

## run    
To run the application in development, you can run these commands 

	php composer.phar start

## test
Run this command in the application directory to run the test suite

	php composer.phar test


# routes 

Method	URL	Action
GET /           Home
GET	/redeem	              Retrieve all todos
GET	/generate

# OMS23

Install "aaa" Folder in htdocs folder inside Xampp Server Or www Folder inside WAMP server in localhost c: drive

install POSTMAN Extension in google chrome extension in browser and Execute the below urls with specific data passes in body section of POSTMAN

URL For GET,PUT and POST Data :
POST : http://localhost/aaa/index.php/api/orders/orders

PUT: http://localhost/aaa/index.php/api/orders/orders/1
{
  {"email":"chandan@gmail.com",
  "status":"create",
  "name":"item2",
  "price":"200",
  "quantity":"10"}

}


PUT: http://localhost/aaa/index.php/api/orders/orders/1/cancel
PUT: http://localhost/aaa/index.php/api/orders/orders/1/payment






GET : http://localhost/aaa/index.php/api/orders/orders/1
GET : http://localhost/aaa/index.php/api/orders/orders
GET : http://localhost/aaa/index.php/api/orders/orders/today

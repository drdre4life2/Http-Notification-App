# HTTP Notification App #
A server or set of servers will keep track of topics and subscribers where a topic is a string and a subscriber is an HTTP endpoint. When a message is published on a topic, it should be forwarded to all subscriber endpoints.

### System requirements/dependency ###

1. PHP 7.3.0 or above
2. Redis 6.0 or above

## Getting Started ##
* Open terminal
* Clone the repo ```git clone https://github.com/drdre4life2/notification-system.git```
* Goto into the app folder ```cd Notification-System```
* Install dependencies ```composer install```
* Run migration ```php artisan migrate``` 
* Start redis queue, publisher and subscriber server.
```
./start-server.sh
```
This will start up redis queue for batch processing. Aso, the subscriber server is running on port 9000 and the publisher server will be running on port 8000.


* Open a new terminal to simulate the subscriber and publisher events
```
curl -X POST -H "Content-Type: application/json" -d '{ "url": "http://localhost:9000/test1"}' http://localhost:8000/subscribe/topic1
curl -X POST -H "Content-Type: application/json" -d '{ "url": "http://localhost:9000/test2"}' http://localhost:8000/subscribe/topic1
curl -X POST -H "Content-Type: application/json" -d '{"message": "hello"}' http://localhost:8000/publish/topic1
```

* Output 

All subscribers will get data forwarded to them when a corresponding topic is published.



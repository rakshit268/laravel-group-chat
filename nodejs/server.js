var app = require('express')();
var server = require('http').Server(app);
var io = require('socket.io')(server);
var ioRedis = require('ioredis');


//server.listen(8890);

//server.listen( 8890 );
server.listen( 8890 );


io.on('connection', function (socket) {
  

var redis = new ioRedis(6379, "192.168.1.159");
redis.subscribe("message");

redis.on("message", function(channel, data) {
  
    console.log(channel,data," hello");

    console.log("mew message add in queue "+ data['message'] + " channel");
    socket.emit(channel, data);
  });
 
  socket.on('disconnect', function() {
    redis.quit();
  });
 
});


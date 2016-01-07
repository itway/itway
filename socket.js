var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);

var Redis = require('ioredis');

var redis = new Redis({port: 6379, host: '127.0.0.1', db: 0});


redis.subscribe('test-channel', function (err, count) {

});


redis.subscribe('chat.rooms', function (err, count) {

});


redis.subscribe('chat.messages', function (err, count) {

});

redis.subscribe('chat-connected', function (err, count) {

});
redis.subscribe('post-created', function (err, count) {

});
redis.subscribe('event-created', function (err, count) {

});
redis.subscribe('event-updated', function (err, count) {

});

redis.subscribe('user-registered', function (err, count) {

});

/***
 Redis Events
 ***/
redis.on('message', function (channel, message) {

    var result = JSON.parse(message);

    io.to('admin').emit(channel, 'channel -> ' + channel + ' |  room -> ' + result.room);

    io.emit(channel + ':' + result.event, result.data);

});
var userCount = 0,
    users = [];

/***
 Socket.io Connection Event
 ***/
io.on('connection', function (socket) {

    socket.emit('welcome', {message: 'Welcome! Realtime Chat Server running at http://127.0.0.1:3000/'});

    /***
     Socket.io Events
     ***/

    userCount++;


    io.sockets.emit('userCount', {userCount: userCount});

    socket.on('storeClientInfo', function (data) {

        var clientInfo = {};
        clientInfo.customId = data.customId;
        clientInfo.clientId = socket.id;
        users.push(clientInfo);

        io.sockets.emit('userJoined', {users: users});

    });

    socket.on('disconnect', function (data) {
        userCount--;
        io.sockets.emit('userCount', {userCount: userCount});
        //users.splice(users.indexOf(client), 1);
        for (var i = 0, len = users.length; i < len; ++i) {
            var c = users[i];

            if (c.clientId == socket.id) {
                users.splice(i, 1);
                break;
            }
        }
        io.sockets.emit('userJoined', {users: users});
    });

    socket.on('join', function (data) {

        console.log(data);

        socket.join(data.room);

        socket.emit('joined', {message: 'Joined room: ' + data.room});
    });
});

//redis.subscribe('chat.conversations', function(err, count){});
//
//redis.subscribe('chat.messages', function(err, count){});


//redis.on('message', function(channel, message) {
//
//    console.log('Message Recieved: ' + message);
//
//    message = JSON.parse(message);
//
//    var chat = io.of( '/chat' );
//
//    chat.on( 'connection', function( socket ) {
//
//        chat.on( 'client-data', function( data ) {
//
//            console.log( data );
//
//            io.emit(channel + ':' + message.event, message.data);
//        });
//
//    });
//
//
//});
//
//redis.on('message', function(channel, message) {
//
//    var result = JSON.parse(message);
//
//    io.to('admin').emit(channel, 'channel -> ' + channel + ' |  room -> ' + result.room);
//
//    io.to(result.room).emit(channel, result);
//});
//
///***
// Socket.io Connection Event
// ***/
//io.on('connection', function(socket) {
//    socket.emit('welcome',  { message: 'Welcome! Realtime Chat Server running at http://127.0.0.1:3000/'} );
//
//    /***
//     Socket.io Events
//     ***/
//
//    socket.on('join', function(data) {
//        socket.join(data.room);
//        socket.emit('joined', { message: 'Joined room: ' + data.room });
//    });
//});

redis.monitor(function (err, monitor) {

    monitor.on('monitor', function (time, args) {
        console.log('Time Received: ' + time);

        for (var i = 0; i <= args.length; i++) {

            console.log('argument: ' + i + args[i]);

        }
    });
});

http.listen(6378, function () {
    console.log('Listening on Port 6378');
});

//function handler (req, res) {
//    fs.readFile(__dirname + '/index.html', function(err, data) {
//        if(err) {
//            res.writeHead(500);
//            return res.end('Error loading index.html');
//        }
//        res.writeHead(200);
//        res.end(data);
//    });
//}


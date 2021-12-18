const io = require("socket.io")(8888);
console.log('connected to port 8888');
/**
 *  Connect
 * tạo object users = ''
 */
const users ={};
 // Error reporting
  io.on('error', function (err) {
    console.log("Socket.IO Error");
    console.log(err.stack);
  });
    io.on('connection', (socket) => {  
        console.log('a user connected');
        const _id = socket.id
        // Check When user Login :: 2
        // khi nhận tín hiệu online từ bên web gửi qa sẽ run 
        socket.on('checkOnline', function(data){
          // saving userId to object with socket ID
          users[_id] = data.userId;
          // số lượng người ở trong room
          // const count = io.engine.clientsCount;
          io.emit("checkOnline",  users[_id] );
          /**
           * Disconnect
           */
        });
        socket.on('disconnect', function () {
			io.emit("disconnectUser", users[_id]);
			delete users[socket.id];
        });
    });

/**
 *  Redis
 */
const Redis = require("ioredis");
/**
 *  The same port in redis windown
 */
const redis = new Redis(1001); 
redis.psubscribe("*", (err, count) => {});

/**
 * Channel : String bên event boardcastOn
 */
redis.on("pmessage", (pattern, channel, message) => {
    /** return :
     * laravel_database_chat
        {"event":"message","data":{"message":"asdasd","socket":nul
        l},"socket":null}
        channel : laravel_database_chat
     */
	console.log('123');
    // message = JSON.parse(message)
	// io.emit(channel+":"+message.event,message.data.message)
	
    
});

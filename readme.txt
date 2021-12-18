--Chat realtime with sockio
.. cài redis windown ,
project : sockio, predis

---------------Redis on Windown -----------------------
. cài đặt bảng 64 win
. check path trên win ở this computer
.change port : redis-server --port 1001
.start Redis : redis-server
------ Cài Predis on Project ---
.composer require predis/predis
.tạo file server.js cấu hình ioredis và sockio
.port ở sockio the same file client script port
.port ioredis the same port redis windown and port file .env REDIS_PORT
sau đó chạy node server.js

các lệnh phải chạy
redis-server
node server
php artisan queue:listen


---------------------- BoardCast--------------------------
. Bỏ comments trong config/app -> BoardCastServicesProvider
. Cài boardcast driver , ở đây thì xài boardcast của Predis
    Docs:https://topdev.vn/blog/redis-la-gi/
composer require predis/predis
. Laravel không implementation một Socket.IO server sẵn 
    nên bạn cần sử dụng một Socket.IO server của một bên thứ 3 , Khuyến khích use Laravel Echo Server
npm install -g laravel-echo-server

. Cài đặt Laravel Echo và Socket IO client
npm install --save laravel-echo
npm install --save socket.io-client

appId: d4c6a7bfd84e4dfd
key: 70d4e4f0d66ff4a897727974e4bc8042

.env : BROADCAST_DRIVER=redis



------------------------Event và listener-----------------------

-- event : không chứa bất kỳ logic xử lý nào , chỉ nhận dữ liệu đầu vào
-- listener : là nơi xử lý khi bắt được sự kiện event


------------------------Thao tác với Queue-----------------------
Để hình dung rõ hơn, mình có thể mô tả cách hoạt động của hệ thống khi sử dụng Queue thành các bước như sau:

Bước 1: Hệ thống nhận yêu cầu phải gửi 200 email
Bước 2: Hệ thống tạo ra 200 tác vụ con và đưa vào chúng lần lượt Queue
Bước 3: Hệ thống thông báo tới người dùng là đã gửi email thành công
Bước 4: 200 tác vụ con trong Queue lần lượt được thực hiện ngầm

-- create migration

. php artisan queue:table
. php artisan migrate

-- Tạo Job
php artisan make:job MailJob

-- Chạy command sau thực hiện các tác vụ có trong Queue
. php artisan queue:work

-- call job
. NewJob::dispatch();
-- delay 
. NewJob::dispatch()->delay(now()->addMinutes(10));


-------------------------------Mail-------------------------------

php artisan make:mail SendMail

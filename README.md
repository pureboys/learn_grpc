### 不翻墙安装grpc

1. mkdir -p $GOPATH/src/google.golang.org
2. cd $GOPATH/src/google.golang.org
3. git clone https://github.com/grpc/grpc-go.git grpc
4. git clone https://github.com/google/go-genproto.git genproto
5. mkdir -p $GOPATH/src/golang.org/x
6. cd $GOPATH/src/golang.org/x
7. git clone https://github.com/golang/net.git
8. git clone https://github.com/golang/text.git
9. git clone https://github.com/golang/sys.git
10. go install google.golang.org/grpc


### 安装protoc编译器
1. https://github.com/protocolbuffers/protobuf/releases 中选择 protobuf-all-3.7.0.tar.gz
2. tar xzvf protobuf-all-3.7.0.tar.gz
3. cd protobuf-all-3.7.0
4. ./autogen.sh && ./configure && make
5. sudo make install

### 编译Go的 proto 文件的插件
1. go get -u github.com/golang/protobuf/protoc-gen-go
2. protoc -I helloworld/ helloworld/helloworld.proto --go_out=plugins=grpc:helloworld

### 编译php的 proto 文件的插件
1. yum install autoconf automake libtool
2. git clone -b $(curl -L https://grpc.io/release) https://github.com/grpc/grpc
3. cd grpc
4. git submodule update --init
5. make
6. sudo make install

```
# make install 会在 /usr/local/bin 目录下生成以下文件
#grpc_cpp_plugin  
#grpc_csharp_plugin  
#grpc_node_plugin  
#grpc_objective_c_plugin  
#grpc_php_plugin  
#grpc_python_plugin  
#grpc_ruby_plugin
#protobuf文件生成各种语言的插件
#注意node 不需要可以直接解析
```

### 安装php扩展
```
$ cd grpc/src/php/ext/grpc
$ phpize
$ ./configure
$ make
$ sudo make install
```

php --ini 查看 php.ini 文件位置，如果没有.在 /usr/local/php 下建立 php.ini 文件， 并文件最下方添加

```
[grpc]
extension=grpc.so
```

php -m 查看grpc模块是否添加成功


### 安装protobuf依赖
```
$ composer require google/protobuf
$ composer require grpc/grpc
```

### protobuf 文件编译成PHP文件

```
$ protoc --proto_path=./ --php_out=./ --grpc_out=./ --plugin=protoc-gen-grpc=/usr/local/bin/grpc_php_plugin ./helloworld.proto
#执行成功之后可以看到生成生成以下文件
#Lisa/GreeterClient.php  
#Lisa/LisaReply.php  
#Lisa/LisaRequest.php
#GPBMetadata/Lisa.php
```

### 开机服务端， 使用客户端调用














## SWOOLE 练习
> 练习了解swoole

### 安装
[官网](https://www.swoole.com/)<br>
```
# sudo 可以不加
# 支持socket等等 我全部选的 no
sudo pecl install swoole

# 验证
php -m | grep swoole
```

### 测试

### 原理
- swoole网络请求处理基于事件,充分利用底层的epoll/kqueue实现 4.x内置协程
- 协程+通道 使用[CSP编程模型](http://www.importnew.com/24226.html)



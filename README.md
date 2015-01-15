# xFrame
> a PHP Framework for Virtual Host - 虚拟主机专用PHP框架

## 目录结构

- framework 框架
    - basic 常用基类
    - core 框架流程核心类
    - third 第三方类库, 可以新增
    - tool 常用工具, 可以按需求修改
- project 项目程序目录
    - demo **可以并列多个**
        - action 控制器层
        - business 业务逻辑层
        - entity ORM实体
        - interceptor 拦截器
        - template 模版
        - config 配置文件
        - cache 缓存文件
            - session Session文件
            - template_c 用于Smarty
            - template_cache 用于Smarty
        - log 日志
            - server 服务器日志
            - framework 框架日志
            - business 业务日志
- wwwroot 服务器根目录, **对应虚拟主机www目录**
    - .htaccess Apache-Rewrite配置, 根据需求修改
    - demo **可以并列多个**
        - .htaccess Apache-Rewrite配置, 根据需求修改
        - index.php 程序入口文件
        - static 静态文件目录
            - css
            - js
            - img


## 常用方法

### 重新生成Autoload文件

访问 `http://domain/?remap=do`, **首次运行前需要先执行此命令**

### 删除缓存文件

访问 `http://domain/?delcache=do`


## Demo项目

- 复制`wwwroot/demo`文件夹, 并更改名称
- 复制`project/demo`文件夹, 并修改名称
- 根据虚拟主机实际目录情况, 修改`index.php`中的配置项
- 访问`http://domain/?remap=do`, 生成Autoload地图
- 访问`http://domain/demo/demo`, 大功告成, 后续根据项目需求修改即可
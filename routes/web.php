<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
// 资源路由路由 URI 必须 使用复数形式
// 使用 resource 方法时，如果仅使用到部分路由，必须 使用 only 列出所有可用路由：
Route::resource('photos', 'PhotosController', ['only' => ['index', 'show']]);

// 在允许使用路由 模型绑定 的地方 必须 使用。
// 模型绑定代码 必须 放置于 app/Providers/RouteServiceProvider.php 文件的 boot 方法中：

// 出于安全考虑，应该 使用全局路由器参数限制，详见 文档。
// 必须 在 RouteServiceProvider 文件的 boot 方法里定义模式：

// 除了 resource 资源路由以外，其他所有路由都 必须 使用 name 方法进行命名。
// 必须 使用『资源前缀』作为命名规范，如下的 users.follow，资源前缀的值是 users.：

// 所有的 Eloquent 数据模型 都 必须 继承统一的基类 App/Models/Model，此基类存放位置为 /app/Models/Model.php

// 数据模型相关的命名规范：
// 数据模型类名 必须 为「单数」, 如：App\Models\Photo
// 类文件名 必须 为「单数」，如：app/Models/Photo.php
// 数据库表名字 必须 为「复数」，多个单词情况下使用「Snake Case」 如：photos, my_photos
// 数据库表迁移名字 必须 为「复数」，如：2014_08_08_234417_create_photos_table.php
// 数据填充文件名 必须 为「复数」，如：PhotosTableSeeder.php
// 数据库字段名 必须 为「Snake Case」，如：view_count, is_vip
// 数据库表主键 必须 为「id」
// 数据库表外键 必须 为「resource_id」，如：user_id, post_id
// 数据模型变量 必须 为「resource_id」，如：$user_id, $post_id

// 利用 Trait 来扩展数据模型
// 有时候数据模型里的代码会变得很臃肿，应该 利用 Trait 来精简逻辑代码量，提高可读性，类似于 Ruby China 源码。

// 绝不 使用 Repository，因为我们不是在写 JAVA 代码，太多封装就成了「过度设计（Over Designed）」，极大降低了编码愉悦感，使用 MVC 够傻够简单。

// 绝不 使用命令行或者 PHPMyAdmin 直接创建索引或表。必须 使用 数据库迁移 去创建表结构，并提交版本控制器中；
// 绝不 为了共享对数据库更改就直接导出 SQL，所有修改都 必须 使用 数据库迁移 ，并提交版本控制器中；
// 绝不 直接向数据库手动写入伪造的测试数据。必须 使用 数据填充 来插入假数据，并提交版本控制器中。

// Laravel 的 Model 全局作用域 允许我们为给定模型的所有查询添加默认的条件约束。
// 所有的全局作用域都 必须 统一使用 闭包定义全局作用域

// 必须 优先使用 Restful 资源控制器 。
// 必须 使用资源的复数形式

// 必须 保持控制器文件代码行数最小化，还有可读性。
// 不应该 为「方法」书写注释，这要求方法取名要足够合理，不需要过多注释；
// 应该 为一些复杂的逻辑代码块书写注释，主要介绍产品逻辑 - 为什么要这么做。；
// 不应该 在控制器中书写「私有方法」，控制器里 应该 只存放「路由动作方法」；
// 绝不 遗留「死方法」，就是没有用到的方法，控制器里的所有方法，都应该被使用到，否则应该删除；
// 绝不 在控制器里批量注释掉代码，无用的逻辑代码就必须清除掉。


/**
 *  3.6. 表单验证
 *  目录：独立目录
 *  命令规则：单数 + Request
 */

// 表单请求验证类
// 必须 使用 表单请求 - FormRequest 类 来处理控制器里的表单验证。

// 验证类的 authorize
// 绝不 使用 authorize() 方法来做用户授权，用户授权我们会单独使用 Policy 授权策略 来实现

// 使用基类
// 所有 FormRequest 表验证类 必须 继承 app/Http/Requests/Request.php 基类。基类文件如下：

// 验证类命名
// FormRequest 表验证类 必须 遵循 资源路由 方式进行命名，photos 对应 app/Http/Requests/PhotoRequest.php

/**
 *  3.7. 授权策略
 *  目录：独立目录
 *  命令规则：单数 + Policy
 */

// 授权策略
// 必须 使用 授权策略 类来做用户授权。

// 使用基类
// 所有 Policy 授权策略类 必须 继承 app/Policies/Policy.php 基类。

// 授权策略命名
// Policy 授权策略类 必须 遵循 资源路由 方式进行命名，photos 对应 /app/Policies/PhotoPolicy.php 。

// 自动判断授权策略
// 应该 使用 自动判断授权策略方法，这样控制器和授权类的方法名就统一起来了。


/**
 *  数据填充
 *  目录：独立目录
 *  命令规则：单数 + Factory
 */

// factory 辅助函数
// 必须 使用 factory 方法来做数据填充，因为是框架提倡的，并且可以同时为测试代码服务。

// 运行效率
// 开发数据填充时，必须 特别注意 php artisan db:seed 的运行效率，否则随着项目的代码量越来越大，db:seed 的运行时间会变得
// 越来越长，有些项目多达几分钟甚至几十分钟。原则是：Keep it lighting speed. 只有当 db:seed 运行起来很快的时候，才能完\
// 全利用数据填充工具带来的便利，而不是累赘。

// 批量入库
// 所有假数据入库操作，都 必须 是批量操作，配合 factory 使用以下方法：
// $users = factory(User::class)->times(1000)->make();
// User::insert($users->toArray());
// 以上只执行一条数据库语句，推荐阅读 大批量假数据填充的正确方法。


/**
 *  Artisan 命令行
 *  目录：独立目录
 *  命令规则：
 */

// 所有的自定义命令，都 必须 有项目的命名空间。
// 如：
// php artisan phphub:clear-token
// php artisan phphub:send-status-email
// 错误的例子为：
// php artisan clear-token
// php artisan send-status-email


/**
 *  日期和时间
 *  目录：
 *  命令规则：
 */

// 必须 使用 Carbon 来处理日期和时间相关的操作。
// Laravel 5.1 中文的 diffForHumans 可以使用 jenssegers/date。
// Laravel 5.3 及以上版本的 diffForHumans，只需要在 config/app.php 文件中配置 locale 选项即可 ：
// 'locale' => 'zh-CN',


/**
 *  前端开发
 *  目录：
 *  命令规则：
 */

// 必须 使用 Laravel 官方前端工具做前端开发自动化；
// 必须 保证页面只加载一个 .css 文件；
// 必须 保证页面只加载一个 .js 文件；
// 必须 为 .css 和 .js 增加 版本控制；
// 必须 使用 SASS 来书写 CSS 代码；


/**
 *  中间件
 *  目录：
 *  命令规则：
 */

// Auth 中间件
// Auth 中间件 必须 书写在控制器的 __construct 方法中，并且 必须 使用 except 黑名单进行过滤，这样当你新增控制器方法时，默认是安全的。


/**
 *  Laravel 安全实践
 *  目录：
 *  命令规则：
 */

// 关闭 DEBUG
// Laravel Debug 开启时，会暴露很多能被黑客利用的服务器信息，所以，生产环境下请 必须 确保：APP_DEBUG=false

// XSS
// 跨站脚本攻击（cross-site scripting，简称 XSS），具体危害体现在黑客能控制你网站页面，包括使用 JS 盗取 Cookie 等，关于
// XSS 的介绍请前往 IBM 文档库：跨站点脚本攻击深入解析 。
// 默认情况下，在无法保证用户提交内容是 100% 安全的情况下，必须 使用 Blade 模板引擎的 {{ $content }} 语法会对用户内容进
// 行转义。
// Blade 的 {!! $content !!} 语法会直接对内容进行 非转义 输出，使用此语法时，必须 使用 HTMLPurifier for Laravel 5 来为用
// 户输入内容进行过滤。使用方法参见： 使用 HTMLPurifier 来解决 Laravel 5 中的 XSS 跨站脚本攻击安全问题

// SQL 注入
// Laravel 的 查询构造器 和 Eloquent 是基于 PHP 的 PDO，PDO 使用 prepared 来准备查询语句，保障了安全性。
// 在使用 raw() 来编写复杂查询语句时，必须 使用数据绑定。

// 批量赋值
// Laravel 提供白名单和黑名单过滤（$fillable 和 $guarded），开发者 应该 清楚认识批量赋值安全威胁的情况下合理灵活地运用。
// 批量赋值安全威胁，指的是用户可更新本来不应有权限更新的字段。举例，users 表里的 is_admin 字段是用来标识用户『是否是管
// 理员』，某不怀好意的用户，更改了『修改个人资料』的表单，增加了一个字段：

// CSRF
// CSRF 跨站请求伪造是 Web 应用中最常见的安全威胁之一，具体请见 Wiki - 跨站请求伪造 或者 Web 应用程序常见漏洞 CSRF 的入侵检测与防范。
// Laravel 默认对所有『非幂等的请求』强制使用 VerifyCsrfToken 中间件防护，需要开发者做的，是区分清楚什么时候该使用『非幂等的请求』。
// 幂等请求指的是：'HEAD', 'GET', 'OPTIONS'，既无论你执行多少次重复的操作都不会给资源造成变更。
// 所有删除的动作，必须 使用 DELETE 作为请求方法；
// 所有对数据更新的动作，必须 使用 POST、PUT 或者 PATCH 请求方法。


/**
 *  Laravel 程序优化
 *  目录：
 *  命令规则：
 */

// 说明
// 作为优秀的开发者，在日常编码中，应积极培养书写高执行效率代码的意识。不过项目运行效率是一个系统性工程，不应该只停留在
// 代码层面上，有时更应该考虑整个项目架构，包括项目中使用的软件等。
// 本文罗列了一些常见的优化项目，并且对其做了约束。

// 1. 配置信息缓存
// 2. 路由缓存
// 3. 类映射加载优化
// 4. 自动加载优化
// 5. 使用 Memcached/Redis 来存储会话 优先：Memcached
// 6. 使用专业缓存驱动器 Memcached/Redis 优先：Redis
// 7. 数据库请求优化
// 8. 为数据集书写缓存逻辑
// 9. 使用即时编译器
// 10. 前端资源合并

// 程序优化详细：https://laravel-china.org/docs/laravel-specification/5.5/laravel-optimization/527


/**
 *  代码生成器
 *  目录：
 *  命令规则：
 */

// 遵照此规范，在实际操作中，有许多重复。接下来推荐一款专为本规范量身定做的代码生成器 Laravel 5.x Scaffold Generator。
// 本扩展支持 5.1 ~ 5.5 版本的 Laravel。 url：https://github.com/summerblue/generator
// 只需要一个命令：php artisan make:scaffold Projects --schema="name:string:index,description:text:nullable,subscriber_count:integer:unsigned:default(0)"


/**
 *  推荐阅读
 *  目录：
 *  命令规则：
 */

//文档资料
// 必须 熟记 Laravel 5.5 官方文档，查阅时能快速定位，5 遍以上；url：https://laravel-china.org/docs/laravel/5.5
// 必须 熟记 Laravel 5.5 API 文档 的类结构，查阅时能快速定位；url：https://laravel.com/api/5.5/
// 必须 熟记所有 PSR 通过的标准； url：https://github.com/summerblue/psr.phphub.org｜https://psr.phphub.org
// PSR 目前还未通过的标准，也要 应该 知晓 http://www.php-fig.org/psr/#draft
// 应该 熟悉 PHP 最佳实践   url：http://laravel-china.github.io/php-the-right-way/
// 应该 了解 『Rails 信条』 url：https://laravel-china.org/articles/5232/every-laravel-engineer-should-read-the-rails-credo

// 教程
// 如果你是新手，想从零开始学习规范化编程，请查阅我的两本书：
// 《Laravel 入门教程 - 从零到部署上线》
// 《Laravel 进阶课程 - 从零开始构建论坛系统》
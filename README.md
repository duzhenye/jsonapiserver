# json-api-server

json-api-server 是 [JSON:API](http://jsonapi.org) 服务器实现 的 PHP。

它允许您通过定义资源架构和 将其连接到应用程序的数据库层。

根据您的架构定义，该包将提供完整的 API，该 API 符合 [JSON:API 规范](https://jsonapi.org/format/)，包括 支持：

-   **显示** 单个资源 (`GET /articles/1`)
-   **列出** 资源集合 (`GET /articles`)
-   **排序**, **过滤**, **分页**, 和 **稀疏字段集**
-   **复合文档**，包含相关资源
-   **创建** 资源 (`POST /articles`)
-   **更新** 资源 (`PATCH /articles/1`)
-   **删除** 资源 (`DELETE /articles/1`)
-   **内容协商**
-   **错误处理**
-   **扩展** 包括原子作
-   **生成 OpenAPI 定义**

## 文档

[阅读文档](https://github.com/duzhenye/jsonapiserver/docs)

## 例子

以下示例在 Laravel 应用程序中使用 Eloquent 模型。然而 json-api-server 可以与任何可以处理 PSR-7 请求的框架一起使用 和响应。可以实现自定义行为以支持其他 ORM 和数据 持久层。

```php
use App\Models\User;
use Duzhenye\JsonApiServer\Laravel;
use Duzhenye\JsonApiServer\Laravel\EloquentResource;
use Duzhenye\JsonApiServer\Laravel\Filter;
use Duzhenye\JsonApiServer\Endpoint;
use Duzhenye\JsonApiServer\Schema\Field;
use Duzhenye\JsonApiServer\Schema\Type;
use Duzhenye\JsonApiServer\JsonApi;

class UsersResource extends EloquentResource
{
    public function type(): string
    {
        return 'users';
    }

    public function newModel(Context $context): object
    {
        return new User();
    }

    public function endpoints(): array
    {
        return [
            Endpoint\Show::make(),
            Endpoint\Index::make()->paginate(),
            Endpoint\Create::make()->visible(Laravel\can('create')),
            Endpoint\Update::make()->visible(Laravel\can('update')),
            Endpoint\Delete::make()->visible(Laravel\can('delete')),
        ];
    }

    public function fields(): array
    {
        return [
            Field\Attribute::make('name')
                ->type(Type\Str::make())
                ->writable()
                ->required(),

            Field\ToOne::make('address')->includable(),

            Field\ToMany::make('friends')
                ->type('users')
                ->includable(),
        ];
    }

    public function filters(): array
    {
        return [Filter\Where::make('id'), Filter\Where::make('name')];
    }
}

$api = new JsonApi();

$api->resource(new UsersResource());

/** @var Psr\Http\Message\ServerRequestInterface $request */
/** @var Psr\Http\Message\ResponseInterface $response */
try {
    $response = $api->handle($request);
} catch (Throwable $e) {
    $response = $api->error($e);
}
```

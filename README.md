# EloquentSchemaQuery
***EloquentSchemaQuery*** is a library that extracts only required items from Eloquent.
Describe items to be acquired using schema.

# Install
```
composer require yonyon/eloquent-schema-query::dev-master
```

# Use Laravel
After updating composer, add the service provider to the providers array in config/app.php
```
'providers' => [
    // Other service providers...

    yonyon\EloquentSchemaQuery\Provider\EloquentSchemaQueryServiceProvider::class,
],

```
Also, add the facade to the aliases array in your app configuration file:

```
'EloquentSchemaQuery' => \yonyon\EloquentSchemaQuery\Facades\EloquentSchemaQuery::class,
```


# Example
```.php
$user = User::find(1);

$schema = new Schema([
  'id',
  'name',
  'todos' => new Schema([
    'name'
  ])
]);

$result = EloquentSchemaQuery::get($user, $schema);
```

# When you want to change the item name
The second argument to schema is an alias for the item name.
```.php
$schema = new Schema([
  'id',
  'name',
  'todos' => new Schema([
    'name'
  ], 'todo_list') 
]);
```

# FunctionSchema
FunctionSchema is used when you want to obtain the result of executing eloquent's query, such as the number of todo.
```.php
$schema = new Schema([
  'id',
  'name',
  'todo_count' => new FunctionSchema(function($user) {
    return $user->todos->count();
  })
]);
```
If the query result is Collection or Model, you have to define schema as the second argument.
```.php
$schema = new Schema([
  'id',
  'name',
  'todo_count' => new FunctionSchema(
    function($user) {
      return $user->todos;
    },
    new Schema([
      'name'
    ]
  )
]);
```

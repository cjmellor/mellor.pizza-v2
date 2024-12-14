I have built a package that I use personally for a project. While developing it, I discovered an undocumented way how to use Global Scopes in a different way than you might be used to, or how it’s currently documented.

I like it as I can store them all in a single class and keep things organised.

🔌 First, just a brief moment to say how I got here. I was developing a package — which you can [see here](https://github.com/cjmellor/approval) — which allows you to approve Models before they are persisted. For example, you could use it for a Comments model, where a comment has to be approved before it can be shown publicly. At some point I realised I wanted to have some status’ to see what state an approval request was in, and also a way to set a state programmatically, I figured I’d use **[Query Scopes](https://laravel.com/docs/9.x/eloquent#query-scopes)**

## A quick introduction to Query Scopes

Using a Query Scope makes things simple as it’s all stored in one class. **Artisan** has a command to make a new Scope

```shell
php artisan make:scope <NameScope>
```

This stores the new class within the `App\Scopes` namespace.

The class implements a Contract — `Illuminate\Database\Eloquent\Scope` which has a single `apply` method that must be used.

For example — one way to utilise this is — say you have a `state` column in your database structure with the potential values of “`approved`” and “`pending`” and you always want the query to have the state set the `pending` then you would add this to the `apply` method:

```php
public function apply(Builder $builder, Model $model)
{
    $builder->where('state', 'pending');
}
```

Now anytime you query a Model, this extra code is added by default

```php
// query a model
App\Models\Approval::find(1);

// result
SELECT * FROM `approvals` WHERE `id` = 1 AND `state` = 'pending';
```

To assign this scope to a Model, you overwrite the models’ parent `booted` method

```php
protected static function booted(): void
{
    static::addGlobalScope(new YourScope());
}
```

## Disabling Global Scopes

There might be a time — especially if you’re working in a team when someone isn’t aware that a Model has a query scope applied, and they spend hours trying to fix something that isn’t broken (this is coming from experience). If a model needs to be queried without the applied scope, you will use the `withoutGlobalScope` method to disable it

```php
Model::withoutGlobalScope(YourScope::class)->get();
```

## Undocumented feature: using Macros within the Scope

Within your Scope, you can extend the query builder with some extra methods.

For example, I wanted three methods where I could see queries with a state of `approved`, `pending` or `rejected` and the key to extending the query builder within’ a Scope is to use an `extend` method like so

```php
/**
 * Extend the query builder with the needed functions.
 */
public function extend(Builder $builder)
{
    foreach ($this->extensions as $extension) {
        $this->{"add{$extension}"}($builder);
    }
} 
```

### Where does this come from?

At first, I thought this method came from the previously mentioned Contract, but it doesn’t, it comes from within’ the `withGlobalScope` method

```php
/**
 * Register a new global scope.
 *
 * @param  string  $identifier
 * @param  \Illuminate\Database\Eloquent\Scope|\Closure  $scope
 * @return $this
 */
public function withGlobalScope($identifier, $scope)
{
    $this->scopes[$identifier] = $scope;

    if (method_exists($scope, 'extend')) {
        $scope->extend($this);
    }

    return $this;
}
```

As you can see, it is checking if there is an `extend` method and if so, it will register the new methods as a macro on the `Illuminate\Eloquent\Builder` class.

### Registering extensions

To register a new extension onto the builder, you first have to assign an array of method names to an `$extentions` variable

```php
/**
 * All of the extensions to be added to the builder.
 *
 * @var string[]
 */
protected $extensions = ['Approved', 'Pending', 'Rejected'];
```

and now add some new protected methods with this naming convention

```php
protected add{Extention}
{
	//
}
```

Where `Extention` (camel case) is one of the values given in the `$extensions` array.

So for example, using **Approved** as the extension

```php
protected addApproved(Builder $builder)
{
	$builder->macro('approved', fn (Builder $builder) => $builder
	  ->where('state', 'approved');
}
```

Now you can query a Model with this new method

```php
Model::approved()->get();
```

## Conclusion

This might be a little over-engineered, but if you like things being in a certain place and bundled together for easy access then this way seems like a logical way of doing it.

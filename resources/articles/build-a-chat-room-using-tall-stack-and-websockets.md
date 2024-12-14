This tutorial will help you build your own Chat Room. We will be using the **TALL Stack** ([Tailwind CSS](https://tailwindcss.com/), [AlpineJS](https://alpinejs.dev/), [Laravel](https://laravel.com/) and [Livewire](https://laravel-livewire.com/)) along with Echo that will use [Pusher](https://pusher.com/) for some WebSocket goodness.

There is an assumption here that you’re familiar with these tools and have them installed.

While we're using Pusher in this tutorial, you're free to use any drive you desire. Check [here](https://laravel.com/docs/9.x/broadcasting#supported-drivers) for a list of supported drivers.

This tutorial assumes you are familiar with, or already have the client and server side tools installed and configured to get WebSockets working in your application. If not, please refer to the documentation to do this.

- [Server Side Installation](https://laravel.com/docs/9.x/broadcasting#server-side-installation)
- [Client Side Installation](https://laravel.com/docs/9.x/broadcasting#client-side-installation)

## Scaffolding with Breeze

Ideally, you'll only want registered users to be able to use the application. If you're starting from scratch, I recommend installing [Laravel Breeze](https://laravel.com/docs/9.x/starter-kits#laravel-breeze) which will give you everything you need to allow Users' to login.

If your app is already built, nothing further is required as you just need the User Model, which comes out of the box. This tutorial will use Blade components from the Breeze package though, so keep that in mind if following along.

## Set-up Migrations

You will need a `messages` table to store the messages in. Create a new migration

```bash
php artisan make:migration "create messages table"

```

and populate the migration:

```php
Schema::create('messages', function (Blueprint $table) {
    $table->id();
    $table->foreignIdFor(\App\Models\User::class)->constrained();
    $table->string('message');
    $table->timestamps();
});
```

This shows that a Message is linked to a User.

## Set-up Models and Relationships

All of the messages sent in the chat room will be stored in the `messages` table. Create a Message Model

```bash
php artisan make:model Message

```

As we're linking a message to a User, add a [One To Many](https://laravel.com/docs/9.x/eloquent-relationships#one-to-many) relationship between the Message and User Models

```php
// App\Models\Message

public function user(): BelongsTo
{
    return $this->belongsTo(User::class);
}

```

```php
// App\Models\User

public function messages(): HasMany
{
    return $this->hasMany(Message::class);
}

```

## Model Broadcasting

Normally, you might think that you need to create an Event which handles the Broadcasting -- and while you can do that, this tutorial will not be using Events to broadcast but instead using the Models to broadcast, using [Model Broadcasting](https://laravel.com/docs/9.x/broadcasting#model-broadcasting).

### **A quick summary of this feature**

When sending a Message, you’d normally have an Event called `MessageSent` and dispatch that Event when sending the Message

```php
\App\Events\MessageSent::dispatch($message);
```

Then you would listen for that event in your JavaScript and perform some action

```js
Echo.channel('chat-room')
    .listen('MessageSent', event => console.log(event));
```

Or with Livewire:

```php
protected $listeners = [
    'echo:chat-room,MessageSent' => 'render',
];
```

With Model Broadcasting, you can use the events of your Model to listen against, meaning you can eliminate the need for separate Event classes.

So for example: as you may know, a Model fires an Event based on an action it performs, like when you create a new Model, `creating` and `created` Events get fired, the same with updating, deleting etc. You can read more about Model Events and what Events get fired [here](https://laravel.com/docs/9.x/eloquent#events).

### How to use Model Broadcasting

The methods needed to use Model Broadcasting are basically the same as if you were putting them in an Event class, but you ************must************ add a Trait to get these working. In your `App\Models\Message` Model, add the Trait `Illuminate\Database\Eloquent\BroadcastsEvents;`

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\BroadcastsEvents; // [tl! focus]
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    use BroadcastsEvents; // [tl! focus]

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
```

Now you can define the `broadcastOn` method to give your channel a name. As we’re just building a simple chat room, we just need the one channel. Have a look at [Model Broadcasting conventions](https://laravel.com/docs/9.x/broadcasting#model-broadcasting-conventions) to see about how to use your Model instances to create channels.

```php
public function broadcastOn($event): array
{
    return [new PresenceChannel(name: 'chat-room')];
}
```

### Private or Presence?

You’ll notice above it’s using a `Presence` channel. For a chat room, you’d want to use a Presence channel — it’s the same as a Private channel, except it comes with a few extra goodies like seeing when a User joins or leaves the channel and has [Client Events](https://laravel.com/docs/9.x/broadcasting#client-events) which can be used for things like tracking if a User is typing or not. A Private channel would mostly be used for when you just want one-to-one communication.

We’ve given the Presence channel the simple name of `chat-room` — you can give it any name you desire, but it will be required later on.

By default, the Model will broadcast all of its data. You might not want this if you have a lot of data to send over. Luckily, you can customise the payload you sent over, just add a `broadcastWith` method to your `Message` Model

```php
public function broadcastWith(): array
{
    return [
        'message' => $this,
        'user' => $this->user->only('name'),
    ];
}
```

For out chat rooms’ sake, we’re only interested in the message and the User who sent it.

Now when you send a message, this is the payload that is sent to the Broadcast driver.

### Authorising Presence Channels

Authorising a channel is the key to making Event Broadcasting work.

Make sure you have [defined the authorisation routes](https://laravel.com/docs/9.x/broadcasting#defining-authorization-routes) correctly.

Within the `routes` folder, you’ll find a `channels.php` route file. Here you can define your Channel routes. A route is authorised when the callback defined returns `true`.

### Channel Classes

You can put your authorisation logic in its own Channel Class. We’re gonna use this method moving forward.

More info on defining Channel Classes can be found [here](https://laravel.com/docs/9.x/broadcasting#defining-channel-classes).

Create the class via the Artisan command:

```bash
php artisan make:channel ChatChannel
```

Now change the route in `channels.php`

```php
use App\Broadcasting\ChatChannel;

Broadcast::channel('chat-room', ChatChannel::class);
```

Because we’re using a Presence channel, we do authorisation a bit differently than how we would with a Private channel. Instead of performing some logic to check if a User is authorised, we should just return an array of data about the User.

This data is then made available to the Presence channel’s Event Listeners, used on the client side. It is advised to still check for if a User is authorised or not, but instead of returning `true`, return `false`. If this is a bit confusing, consult the [docs](https://laravel.com/docs/9.x/broadcasting#authorizing-presence-channels) for more info.

```php
<?php

namespace App\Broadcasting;

class ChatChannel
{
    public function __construct()
    {
    }

    public function join(): array
    {
        if (! auth()->check()) {
            return false;
        }

        return [
            'id' => auth()->id(),
            'name' => auth()->user()->name,
        ];
    }
}
```

Above, we’re checking if a User is authorised to join the channel, if not return false. We’re then returning the data of the User — in this case, just their ID and name, but you can pass any data.

## Set-up Livewire Components

Lets create a Livewire component to build up the visual side of the chat room.

Create a new component — I’ve called it `Chat`.

```bash
php artisan livewire:make Chat
```

This creates the class and the view for the component.

We’ll start with the Class configuration first.

### Livewire Configuration

Add some properties to the class that we will utilise throughout.

```php
<?php

namespace App\Http\Livewire;

use App\Models\Message;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Chat extends Component
{
    public $message;

    public $usersOnline = [];

    public $userTyping;

    public function render(): View
    {
        return view('livewire.chat')
    }
}
```

`$message` is used to store the Message the User is sending in the chat room.

`$usersOnline` stores the Users who have joined the channel.

`$userTyping` stores the status if the User is typing or not.

### Sending and Receiving Messages

We’ll add a couple of methods now to retrieve and send a message.

```php
use Illuminate\Support\Facades\Auth;

protected array $rules = [
    'message' => ['required', 'string'],
];

public function sendMessage(): void
{
    $this->validate();

    Auth::user()
        ->messages()
        ->create([
            'message' => $$this->message,
        ]);

    $this->message = '';
}

public function getMessagesProperty(): array|Collection
{
    return Message::with('user')
        ->latest()
        ->get();
}
```

The `getMessagesProperty` is a [Computed Property](https://laravel-livewire.com/docs/2.x/properties#computed-properties) which is an API offered by Livewire for accessing dynamic properties. Now you can use `$this->messages` to get the results.

You can then update the `render` method to pass this data to the view

```php
public function render(): View
{
    return view('livewire.chat')
        ->with('messages', $this->messages); // [tl! focus]
}
```

### Echo Integration

In Livewire, to listen for Events, it’s super simple — no need to generate a Listener class, it is all done in the component.

You can read more about Event Listeners in Livewire [here](https://laravel-livewire.com/docs/2.x/events#event-listeners).

In the Chat component, add a `$listener` property:

```php
protected $listeners = [
	//
];
```

Using Echo with Livewire requires a special kind of syntax to be used. You can read more about Listeners in an Echo integration [here](https://laravel-livewire.com/docs/2.x/laravel-echo#listeners).

Update the `$listeners` property

```php
protected $listeners = [
	// Special Syntax:
	// echo:{channel},{event}' => '{method}'
    'echo-presence:chat-room,.MessageCreated' => 'render',
];
```

and let’s break it down

- `echo-presence` - tells Livewire it’s using a Presence channel. You would change to `private` if using that, or omit it completely if using a public channel.
- `chat-room` - this is the name of the Channel you specified on the `broadcastOn` method in the Message Model class.
- `.MessageCreated` - this is the Event you’re listening for. You’ll see here it is prefixed with a period. I will explain why this is important below.

Because we’re using Model Broadcasting, we haven’t actually specified an Event to use. This is because Model Broadcasting uses conventions to create the Events for us. I mentioned above about how the Events from a Model are used. In this scenario, we are creating a new Message Model, which means it emits the `created` event, and so Model Broadcasting will use conventions and creates the `MessageCreated` Event for us that we can listen for.

Model Broadcasts aren’t actually associated with a real Event, so to combat this you have to prefix the Event name with a `.` (period). You can read more about listening for Model Broadcasts [here](https://laravel.com/docs/9.x/broadcasting#listening-for-model-broadcasts)

In our example, we’re using the `render` method to be hit when a `MessageCreated` Event is emitted. All this does it re-render the component, giving the effect of real-time updating, which is what you’d want it a chat room after someone sends a Message.

Laravel Echo gives you three Events out of the box that you can subscribe to and listen for:

- `joining`
- `leaving`
- `here`

Let’s add them to our `$listeners` property:

```php
protected $listeners = [
    'echo-presence:chat-room,.MessageCreated' => 'render',
    'echo-presence:chat-room,here' => 'here', // [tl! focus:2]
    'echo-presence:chat-room,joining' => 'joining',
    'echo-presence:chat-room,leaving' => 'leaving',
];
```

Here, we’re calling a method with the same name as the Event, but you can use any method name you desire.

I’ll explain here what each method does

### `here`

This Event is is executed as soon as the User joins the channel successfully and can retrieve the data of all the currently subscribed Users’ in the channel.

```php
public function here($users)
{
    $this->usersOnline = collect($users);
}
```

The list of all the Users’ in the channel is stored in the `$users` variable returns as an `array`. In this scenario, we’re just wrapping the data into a Collection and storing it in the `$usersOnline` property of the component.

### `joining`

This Event is executed once a new User joins the channel.

```php
public function joining($user)
{
    $this->usersOnline->push($user);
}
```

We get an `array` of data with the single Users’ data, and we’re using it to `push` onto the `$usersOnline` property, which is now a Collection.

### `leaving`

This Event is executed when a User leaves the channel.

```php
public function leaving($user)
{
    $this->usersOnline = $this->usersOnline->reject(
        fn ($u) => $u['id'] === $user['id']
    );
}
```

Again we get the `array` of data of the User that left, and we remove it from the Collection of User data.

### Listening for Client Events

These types of Events are a bit different and require using JavaScript to listen for them, but we can still add them as a Listener to perform some logic on them. We’ll come back to these shortly as we still need to emit them from somewhere.

A Client Event name can be anything you desire. For our case of checking if a User is typing or not, we’re going to call them `typing` and `stoppedTyping`. To listen for these, another special kind of syntax is needed in the `$listeners` property.

Similar to a Model Broadcast Event, it must be prefixed with a `.` (period) but then further prefixed with `client-` and then add your custom Event name after

```php
protected $listeners = [
    'echo-presence:chat-room,.MessageCreated' => 'render',
    'echo-presence:chat-room,here' => 'here',
    'echo-presence:chat-room,joining' => 'joining',
    'echo-presence:chat-room,leaving' => 'leaving',
    'echo-presence:chat-room,.client-typing' => 'typing', // [tl! focus]
    'echo-presence:chat-room,.client-stopped-typing' => 'stoppedTyping', // [tl! focus]
];
```

```php
public function typing($event)
{
    $this->usersOnline->map(function ($user) use ($event): void {
        if ($user['id'] === $event['id']) {
            $user['typing'] = true;

            $this->userTyping = $user['id'];
        }
    });
}

public function stoppedTyping($event)
{
    $this->usersOnline->map(function ($user) use ($event): void {
        if ($user['id'] === $event['id']) {
            unset($user['typing']);

            $this->userTyping = null;
        }
    });
}
```

When a User is typing, the `typing` method is hit and looks for the User who is typing and adds more data implying the User is typing. The reverse is done with the `stoppedTyping` where it will remove that data.

## Front-end and AlpineJS

Here is a super basic, ugly looking excuse for a chat room UI

```html
<div>
    <x-app-layout>
        <div>
            <form 
                class="mt-4 mb-8 ml-12 space-x-2"
                wire:submit.prevent="sendMessage"
            >
                <label for="message">
                    <input
                        autofocus
                        class="bg-gray-800"
                        id="message"
                        name="message"
                        type="text"
                    >
                </label>
                <button
                    class="py-2 px-3 text-white bg-blue-500 rounded-lg text-white bg-blue-900 hover:bg-blue-600"
                    type="submit"
                >Send Message
                </button>

                @error('message')
                    <span class="text-red-700">{{ $message }}</span>
                @enderror
            </form>
        </div>
        <div>
            <div>
                <h2 class="text-xl font-bold tracking-wider uppercase">Users online: <strong>{{ count($usersOnline) }}</strong></h2>
                <ul>
                    @foreach ($usersOnline as $user)
                        <li>
                            {{ $user['name'] }}

                            @if ($userTyping === $user['id'])
                                <span class="text-sm"> is typing...</span>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div>
            <ul class="ml-12 space-y-4">
                @foreach ($messages as $message)
                    <li>
                        <span class="block font-bold text-green-700">{{ $message->user->name }}</span>
                        <span class="block">
                            {!! $message->message !!}
                        </span>
                    </li>
                @endforeach
            </ul>
        </div>
    </x-app-layout>
</div>
```

Lets add some interactivity to it with AlpineJS.

We’ve already added a `wire:submit` directive to send the Message when a User has typed it into the field (assuming it passes validation).

I’m a fan of keeping the JS separate from the HTML, so not filling the HTML with a load of code and keeping it looking clean. Alpine lets you do this by utilising what it calls Globals, specifically the one we’re using is the `data()` Global, which is just a way to re-use it easier in the app.

Start by adding this to the end of the view:

```js
<script>
    window.addEventListener("alpine:init", () => {
        Alpine.data("chat", () => ({
            {{----}}
        }));
    });
</script>
```

Here we’re waiting for Alpine to initialise then passing everything we want to do in to a component called `chat`.

Normally you might add this into the `x-data` attribute in your HTML, but now you can just define the directory directly onto it.

Replace the opening `div` in the HTML with:

```js
<div x-data="chat">
```

You can read more about extracting properties and methods into a component [here](https://alpinejs.dev/globals/alpine-data).

Now we’ll add some props and methods.

We need to get the message that the User is typing into the input field. We’re gonna use data binding to get this value so we can manipulate it.

Update the HTML to add it to the input

```js
<input
    autofocus
    class="bg-gray-800"
    id="message"
    name="message"
    type="text"
    wire:model="message" // [tl! focus]
>
```

Because we’re using Livewire to bind the data, we have to share the state between Livewire and Alpine to get the data. Livewire allows us to do this with a feature called `@entangle`, which means when the `$message` property is updated, Alpine also knows it has been changed and can use that exact data. You can find more info about this [here](https://laravel-livewire.com/docs/2.x/alpine-js#sharing-state).

Update the Alpine component:

```js
window.addEventListener("alpine:init", () => {
    Alpine.data("chat", () => ({
        message: @entangle('message'), // [tl! focus]
    }));
});
```

Now lets circle back to the Client Events and see how we need to call these to determine if a User is typing.

Alpine offers an `init()` method which will be executed before the component is fully rendered. More info about this can be found [here](https://alpinejs.dev/globals/alpine-data#init-functions).

We’re also going to use what Alpine calls a “magic method” — `$watch` — this will watch a property for changes and execute a callback when it is detected.

We’re going to watch the `message` property. If there is text in the field (indicating a User is typing) then we perform an action. And vice-versa when the field is empty.

Update the `chat` component:

```js
window.addEventListener("alpine:init", () => {
    Alpine.data("chat", () => ({
        message: @entangle('message'),

        init() { // [tl! focus:start]
            this.$watch("message", value => {
                const whisperEventName = value === "" ? "stopped-typing" : "typing";

                Echo.join("chat-room").whisper(whisperEventName, {
                    id: {{ auth()->id() }}
                })
            });
        } // [tl! focus:end]
    }));
});
```

Here, we’re ********watching******** for changes on the `message` property and assigning the `value` to a constant. If the message is empty, the const equals `stopped-typing` and if the value has content, it equals `typing`, indicating a User is typing.

Laravel Echo uses a `whisper` method to broadcast client events. We’re using the two custom Event names we added earlier and passing along an ID with the value of the logged in Users’ ID. We can use this to indicate that the User is typing.

The Event listeners we added earlier in the Livewire component will now pick this up and run the methods given to it.

## Calling JavaScript with Livewire

One final thing I want to show off.

With the UI I’ve presented above, you would have to scroll down the page to view the newest messages (I know you could just reverse the message order, but that makes this section irrelevant)

In Livewire, you can actually emit JavaScript to run by emitting an Event and listening for that Event in the JavaScript code. The example here is that when a User sends a Message, the page will scroll down to the bottom of the viewport.

On the Chat Livewire component, just emit an Event in the code, the Event name can be anything

```php
public function sendMessage(): void
{
    $this->validate();

    Auth::user()
        ->messages()
        ->create([
            'message' => $this->transform($this->message),
        ]);

    $this->emitSelf('scrollToBottom'); // [tl! focus]

    $this->message = '';
}
```

Now in the view, within the `chat` component, add this:

```js
<script>
    window.addEventListener("alpine:init", () => {
        Alpine.data("chat", () => ({
            message: @entangle('message'),

            init() {
                this.$watch("message", value => {
                    const whisperEventName = value === "" ? "stopped-typing" : "typing";

                    Echo.join("chat-room").whisper(whisperEventName, {
                        id: {{ auth()->id() }}
                    })
                });

                @this.on("scrollToBottom", () => { // [tl! focus:start]
                    window.scrollTo({
                        top: document.body.scrollHeight,
                        behavior: "smooth"
                    });
                }); // [tl! focus:end]
            },
        }));
    });
</script>
```

The “magic” here is the `@this.on()` method that is listening for that emitted Event and performing the JS logic, which in this case is just scrolling to the end of the viewport. You can find out more about this feature [here](https://laravel-livewire.com/docs/2.x/inline-scripts#accessing-javascript-component-instance).

If you have got this far, thanks for taking the time to read this and I hope you find some use out of it.

You can find me on Twitter [@cmellor](https://twitter.com/cmellor)

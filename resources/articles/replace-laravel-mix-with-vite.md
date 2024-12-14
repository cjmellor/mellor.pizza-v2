As of Laravel version **9.19**, the framework has chosen to replace its front-end asset management tool **Mix** with the very popular tool **[Vite](https://vitejs.dev)**.

## Getting started

This guide will explain how to *upgrade* an existing application with Mix to use Vite. **Brand new installations of a Laravel app will have this already in place — no work required.**

## Remove Mix

First, remove Mix as it will now no longer be needed.

```bash
npm remove laravel-mix
```

Then remove the `webpack.mix.js` file from your root.

## Install Vite and the Laravel plugin

Now install Vite, along with the new Laravel plugin for it. Save them as dev dependencies.

```bash
npm install --save-dev vite laravel-vite-plugin
```

### Configuring the plugin

Create a new file in the root called `vite.config.js` and add this code to it

```js
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel([
            'resources/css/app.css',
            'resources/js/app.js'
        ]),
});
```

### Update scripts

The build scripts have changed with Vite and need to be replaced in the `package.json` file.

```json
// torchlight! {"diffIndicators": true}
"scripts": {
    "dev": "yarn run development", // [tl! remove:start]
    "development": "mix",
    "watch": "mix watch",
    "watch-poll": "mix watch -- --watch-options-poll=1000",
    "hot": "mix watch --hot",
    "prod": "yarn run production",
    "production": "mix --production" // [tl! remove:end]
    "dev": "vite", // [tl! add:start]
    "build": "vite build" // [tl! add:end]
},
```

### Compatibility with ES Modules

Vite can only support ES Modules, so any cases where you’re using the `require()` method in your Javascript now needs to be replaced with an **import**. Within a Laravel app, here is where these changes can be made

`resources/js/app.js`

```js
// torchlight! {"diffIndicators": true}
require('./bootstrap'); // [tl! remove]
import './bootstrap'; // [tl! add]
```

`resources/js/bootstrap.js`

```js
// torchlight! {"diffIndicators": true}
window._ = require('lodash'); // [tl! remove]
import _ from 'lodash'; // [tl! add]
window._ = _; // [tl! add]
```

```js
// torchlight! {"diffIndicators": true}
window.axios = require('axios'); // [tl! remove]
import axios from 'axios'; // [tl! add]
window.axios = axios; // [tl! add]
```

```js
// torchlight! {"diffIndicators": true}
// window.Pusher = require('pusher-js'); // [tl! remove]
// import Pusher from 'pusher-js'; // [tl! add]
// window.Pusher = Pusher; // [tl! add]
```

### Update Environment files

Your `.env` and the `.env.example` files must be updated too

```text
// torchlight! {"diffIndicators": true}
MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}" // [tl! remove]
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}" // [tl! remove]
VITE_PUSHER_APP_KEY="${PUSHER_APP_KEY}" // [tl! add]
VITE_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}" // [tl! add]
```

The `PUSHER_APP_*` variables are also mentioned within the `resources/js/bootstrap.js` file, so it would be worth updating these too

```js
// torchlight! {"diffIndicators": true}
key: process.env.MIX_PUSHER_APP_KEY, // [tl! remove]
cluster: process.env.MIX_PUSHER_APP_CLUSTER, // [tl! remove]
key: import.meta.env.VITE_PUSHER_APP_KEY, // [tl! add]
cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER, // [tl! add]
```

### Using the new Vite directive

This version of Laravel comes with a handy new Blade directive which is to be used to replace your existing links to your `app.css` and `app.js` files.

Remove any mention of these files and replace them with the new directive

```php
@vite(['resources/css/app.css', 'resources/js/app.js'])
```

## Optional extras: Tailwind; Gitignore

If you’re using Tailwind CSS, a `postcss.config.js` file is required for the utility classes to be generated correctly with Vite. Run this command to add this file to your root with the necessary code

```bash
npx tailwindcss init -p
```

Or you can add this manually by creating a new file called `postcss.config.js` and adding the below code

```js
module.exports = {
  plugins: {
    tailwindcss: {},
    autoprefixer: {},
  },
}
```

When you generate the assets with Vite, it stores the files within a `build` folder within the `public` directory. If you don’t want these files to be in your VCS then ignore the folder in the root `.gitignore` file

```
/public/build
```

## Running locally

Now everything is set up, you can run the scripts as you’re used to and reap the benefits of faster build times

```bash
npm run dev
```

You’ll see some differences from when running this with Mix installed. This will boot up a dev server running on port **3000** and will start listening for changes immediately, similar to running `mix watch` and you’ll see it runs a lot quicker.

### Deployment

When deploying your app, be sure to update your deployment script (or however you do it) to use the new build script, replacing `npm run prod`

```bash
npm run build
```

This compiles your assets into a `public/build` folder and the `@vite()` blade directive will inject it into your code. You can do this locally too if you wish.

## 🔥 Hot Module Reloading (HMR)

A cool feature of Vite is Hot Module Reloading, which means when you save a file, the browser will inject that code into the browser without reloading. This works out of the box when running the dev server.

## Tip: Using Laravel Valet with HTTPS

If you’re using Laravel Valet with secured sites, it is advised to add this to your `vite.config.js` file

```js
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel([
            'resources/css/app.css',
            'resources/js/app.js'
        ]),
    server: { // [tl! focus:start]
        https: true,
        host: 'localhost'
    } // [tl! focus:end]
});
```

⚠️ You may run into issues with your browser connecting to Vite — if so, visit the URL to the Vite server (usually `https://localhost:3000`) and accept the certificate pop-up warnings you’ll get. You should only need to do this once. Always restart the dev server when making any config changes.

## Tip: Auto-reload Blade Files

#### ⛔️ Update as of v0.3.0

The plugin now supports Blade reloading out of the box. The syntax is slightly different, as shown below

```js
// torchlight! {"diffIndicators": true}
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel([ // [tl! remove:start]
            'resources/css/app.css',
            'resources/js/app.js'
        ]), // [tl! remove:end]
        laravel({ // [tl! add:start]
            input: [
                'resources/css/app.css',
                'resources/js/app.js'
            ],
            refresh: true
        }), // [tl! add:end]
        { // [tl! remove:start]
            name: 'blade',
            handleHotUpdate ({ file, server }) {
                if (file.endsWith('.blade.php')) {
                    server.ws.send({
                        type: 'full-reload',
                        path: '*'
                    });
                }
            }
        } // [tl! remove:end]
    ],
    server: {
        https: true,
        host: 'localhost'
    }
});
```

**The below is no longer relevant**

One thing Vite cannot do is use HMR to inject code into **Blade** files, but there is a workaround that involves listening for changes to Blade files and doing a full page reload, but automatically. Add this snippet of code to your `vite.config.js` file.

```js
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel([
            'resources/css/app.css',
            'resources/js/app.js'
        ]),
        { // [tl! focus:start]
            name: 'blade',
            handleHotUpdate ({ file, server }) {
                if (file.endsWith('.blade.php')) {
                    server.ws.send({
                        type: 'full-reload',
                        path: '*'
                    });
                }
            }
        } // [tl! focus:end]
    ],
    server: {
        https: true,
        host: 'localhost'
    }
});
```

Now when you update a Blade file, you should see the page reload automatically.

## Using React and Vue

This guide is very basic and only explains how to upgrade a standard Laravel app that only uses Blade files. You can use this with React and Vue but that goes beyond the scope of this guide. If you want to know more about how to use Vite with React and Vue and SSR, check out the official upgrade guide on the Vite plugin repository —  [https://github.com/laravel/vite-plugin/blob/main/UPGRADE.md](https://github.com/laravel/vite-plugin/blob/main/UPGRADE.md)

### Wrapping up…

- Check out Laravel’s own [documentation](https://laravel.com/docs/9.x/vite) on using Vite
- Thanks to [@freekmurze](https://twitter.com/freekmurze) for the [information](https://freek.dev/2277-using-laravel-vite-to-automatically-refresh-your-browser-when-changing-a-blade-file) on using HMR with Blade files
- Here is a PR I did for this website which shows all the changes I made to replace Mix with Vite - https://github.com/cjmellor/mellor.pizza/pull/35/files

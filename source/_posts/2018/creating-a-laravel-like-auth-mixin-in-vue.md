---
title: Creating a Laravel-like Auth Mixin in Vue
date: '2018-04-23'
tags:
  - javascript
  - vue
comments: true
---
In Laravel, we have the very useful and convenient `auth()` helper. When I tried to build my first single-page app while learning Vue.js, this helper was one of the things that I immediately felt was missing and needed to have in my Vue code.

```php
<?php

auth()->id()
auth()->user()
auth()->check()
auth()->guest()
```

Here I will show you how I replicated Laravel's `auth()` helper in Vue.js as a global **mixin**. By the end of this post, we will have these JavaScript equivalents of the previous `auth()` helper snippet.

```js
this.$_auth.id
this.$_auth.user
this.$_auth.check
this.$_auth.guest
```

## The Vuex Store

The setup that I'm going to use assumes that you use **Vuex** to handle authentication state. We will also be putting that state in a separate module because it just makes sense to split related chunks of your store into smaller, self-contained pieces.

First, let’s initialize the **state**.

The `user` key is all we need here. All of the other properties of the auth mixin will have their values based on this.

```js
// store/modules/auth.js
export default {
    state: {
        user: null
    }
};
```

Next, we define a **getter** that returns an object with the properties `id`, `user`, `check`, and `guest`.

Since I'm focusing mainly on the auth mixin here, I won't be going into how to build a full auth module in Vuex. Just know that you should at least have mutations for setting the user and changing it back to `null`.

```js
// store/modules/auth.js
export default {
    // state
    getters: {
        auth (state) {
            const user = state.user;
            return {
                id: (user ? user.id : null),
                user: user,
                check: (user !== null),
                guest: (user === null)
            };
        }
    }
};
```

Then, register the module in your store.

```js
// store/index.js
import Vue from 'vue';
import Vuex from 'vuex';
import auth from './auth';

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        auth: auth
    }
});
```

## The Mixin

Here we define the auth mixin. It's as simple as defining a computed property that returns the **getter** we created earlier.

If you're wondering where I got the idea of prepending `$_` to the mixin's computed property, check out the [Vue Style Guide](https://vuejs.org/v2/style-guide/#Private-property-names-essential).

```js
// mixins.js
export const auth = {
    computed: {
        $_auth () {
            return this.$store.getters.auth;
        }
    }
};
```

Finally, we can now register the auth mixin. How you register it is up to you, but for convenience I'm going to do it globally.

```js
// main.js
import { auth } from './mixins';

Vue.mixin(auth);
```

## Using the Mixin

### In Component Scripts

```js
// code
```

### In Component Templates

```html
<template>
    <nav>
        <template v-if="$_auth.guest">
            <router-link to="/signup">
                Sign up
            </router-link>
            <router-link to="/signin">
                Sign in
            </router-link>
        </template>

        <template v-if="$_auth.check">
            <router-link :to="`/profile/${$_auth.user.username}`">
                Hello {{ $_auth.user.firstname }}
            </router-link>
            <a @click="onClickSignout">
                Sign out
            </a>
        </template>
    </nav>
</template>
```

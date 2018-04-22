---
title: Creating a Laravel-like Auth Mixin in Vue
date: '2018-04-23'
tags:
  - javascript
  - vue
comments: true
---
In Laravel we have ...

```php
<?php

auth()->id()
auth()->user()
auth()->check()
auth()->guest()
```

By the end of this we should have these

```js
this.$_auth.id
this.$_auth.user
this.$_auth.check
this.$_auth.guest
```

this tutorial assumes that you use Vuex

```js
export default {
    state: {
        user: null
    },
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

[Vue Style Guide](https://vuejs.org/v2/style-guide/#Private-property-names-essential)

```js
export const auth = {
    computed: {
        $_auth () {
            return this.$store.getters.auth;
        }
    }
};
```

register the mixin

```js
import { auth } from './mixins';

Vue.mixin(auth);
```

using the mixin in templates

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

<?php

return [
    'production' => false,
    'baseUrl' => 'https://raniesantos.netlify.com',
    'site' => [
        'title' => 'Ranie Santos',
        'description' => 'Personal blog of Ranie Santos. Laravel fanboy, code linting zealot, podcast junkie, lives in Linux.',
        'image' => 'default-share.png',
    ],
    'owner' => [
        'name' => 'Ranie Santos',
        'twitter' => 'raniesantos32',
        'github' => 'raniesantos',
        'gitlab' => 'raniesantos',
        'resume' => 'https://drive.google.com/file/d/0BxTkFtINjLyIYUFRQUxScUt0cXc/view?usp=sharing',
    ],
    'services' => [
        'analytics' => 'UA-118355516-1',
        'disqus' => 'raniesantos',
        'sirv' => 'raniesantos',
        'jumprock' => 'raniesantos',
    ],
    'collections' => [
        'posts' => [
            'path' => 'blog/{filename}',
            'sort' => '-date',
            'extends' => '_layouts.post',
            'section' => 'postContent',
            'isPost' => true,
            'comments' => true,
            'tags' => [],
        ],
        'tags' => [
            'path' => 'blog/tags/{filename}',
        ],
        'projects' => [],
    ],
    'excerpt' => function ($page, $limit = 250) {
        return $page->isPost
            ? str_limit(strip_tags($page->getContent()), $limit, '...')
            : null;
    },
    'allTags' => function ($page, $posts) {
        return $posts->pluck('tags')->flatten()->unique();
    },
    'filterByTag' => function ($page, $posts, $tag) {
        return $posts->filter(function ($post) use ($tag) {
            return collect($post->tags)->contains($tag);
        });
    },
    'countPostsWithTag' => function ($page, $posts, $tag) {
        return $posts->reduce(function ($carry, $post) use ($tag) {
            return $carry + (int) collect($post->tags)->contains($tag);
        });
    },
    'imageCdn' => function ($page, $path) {
        return "https://{$page->services->sirv}-cdn.sirv.com/blog/{$path}";
    },
];

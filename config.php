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
        'cloudinary' => 'raniesantos',
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
            'prettyDate' => function ($page, $format = 'M j, Y') {
                return date($format, $page->date);
            },
        ],
        'tags' => [
            'path' => 'blog/tags/{filename}',
            'extends' => '_layouts.tag',
            'section' => '',
            'name' => function ($page) {
                return $page->getFilename();
            },
        ],
        'projects' => [],
    ],
    'isActive' => function ($page, $segment) {
        return starts_with($page->getPath(), $segment) ? ' is-active' : '';
    },
    'excerpt' => function ($page, $limit = 250, $end = '...') {
        return $page->isPost
            ? str_limit_soft(content_sanitize($page->getContent()), $limit, $end)
            : null;
    },
    'imageCdn' => function ($page, $path) {
        return "https://res.cloudinary.com/{$page->services->cloudinary}/my-blog/{$path}";
    },
];

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
            'extends' => '_layouts.tag',
            'section' => '',
            'name' => function ($page) {
                return $page->getFilename();
            },
        ],
        'projects' => [],
    ],
    'excerpt' => function ($page, $limit = 250, $end = '...') {
        return $page->isPost
            ? str_limit_soft(content_sanitize($page->getContent()), $limit, $end)
            : null;
    },
    'imageCdn' => function ($page, $path) {
        return "https://{$page->services->sirv}-cdn.sirv.com/blog/{$path}";
    },
];

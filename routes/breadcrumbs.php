<?php

/**
 * https://github.com/diglactic/laravel-breadcrumbs
 */
// Home
Breadcrumbs::for('postIndex', function ($trail) {
    $trail->push('Home', route('postIndex'));
});


// Home > New
Breadcrumbs::for('postCreate', function ($trail) {
    $trail->parent('postIndex');
    $trail->push('New', route('postCreate'));
});

// Home > Post
Breadcrumbs::for('postShow', function ($trail, $post) {
    $trail->parent('postIndex');
    $trail->push($post->word, route('postShow', $post));
});

// Home > Search
Breadcrumbs::for('postSearch', function ($trail, $keyword) {
    $trail->parent('postIndex');
    $trail->push('検索:' . $keyword, route('postSearch', $keyword));
});

// Home > Search > CommentSearch
Breadcrumbs::for('searchComment', function ($trail, $keyword, $nextPage) {
    $trail->parent('postSearch', $keyword);
    $trail->push('コメントに:'. $keyword . ' を含む', route('searchComment', [$keyword, $nextPage]));
});


// Home > Blog > [Category]
Breadcrumbs::for('category', function ($trail, $category) {
    $trail->parent('blog');
    $trail->push($category->title, route('category', $category->id));
});

// Home > Blog > [Category] > [Post]
Breadcrumbs::for('post', function ($trail, $post) {
    $trail->parent('category', $post->category);
    $trail->push($post->title, route('post', $post->id));
});

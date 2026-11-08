<?php

return [
    [
        'id' => 1,
        'title' => 'Building a portfolio with Laravel and Tailwind',
        'tag' => 'Laravel',
        'date' => 'Nov 2026',
        'body' => [
            'I started this portfolio as a way to keep a few notes next to the work I ship. Laravel gives me a simple place to define routes and views, and the Blade component system keeps the markup tidy.',
            'The layout is a single Blade component. It pulls in a header, a footer, and a slot for the page content, so every page shares the same skeleton without repeating any HTML.',
            'Tailwind handles the styling. Most of the design is spacing, type scale, and a couple of borders, which means there is very little custom CSS to maintain.',
        ],
    ],
    [
        'id' => 2,
        'title' => 'Blade components I reach for first',
        'tag' => 'Blade',
        'date' => 'Oct 2026',
        'body' => [
            'The first components I create in any Laravel project are the layout, header, and footer. They are boring, but they remove the most duplication and make every later page shorter.',
            'Small presentational components come next. A note card, a tag badge, or a date label can live in a single file and be reused wherever the data shows up.',
            'The rule I follow is simple: if a chunk of markup appears more than once, or if a view is getting long, it becomes a component.',
        ],
    ],
    [
        'id' => 3,
        'title' => 'Writing cleaner utility classes',
        'tag' => 'CSS',
        'date' => 'Sep 2026',
        'body' => [
            'Utility classes are easy to write and hard to read once a list gets long. Grouping them by purpose, such as layout, spacing, and color, makes the order predictable.',
            'Extracting repeated patterns into Blade components is usually better than creating custom CSS classes. The styles stay next to the markup and there is no second place to look.',
            'When a class list still feels noisy, it is often a sign that the element is doing too much and should be split into smaller pieces.',
        ],
    ],
];

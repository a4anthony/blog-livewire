<?php

// config for VendorName/BlogLivewire
return [
    "project" => "fluentnow", // fluentnow or teq

    "blog_show_route" => "blog.show",
    "blog_category_posts_route" => "blog.show",
    "blog_index_route" => "blog.index",

    /**
     * Single Post
     */
    "practice_quiz_show_route" => "practice-quiz.show",
    "has_single_post_ad" => true,
    "single_post_ad" => [
        "header" => "Want to learn more?",
        "sub_header" =>
            "Book a session with one of our expert tutors and get a free practice quiz. Click the button below to get started.",
        "action" => "Book a Session",
        "link" => "https://fluentnow.com/book-a-session/",
    ],
];

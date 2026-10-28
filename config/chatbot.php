<?php
// Chat assistant settings. The API key is NOT here — it goes in the .env file
// in the project folder (DEEPSEEK_API_KEY=sk-...), which is kept out of git.
return [
    // Any OpenAI-compatible chat API works here.
    'base_url' => 'https://api.deepseek.com/v1',
    'model' => 'deepseek-chat',
    'temperature' => 0.3,   // low = consistent, factual answers
    'max_tokens' => 4096,   // includes the model's hidden reasoning, so keep it generous
    'reasoning_effort' => 'low', // low / medium / high: how long the model thinks first (low ≈ 3x faster); '' to not send it
    'timeout' => 25,        // seconds to wait for the AI service before retrying once

    // Reply for any question that is not about Chedo Tech.
    'off_topic_reply' => "I know about Chedo Tech only — ask me anything about Chedo Tech, like our courses, syllabus, timings, location or admissions! 😊",

    // Abuse protection: messages allowed per visitor (by IP address), and for the whole site per day.
    'limit_per_10_minutes' => 15,
    'limit_per_day' => 60,
    'limit_site_per_day' => 2000,
];

<?php

return [
    'api_key' => env('AI_SPAMDETECTOR_OPENAI_API_KEY', env('OPENAI_API_KEY', null)),
    'organization' => env('AI_SPAMDETECTOR_OPENAI_ORGANIZATION', env('OPENAI_ORGANIZATION', null)),
    'project' => env('AI_SPAMDETECTOR_OPENAI_PROJECT', env('OPENAI_PROJECT', null)),
    'base_uri' => env('AI_SPAMDETECTOR_OPENAI_BASE_URI', env('OPENAI_BASE_URI', 'api.openai.com/v1')),
    'model' => env('AI_SPAMDETECTOR_OPENAI_MODEL', env('OPENAI_MODEL', 'gpt-4')),
];

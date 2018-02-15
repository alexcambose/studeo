<?php

return [
    'default_disk' => 'local',
    'timeout' => 3600,
    'ffmpeg.threads'  => 12,

    'ffmpeg.binaries' => storage_path('utils/ffmpeg' . (env('DB_PASSWORD') ? '' : '.exe')),
    'ffprobe.binaries' => storage_path('utils/ffprobe'. (env('DB_PASSWORD') ? '' : '.exe')),
];

<?php

function get_fa_extension($extenstion) {
    switch ($extenstion) {
        case 'jpeg':
        case 'gif':
        case 'png':
        case 'jpg': {
                return 'fa-file-picture-o';
            }
        case 'pdf': {
                return 'fa-file-pdf-o';
            }
        case 'xls':
        case 'xlsx': {
                return 'fa-file-excel-o';
            }
        case 'ppt':
        case 'pptx': {
                return 'fa-file-powerpoint-o';
            }
        case 'mp3':
        case 'wav': {
                return 'fa-file-audio-o ';
            }
        case 'mp4':
        case 'avi':
        case 'wmv':
        case 'mpg':
        case 'flv': {
                return 'fa-file-video-o';
            }
        case 'rar':
        case 'zip': {
                return 'fa-file-archive-o';
            }
        default: {
                return 'fa-file-text';
            }
    }
}
